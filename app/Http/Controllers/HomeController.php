<?php

namespace App\Http\Controllers;

use App\Helper\GlobalHelper;
use App\Models\AdminSetting;
use App\Models\Attendance;
use App\Models\DayCarePayment;
use App\Models\DayCarePaymentItem;
use App\Models\DaycareProvider;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Kid;
use App\Models\Parents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */



    public function test(Request $request)
    {
        $parents = Parents::where('status', 1)->get();

        foreach ($parents as $parent) {
            $kids = $parent->kids;
            $totalPresenceCount = 0;
            $totalInvoiceAmount = 0;
            $totalMinistryShare = 0;
            $totalActualAmount = 0;

            // Check if there are kids with presence count greater than 0
            $hasKidsWithPresence = false;

            $invoice = new Invoice();
            $invoice->parent_id = $parent->id;
            $invoice->provider_id = $parent->daycare_provider_id;
            $invoice->save();

            foreach ($kids as $kid) {
                // Calculate the presence count for the current month
                $presenceCount = Attendance::where('kid_id', $kid->id)
                    ->whereMonth('date', now()->month)
                    ->count();

                if ($presenceCount > 0) {

                    $hasKidsWithPresence = true;

                    $kidAge = GlobalHelper::calculateAgeFromDOB($kid->dob);

                    // Get rate settings based on kid's age
                    $adminSettings = AdminSetting::first();
                    if ($kidAge < 2) {
                        $rate = $adminSettings->infant;
                    } elseif ($kidAge >=2 && $kidAge < 4) {
                        $rate = $adminSettings->toddler;
                    } else {
                        $rate = $adminSettings->pre_school;
                    }

                    // Calculate the kid's total based on rate and presence count
                    $kidTotal = $rate * $presenceCount;

                    // Subtract ministry percentage
                    $ministryPercentage = $adminSettings->ministry_rate;
                    $ministryAmount = $kidTotal * ($ministryPercentage / 100);

                    // Create an invoice data record for each kid
                    $invoiceItem = new InvoiceItem();
                    $invoiceItem->invoice_id = $invoice->id;
                    $invoiceItem->kid_id = $kid->id;
                    $invoiceItem->kid_age = $kidAge;
                    $invoiceItem->presence_count = $presenceCount;
                    $invoiceItem->rate = $rate;
                    $invoiceItem->amount = $kidTotal;
                    $invoiceItem->ministry_share = $ministryAmount;
                    $invoiceItem->kid_total = $kidTotal - $ministryAmount;
                    $invoiceItem->save();


                    $totalPresenceCount += $presenceCount;
                    $totalActualAmount += $kidTotal;
                    $totalMinistryShare += $ministryAmount;
                    $totalInvoiceAmount += $kidTotal - $ministryAmount;
                }
            }

            if ($hasKidsWithPresence) {
                $invoice->total_presence = $totalPresenceCount; // Save total presence count
                $invoice->total = $totalActualAmount; // Save total actual amount
                $invoice->ministry_amount = $totalMinistryShare; // Save total ministry share
                $invoice->grand_total = $totalInvoiceAmount; // Save total invoice amount
                $invoice->save();
            } else {
                $invoice->delete();
            }
        }


        return 'Invoices Generate for all parents';
    }




    public function payment()
    {
        // Get all providers where there rate with admin is not null and greater then 0

        $providers = DaycareProvider::where('status', 1)
            ->where(function ($query) {
                $query->whereNotNull('infant_percentage')
                    ->where('infant_percentage', '>', 0);
            })
            ->where(function ($query) {
                $query->whereNotNull('toddler_percentage')
                    ->where('toddler_percentage', '>', 0);
            })
            ->where(function ($query) {
                $query->whereNotNull('pre_school_percentage')
                    ->where('pre_school_percentage', '>', 0);
            })->get();

        // Get all providers where there rate with admin is not null and greater then 0


        foreach ($providers as $provider) {
            $kids = $provider->kids;
            $total_no_of_days = 0;
            $total = 0;

            // Check if there are kids with presence count greater than 0
            $hasKidsWithPresence = false;

            $paymentNumber = GlobalHelper::generatePaymentNumber($provider->code);
            $payment = new DayCarePayment();
            $payment->provider_id = $provider->id;
            $payment->payment_number = $paymentNumber;
            $payment->save();

            foreach ($kids as $kid) {
                // Calculate the presence count for the current month
                $presenceCount = Attendance::where('kid_id', $kid->id)
                    ->whereMonth('date', now()->month)
                    ->count();

                if ($presenceCount > 0) {

                    $hasKidsWithPresence = true;

                    $kidAge = GlobalHelper::calculateAgeFromDOB($kid->dob);

                    // Get rate settings based on kid's age
                    if ($kidAge < 2) {
                        $rate = $provider->infant_percentage;
                    } elseif ($kidAge >=2 && $kidAge < 4) {
                        $rate = $provider->toddler_percentage;
                    } else {
                        $rate = $provider->pre_school_percentage;
                    }

                    // Calculate the kid's total based on rate and presence count
                    $kidTotal = $rate * $presenceCount;

                    // Create an invoice data record for each kid
                    $paymentItem = new DayCarePaymentItem();
                    $paymentItem->payment_id = $payment->id;
                    $paymentItem->kid_id = $kid->id;
                    $paymentItem->kid_age = $kidAge;
                    $paymentItem->no_of_days = $presenceCount;
                    $paymentItem->rate = $rate;
                    $paymentItem->amount = $kidTotal;
                    $paymentItem->save();

                    $total_no_of_days += $presenceCount;
                    $total += $kidTotal;
                }
            }

            if ($hasKidsWithPresence) {
                $payment->total_no_of_days = $total_no_of_days; // Save total presence count
                $payment->total = $total; // Save total payment amount
                $payment->balance = 0; // Save total payment amount
                $payment->save();

                // Send Email
                $payment = DayCarePayment::where('id', $payment->id)->with('provider', 'paymentItems.kid')->first();
                $data = [
                    'payment' => $payment,
                ];

                $monthName = Carbon::parse($payment->created_at)->format('F');
                // GlobalHelper::sendEmail($provider->email, "Guess what? It's that time of the month again! Your monthly payment for $monthName is here.", 'pdf.invoice', $data);
                // Send Email

                // Send Notification
                $type = 'PaymentGenerated';

                // Admin and parent
                $recipients = User::where('id', $provider->user_id)->pluck('id')->toArray();
                // Admin and parent

                if (isset($recipients) && !empty($recipients) && count($recipients) > 0) {
                    GlobalHelper::sendUpdateNotification($recipients, $type);
                }
                // Send Notification

            } else {
                $payment->delete();
            }
        }

        return 'generated';
        // $this->info('payment generated for all providers');
    }











    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    // public function index()
    // {
    //     return view('home');
    // }
}
