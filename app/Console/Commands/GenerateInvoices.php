<?php

namespace App\Console\Commands;

use App\Helper\GlobalHelper;
use App\Models\AdminSetting;
use App\Models\Attendance;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Parents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate invoices for parents';

    /**
     * Execute the console command.
     */

     public function __construct()
     {
         parent::__construct();
     }

     
    public function handle()
    {   
        // $parents = Parents::where('status',1)->get();

        // foreach ($parents as $parent) {

        //     $kids = $parent->kids;
        //     $totalPresenceCount = 0;
        //     $totalInvoiceAmount = 0;
        //     $totalMinistryShare = 0;
        //     $totalActualAmount = 0;
        //     $hasKidsWithPresence = false;
        
        //     $invoiceNumber = GlobalHelper::generateInvoiceNumber($parent->code);
        //     $invoice = new Invoice();
        //     $invoice->parent_id = $parent->id;
        //     $invoice->provider_id = $parent->daycare_provider_id;
        //     $invoice->invoice_number = $invoiceNumber;
        //     $invoice->save();
        
        //     foreach ($kids as $kid) {
        //         $currentMonth = now()->month;
        //         $firstDayOfMonth = now()->startOfMonth();
        //         $lastDayOfMonth = now()->endOfMonth();
        //         $presenceCount = Attendance::where('kid_id', $kid->id)
        //             ->where('date', '>=', $firstDayOfMonth)
        //             ->where('date', '<=', $lastDayOfMonth)
        //             ->count();
        
        //         if ($presenceCount > 0) {
        //             $hasKidsWithPresence = true;
        //             $kidAge = GlobalHelper::calculateAgeFromDOB($kid->dob);
        //             $adminSettings = AdminSetting::first();
        
        //             if ($kidAge < 2) {
        //                 $rate = $adminSettings->infant ?? 49.84;
        //             } elseif ($kidAge < 3) {
        //                 $rate = $adminSettings->toddler ?? 47.60;
        //             } else {
        //                 $rate = $adminSettings->pre_school ?? 47.20;
        //             }

        //             $kidTotal = $rate * $presenceCount;
        
        //             $subsidizedFrom = Carbon::parse($kid->subsidized_from);
        //             $subsidizedTo = Carbon::parse($kid->subsidized_to);
        //             $subsidizedDaysInCurrentMonth = 0;
        
        //             for ($date = $subsidizedFrom; $date <= $subsidizedTo; $date->addDay()) {
        //                 if ($date->month == $currentMonth) {
        //                     $isPresent = Attendance::where('kid_id', $kid->id)
        //                         ->where('date', $date)
        //                         ->count() > 0;
        
        //                     if ($isPresent) {
        //                         $subsidizedDaysInCurrentMonth++;
        //                     }
        //                 }
        //             }
        
        //             $ministryDaysInCurrentMonth = $presenceCount - $subsidizedDaysInCurrentMonth;
        
        //             $subsidizedAmount = 0;
        //             $ministryAmount = 0;


        //             $defaultSubsidizedRate = $kid->subsidized_percentage ?? 0;
        //             $defaultMinistryRate = $adminSettings->ministry_rate ?? 52;
        
        //             if ($subsidizedDaysInCurrentMonth > 0) {
        //                 // $subsidizedAmount = ($subsidizedDaysInCurrentMonth) * $rate * ($defaultSubsidizedRate / 100);
        //                 if($defaultSubsidizedRate > 0)
        //                 {
        //                    $anountForSubsidizedDays = $subsidizedDaysInCurrentMonth * $rate;
                           
        //                     if($defaultSubsidizedRate > $anountForSubsidizedDays)
        //                     {
        //                         $subsidizedAmount = $subsidizedDaysInCurrentMonth * $rate;

        //                         $remainingSubsidized = $defaultSubsidizedRate - $subsidizedAmount;
        //                         $kid->update(['subsidized_percentage' => $remainingSubsidized]);
        //                     }else{
        //                         $subsidizedAmount = $defaultSubsidizedRate;
        //                         $remainingSubsidized = $defaultSubsidizedRate - $subsidizedAmount;
        //                         $kid->update(['subsidized_percentage' => $remainingSubsidized]);
        //                     }
        //                 }
        //             }
        
        //             if ($ministryDaysInCurrentMonth > 0) {
        //                 $ministryAmount = ($ministryDaysInCurrentMonth) * $rate * ($defaultMinistryRate / 100);
        //             }

        
        //             $miniShare = $subsidizedAmount + $ministryAmount;
        
        //             $invoiceItem = new InvoiceItem();
        //             $invoiceItem->invoice_id = $invoice->id;
        //             $invoiceItem->kid_id = $kid->id;
        //             $invoiceItem->kid_age = $kidAge;
        //             $invoiceItem->presence_count = $presenceCount;
        //             $invoiceItem->rate = $rate;
        //             $invoiceItem->amount = $kidTotal;
        //             $invoiceItem->ministry_share = $miniShare;
        //             $invoiceItem->subsidized_days = $subsidizedDaysInCurrentMonth;
        //             $invoiceItem->non_subsidized_days = $ministryDaysInCurrentMonth;
        //             $invoiceItem->kid_total = $kidTotal - $miniShare;
        //             $invoiceItem->save();
        
        //             $totalPresenceCount += $presenceCount;
        //             $totalActualAmount += $kidTotal;
        //             $totalMinistryShare += $miniShare;
        //             $totalInvoiceAmount += ( $kidTotal - $miniShare );
        //         }
        //     }
        
        //     if ($hasKidsWithPresence) {
        //         $invoice->total_presence = $totalPresenceCount;
        //         $invoice->total = $totalActualAmount;
        //         $invoice->ministry_amount = $totalMinistryShare;
        //         $invoice->grand_total = $totalInvoiceAmount;
        //         $invoice->save();
        
        //         $invoice = Invoice::where('id', $invoice->id)->with('parent', 'provider', 'invoiceItems.kid')->first();
        //         $data = [
        //             'invoice' => $invoice,
        //         ];
        //         $monthName = Carbon::parse($invoice->created_at)->format('F');
        //         GlobalHelper::sendEmail($parent->email, "Guess what? It's that time of the month again! Your monthly invoice for $monthName is here.", 'pdf.invoice', $data);
        
        //         $type = 'InvoiceGenerated';
        //         $recipients = User::whereHas('roles', function ($query) {
        //             $query->whereIn('name', ['Admin']);
        //         })->orWhere('id', $parent->user_id)->pluck('id')->toArray();
        
        //         if (isset($recipients) && !empty($recipients) && count($recipients) > 0) {
        //             GlobalHelper::sendUpdateNotification($recipients, $type);
        //         }
        //     } else {
        //         $invoice->delete();
        //     }
        }
        
        // $this->info('Invoices generated for all parents');
        
        // foreach($parents as $parent)
        // {
        //     $kids = $parent->kids;
        //     $totalPresenceCount = 0;
        //     $totalInvoiceAmount = 0;
        //     $totalMinistryShare = 0;
        //     $totalActualAmount = 0;
    
        //     // Check if there are kids with presence count greater than 0
        //     $hasKidsWithPresence = false;
    
        //     $invoiceNumber = GlobalHelper::generateInvoiceNumber($parent->code);
        //     $invoice = new Invoice();
        //     $invoice->parent_id = $parent->id;
        //     $invoice->provider_id = $parent->daycare_provider_id;
        //     $invoice->invoice_number = $invoiceNumber;
        //     $invoice->save();
    
        //     foreach ($kids as $kid) {
        //         // Calculate the presence count for the current month
        //         $presenceCount = Attendance::where('kid_id', $kid->id)
        //             ->whereMonth('date', now()->month)
        //             ->count();
    
        //             if ($presenceCount > 0) {
    
        //             $hasKidsWithPresence = true;
    
        //         $kidAge = GlobalHelper::calculateAgeFromDOB($kid->dob);
    
        //            // Get rate settings based on kid's age
        //            $adminSettings = AdminSetting::first();
        //            if ($kidAge < 2) {
        //                $rate = $adminSettings->infant;
        //            } elseif ($kidAge < 3) {
        //                $rate = $adminSettings->toddler;
        //            } else {
        //                $rate = $adminSettings->pre_school;
        //            }
    
        //         // Calculate the kid's total based on rate and presence count
        //         $kidTotal = $rate * $presenceCount;
    
        //          // Subtract ministry percentage
        //          $ministryPercentage = $adminSettings->ministry_rate;
        //          $ministryAmount = $kidTotal * ($ministryPercentage / 100);
    
        //           // Create an invoice data record for each kid
        //         $invoiceItem = new InvoiceItem();
        //         $invoiceItem->invoice_id = $invoice->id;
        //         $invoiceItem->kid_id = $kid->id;
        //         $invoiceItem->kid_age = $kidAge;
        //         $invoiceItem->presence_count = $presenceCount;
        //         $invoiceItem->rate = $rate;
        //         $invoiceItem->amount = $kidTotal;
        //         $invoiceItem->ministry_share = $ministryAmount;
        //         $invoiceItem->kid_total = $kidTotal - $ministryAmount;
        //         $invoiceItem->save();
    
    
        //         $totalPresenceCount += $presenceCount;
        //         $totalActualAmount += $kidTotal;
        //         $totalMinistryShare += $ministryAmount;
        //         $totalInvoiceAmount += $kidTotal - $ministryAmount;
                
        //     }
        // }
    
        //     if ($hasKidsWithPresence) {
        //         $invoice->total_presence = $totalPresenceCount; // Save total presence count
        //         $invoice->total = $totalActualAmount; // Save total actual amount
        //         $invoice->ministry_amount = $totalMinistryShare; // Save total ministry share
        //         $invoice->grand_total = $totalInvoiceAmount; // Save total invoice amount
        //         $invoice->save();

        //     // Send Email
        //     $invoice = Invoice::where('id', $invoice->id)->with('parent', 'provider', 'invoiceItems.kid')->first();
        //     $data = [
        //         'invoice' => $invoice,
        //     ];
        //     $monthName = Carbon::parse($invoice->created_at)->format('F');
        //     GlobalHelper::sendEmail($parent->email, "Guess what? It's that time of the month again! Your monthly invoice for $monthName is here.", 'pdf.invoice', $data);
        //     // Send Email


        //     // Send Notification
        //     $type = 'InvoiceGenerated';

        //     // Admin and parent
        //     $recipients = User::whereHas('roles', function ($query) {
        //         $query->whereIn('name', ['Admin']);
        //     })->orWhere('id', $parent->user_id)->pluck('id')->toArray();
        //     // Admin and parent

        //     if(isset($recipients) && !empty($recipients) && count($recipients) > 0)
        //     {
        //         GlobalHelper::sendUpdateNotification($recipients,$type);
        //     }
        //     // Send Notification


        //     }else{
        //         $invoice->delete();
        //     }
         
        // }
    
        //     $this->info('Invoices generated for all parents');
    // }
}
