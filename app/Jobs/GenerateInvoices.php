<?php

namespace App\Jobs;

use App\Helper\GlobalHelper;
use App\Models\AdminSetting;
use App\Models\Attendance;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Notification;
use App\Models\Parents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class GenerateInvoices implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function handle()
    { 
        $parents = Parents::where('status', 1)->get();

        foreach ($parents as $parent) {

            $currentMonth = now()->month;

            $existingInvoice = Invoice::where('parent_id', $parent->id)
            ->whereMonth('created_at', $currentMonth)
            ->first();

            if (!$existingInvoice && empty($existingInvoice)) {
                $this->createInvoiceForParent($parent);
            }

        }

            $this->handleCompletion();
    }

    protected function createInvoiceForParent($parent)
    {
        $kids = $parent->kids;
        $totalPresenceCount = 0;
        $totalInvoiceAmount = 0;
        $totalMinistryShare = 0;
        $totalActualAmount = 0;
        $hasKidsWithPresence = false;
    
        $invoiceNumber = GlobalHelper::generateInvoiceNumber($parent->code);
        $invoice = new Invoice();
        $invoice->parent_id = $parent->id;
        $invoice->provider_id = $parent->daycare_provider_id;
        $invoice->invoice_number = $invoiceNumber;
        $invoice->save();
    
        foreach ($kids as $kid) {
            $currentMonth = now()->month;
            $firstDayOfMonth = now()->startOfMonth();
            $lastDayOfMonth = now()->endOfMonth();
            $presenceCount = Attendance::where('kid_id', $kid->id)
                ->where('date', '>=', $firstDayOfMonth)
                ->where('date', '<=', $lastDayOfMonth)
                ->count();
    
            if ($presenceCount > 0) {
                $hasKidsWithPresence = true;
                $kidAge = GlobalHelper::calculateAgeFromDOB($kid->dob);
                $adminSettings = AdminSetting::first();
    
                if ($kidAge < 2) {
                    $rate = $adminSettings->infant ?? 49.84;
                    $defaultMinistryRate = $adminSettings->ministry_rate_infant ?? 52;
                }elseif ($kidAge >=2 && $kidAge < 4) {
                    $rate = $adminSettings->toddler ?? 47.60;
                    $defaultMinistryRate = $adminSettings->ministry_rate_toddler ?? 52;
                } else {
                    $rate = $adminSettings->pre_school ?? 47.20;
                    $defaultMinistryRate = $adminSettings->ministry_rate_pre_school ?? 52;
                }

                $kidTotal = $rate * $presenceCount;
    
                $subsidizedFrom = Carbon::parse($kid->subsidized_from);
                $subsidizedTo = Carbon::parse($kid->subsidized_to);
                $subsidizedDaysInCurrentMonth = 0;
    
                for ($date = $subsidizedFrom; $date <= $subsidizedTo; $date->addDay()) {
                    if ($date->month == $currentMonth) {
                        $isPresent = Attendance::where('kid_id', $kid->id)
                            ->where('date', $date)
                            ->count() > 0;
    
                        if ($isPresent) {
                            $subsidizedDaysInCurrentMonth++;
                        }
                    }
                }
    
                $ministryDaysInCurrentMonth = $presenceCount - $subsidizedDaysInCurrentMonth;
    
                $subsidizedAmount = 0;
                $ministryAmount = 0;

                $defaultSubsidizedRate = $kid->subsidized_percentage ?? 0;
    
                if ($subsidizedDaysInCurrentMonth > 0) {
                    // $subsidizedAmount = ($subsidizedDaysInCurrentMonth) * $rate * ($defaultSubsidizedRate / 100);
                    if($defaultSubsidizedRate > 0)
                    {
                       $amountForSubsidizedDays = $subsidizedDaysInCurrentMonth * $rate;
                       
                        if($defaultSubsidizedRate > $amountForSubsidizedDays)
                        {
                            $subsidizedAmount = $subsidizedDaysInCurrentMonth * $rate;

                            $remainingSubsidized = $defaultSubsidizedRate - $subsidizedAmount;
                            $kid->update(['subsidized_percentage' => $remainingSubsidized]);
                        }else{
                            $subsidizedAmount = $defaultSubsidizedRate;
                            $remainingSubsidized = $defaultSubsidizedRate - $subsidizedAmount;
                            $kid->update(['subsidized_percentage' => $remainingSubsidized]);
                        }
                    }
                }
    
                if ($ministryDaysInCurrentMonth > 0) {
                    $ministryAmount = ($ministryDaysInCurrentMonth) * $rate * ($defaultMinistryRate / 100);
                }

    
                $miniShare = $subsidizedAmount + $ministryAmount;
    
                $invoiceItem = new InvoiceItem();
                $invoiceItem->invoice_id = $invoice->id;
                $invoiceItem->kid_id = $kid->id;
                $invoiceItem->kid_age = $kidAge;
                $invoiceItem->presence_count = $presenceCount;
                $invoiceItem->rate = $rate;
                $invoiceItem->amount = $kidTotal;
                $invoiceItem->ministry_share = $miniShare;
                $invoiceItem->subsidized_days = $subsidizedDaysInCurrentMonth;
                $invoiceItem->non_subsidized_days = $ministryDaysInCurrentMonth;
                $invoiceItem->kid_total = $kidTotal - $miniShare;
                $invoiceItem->save();
    
                $totalPresenceCount += $presenceCount;
                $totalActualAmount += $kidTotal;
                $totalMinistryShare += $miniShare;
                $totalInvoiceAmount += ( $kidTotal - $miniShare );
            }
        }
    
        if ($hasKidsWithPresence) {
            $invoice->total_presence = $totalPresenceCount;
            $invoice->total = $totalActualAmount;
            $invoice->ministry_amount = $totalMinistryShare;
            $invoice->grand_total = $totalInvoiceAmount;
            $invoice->save();
    
            $invoice = Invoice::where('id', $invoice->id)->with('parent', 'provider', 'invoiceItems.kid')->first();
            $data = [
                'invoice' => $invoice,
            ];
            $monthName = Carbon::parse($invoice->created_at)->format('F');
            GlobalHelper::sendEmail($parent->email, "Guess what? It's that time of the month again! Your monthly invoice for $monthName is here.", 'pdf.invoice', $data);
    
            $type = 'InvoiceGenerated';
            $recipients = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Admin']);
            })->orWhere('id', $parent->user_id)->pluck('id')->toArray();
    
            if (isset($recipients) && !empty($recipients) && count($recipients) > 0) {
                GlobalHelper::sendUpdateNotification($recipients, $type);
            }
        } else {
            $invoice->delete();
        }
    }

    protected function handleCompletion()
    {
          // Admin
          $recipients = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Admin']);
        })->pluck('id')->toArray();
        // Admin

        if (isset($recipients) && (!empty($recipients)) && count($recipients) > 0) {

            $userIds = is_array($recipients) ? $recipients : [$recipients];
            $now = now();

            foreach ($userIds as $userId) {
                $notifications[] = [
                    'user_id' => $userId,
                    'type' => 'invoices_generated',
                    'title' => 'Invoices Genereated',
                    'message' => 'Invoices generated successfully against all parents for current month.',
                    'url' => route('invoices'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                $user = User::find($userId);
                if ($user) {
                    $count = $user->unread_count + 1;
                    $user->update(['unread_count' => $count]);
                }
            }
            Notification::insert($notifications);
        }
    }

}
