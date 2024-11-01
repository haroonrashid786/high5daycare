<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use App\Models\DayCarePayment;
use App\Models\DayCarePaymentItem;
use App\Models\DaycareProvider;
use App\Models\FundingCategory;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\InvoiceReceivedPayment;
use App\Models\Kid;
use App\Models\MinistryFunding;
use App\Models\PaidPayment;
use App\Models\Parents;
use App\Models\PaymentFunding;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LedgerController extends Controller
{

    public function index()
    {
        return view('ledgers.index');
    }

    public function ministryLedger(Request $request)
    {
        $user = User::find(Auth::id());

        $currentMonth = Carbon::now();
        $fundingQuery = MinistryFunding::where('type', 'kid');

        if (isset($request->month) && !empty($request->month) && $request->month != 'all') {
            $currentMonth = Carbon::create(Carbon::now()->year, $request->month, 1, 0, 0, 0);
        }

        $startOfMonth = $currentMonth->copy()->startOfMonth();
        $endOfMonth = $currentMonth->copy()->endOfMonth();

        $ministryFunding = $fundingQuery->whereDate('from', '>=', $startOfMonth)
            ->whereDate('to', '<=', $endOfMonth)->value('amount') ?? 0;

        if (isset($request->month) && !empty($request->month) && $request->month == 'all') {
            $currentMonth = 'all';
            $ministryFunding = $fundingQuery->sum('amount') ?? 0;
        }

        if (isset($user) && $user->hasRole('Admin')) {
            $kids = Kid::where('status', 1)->pluck('id')->toArray();

            $entries = Invoice::when($currentMonth != 'all', function ($query) use ($currentMonth) {
                $query->whereMonth('created_at', $currentMonth);
            })
                ->with([
                    'invoiceItems' => function ($query) {
                        $query->select('id', 'invoice_id', 'kid_age', 'rate', 'subsidized_days', 'non_subsidized_days');
                    },
                    'provider' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'kid' => function ($query) {
                        $query->select('id', 'full_name', 'dob', 'code');
                    }
                ])
                ->whereIn('kid_id', $kids)
                ->paginate(20);

            // Calculate age group accordingly for each kid
            // $entries = $entries->map(function ($entry) {
            //     $age = optional($entry->invoiceItems)->kid_age;
            //     $entry->age_group = ($age < 2) ? 'Infant' : (($age < 3) ? 'Toddler' : 'Pre School');
            //     return $entry;
            // });
            if (!empty($entries)) {
                foreach ($entries->items() as $entry) {
                    $age = optional($entry->invoiceItems)->kid_age;
                    $entry->age_group = ($age < 2) ? 'Infant' : (($age < 3) ? 'Toddler' : 'Pre School');
                }
            }
            // Calculate age group accordingly for each kid
            $defaultMinistryFunding = 10000;

            return view('ledgers.ministry', compact('currentMonth', 'entries', 'defaultMinistryFunding'));
        }

        abort(404);
    }

    public function hcegLedger(Request $request)
    {
        $currentMonth = Carbon::now();

        if (isset($request->month) && !empty($request->month) && $request->month != 'all') {
            $currentMonth = Carbon::create(Carbon::now()->year, $request->month, 1, 0, 0, 0);
        }

        $startOfMonth = $currentMonth->copy()->startOfMonth();
        $endOfMonth = $currentMonth->copy()->endOfMonth();

        if (isset($request->month) && !empty($request->month) && $request->month == 'all') {
            $currentMonth = 'all';
        }

        $fundingQuery = MinistryFunding::whereHas('fundingCategory', function ($query) use ($currentMonth) {
            $query->where('name', 'HCEG')->where('type', 'providers')->when($currentMonth != 'all', function ($query) use ($currentMonth) {
                $query->whereMonth('date', $currentMonth);
            });
        });

        $fundReceived = $fundingQuery->sum('amount');
        $fundDate = $fundingQuery->value('date');

        $entries = DayCarePayment::where('hceg_fund', '!=', null)->with('provider:id,name,hceg_funding', 'paymentItems:payment_id,rate', 'funds:payment_id,name,amount')
            ->when($currentMonth != 'all', function ($query) use ($currentMonth) {
                $query->whereMonth('created_at', $currentMonth);
            })->paginate(20);

        return view('ledgers.hceg', compact('entries', 'currentMonth', 'fundReceived', 'fundDate'));
    }

    public function gogLedger(Request $request)
    {
        $currentMonth = Carbon::now();

        if (isset($request->month) && !empty($request->month) && $request->month != 'all') {
            $currentMonth = Carbon::create(Carbon::now()->year, $request->month, 1, 0, 0, 0);
        }

        $startOfMonth = $currentMonth->copy()->startOfMonth();
        $endOfMonth = $currentMonth->copy()->endOfMonth();

        if (isset($request->month) && !empty($request->month) && $request->month == 'all') {
            $currentMonth = 'all';
        }

        $fundingQuery = MinistryFunding::whereHas('fundingCategory', function ($query) use ($currentMonth) {
            $query->where('name', 'GOG')->where('type', 'providers')->when($currentMonth != 'all', function ($query) use ($currentMonth) {
                $query->whereMonth('date', $currentMonth);
            });
        });

        $fundReceived = $fundingQuery->sum('amount');
        $fundDate = $fundingQuery->value('date');

        $entries = DayCarePayment::where('gog_fund', '!=', null)->with('provider:id,name,ministry_funding', 'paymentItems:payment_id,rate', 'funds:payment_id,name,amount')
            ->when($currentMonth != 'all', function ($query) use ($currentMonth) {
                $query->whereMonth('created_at', $currentMonth);
            })->paginate(20);
        // dd($entries);

        return view('ledgers.gog', compact('entries', 'currentMonth', 'fundReceived', 'fundDate'));
    }


    public function subsidaryLedger(Request $request)
    {
        $currentMonth = Carbon::now();

        if (isset($request->month) && !empty($request->month) && $request->month != 'all') {
            $currentMonth = Carbon::create(Carbon::now()->year, $request->month, 1, 0, 0, 0);
        }

        $startOfMonth = $currentMonth->copy()->startOfMonth();
        $endOfMonth = $currentMonth->copy()->endOfMonth();

        if (isset($request->month) && !empty($request->month) && $request->month == 'all') {
            $currentMonth = 'all';
        }

        $kids = Kid::where('status', 1)->where('is_subsidized', 1)->pluck('id')->toArray();

        $entries = Invoice::when($currentMonth != 'all', function ($query) use ($currentMonth) {
            $query->whereMonth('created_at', $currentMonth);
        })->with([
            'invoiceItems' => function ($query) {
                $query->select('id', 'invoice_id', 'kid_age', 'rate', 'subsidized_days', 'non_subsidized_days');
            },
            'provider' => function ($query) {
                $query->select('id', 'name');
            },
            'kid' => function ($query) {
                $query->select('id', 'full_name', 'dob', 'code');
            }
        ])
            ->whereIn('kid_id', $kids)
            ->paginate(20);


        // // Calculate age group accordingly for each kid
        // $entries = $entries->map(function ($entry) {
        //     $age = $entry->invoiceItems->kid_age;
        //     $entry->age_group = ($age < 2) ? 'Infant' : (($age < 3) ? 'Toddler' : 'Pre School');
        //     return $entry;
        // });
        if (!empty($entries)) {
            foreach ($entries->items() as $entry) {
                $age = optional($entry->invoiceItems)->kid_age;
                $entry->age_group = ($age < 2) ? 'Infant' : (($age < 3) ? 'Toddler' : 'Pre School');
            }
        }
        // Calculate age group accordingly for each kid


        // $fundingQuery = MinistryFunding::whereHas('fundingCategory', function($query) use($currentMonth){
        //     $query->where('name','HCEG')->where('type', 'providers')->when($currentMonth != 'all', function ($query) use ($currentMonth) {
        //         $query->whereMonth('date', $currentMonth);
        //     });   
        // });

        // $fundReceived = $fundingQuery->sum('amount');
        // $fundDate = $fundingQuery->value('date');
        $defaultMinistryFunding = 100000;

        return view('ledgers.subsidary', compact('currentMonth', 'entries', 'defaultMinistryFunding'));
    }


    public function providerPayments(Request $request)
    {
        $user = User::find(Auth::id());
        $providerId = $request->provider_id;

        if (!empty($providerId)) {
            $provider = DaycareProvider::where('id', $request->provider_id)->select('id')->first();
        } elseif (isset($user) && $user->hasRole('Franchise')) {
            $provider = DaycareProvider::where('id', $user->provider->id)->select('id')->first();
        } else {
            $provider = '';
        }
                $entriesQuery = DayCarePayment::where('provider_id', $provider->id)->with(['paymentItems']);
                $perPage = 20;
                $entries = $entriesQuery->paginate($perPage);

                if(isset($entries) && !empty($entries) && count($entries) > 0)
                {
                    foreach($entries->items() as $e)
                    {
                        $paymentQuery = PaidPayment::whereMonth('date',Carbon::parse($e->created_at))->first();
                        if(isset($paymentQuery) && !empty($paymentQuery))
                        {
                        $e->paid_amount = $paymentQuery->amount;
                        $e->payment_date = Carbon::parse($paymentQuery->created_at)->format('d-M-y');
                        }
                    }
                }

            return view('ledgers.provider', compact('entries'));
    }

    public function kidPayments(Request $request)
    {
        $adminSettings = AdminSetting::first();
        $user = User::find(Auth::id());
        $kidId = $request->kid_id;
        $providerAttendance = 0;


        if (!empty($kidId)) {
            $kid = Kid::where('id', $request->kid_id)->first();
            // return $kid;
        }

        $currentMonth = $request->filled('month') && $request->month != 'all'
            ? Carbon::create(Carbon::now()->year, $request->month, 1, 0, 0, 0)
            : Carbon::now();

        $startOfMonth = $currentMonth->copy()->startOfMonth();
        $endOfMonth = $currentMonth->copy()->endOfMonth();

        $previousMonth = $currentMonth->copy()->subMonth();
        // dd($nextMonth);
        if ($request->month == 'all') {
            $currentMonth = 'all';
            $startOfMonth = '';
            $endOfMonth = '';
        }

        if (!empty($kid)) {

            $invoiceData = InvoiceItem::where('kid_id', $kid->id)->with('invoice')->paginate(20);
            foreach ($invoiceData->items() as $item) {
                $invoice = Invoice::where('id', $item->invoice_id)->first();
                $item->invoice_balance = $invoice->previous_balance;
                $item->already_paid = InvoiceReceivedPayment::where('kid_id', $kidId)->when($currentMonth != 'all', function ($query) use ($invoice) {
                    $query->whereMonth('date', Carbon::parse($invoice->created_at));
                })->sum('amount') ?? 0;

                $kid_age = $item->kid_age;
                $item->isSubsidized = false;

                if ($kid_age < 2) {
                    $kidRate = $adminSettings->infant ?? 49.84;
                    $defaultMinistryRate = $adminSettings->ministry_rate_infant ?? 52;
                } elseif ($kid_age < 3) {
                    $kidRate = $adminSettings->toddler ?? 47.60;
                    $defaultMinistryRate = $adminSettings->ministry_rate_toddler ?? 52;
                } else {
                    $kidRate = $adminSettings->pre_school ?? 47.20;
                    $defaultMinistryRate = $adminSettings->ministry_rate_pre_school ?? 52;
                }

                $rate = $kidRate - ($kidRate * ($defaultMinistryRate / 100));
                $rate = round($rate, 2);

                // Now, you can use $rate for further processing or update it in the item data
                if ($item->ministry_share == 0) {
                    $item->isSubsidized = true;
                    $nonSubsidizedRate = round($item->rate * (1 - ($defaultMinistryRate / 100)), 2);
                    $item->kid_rate_for_non_subsidized_days = $nonSubsidizedRate;
                    $item->kid_rate_for_subsidized_days = round($item->kid->subsidized_percentage - ($item->rate * ($defaultMinistryRate / 100)), 2);
                } elseif (!empty($item->subsidized_days) && !empty($item->non_subsidized_days)) {
                    $item->isSubsidized = true;
                    $nonSubsidizedRate = round($item->rate * (1 - ($defaultMinistryRate / 100)), 2);
                    $item->kid_rate_for_non_subsidized_days = $nonSubsidizedRate;
                    $item->kid_rate_for_subsidized_days = round($item->kid->subsidized_percentage - ($item->rate * ($defaultMinistryRate / 100)), 2);
                } else {
                    $item->kid_rate = $rate;
                }
            }
        }

        // $alreadyPaid = InvoiceReceivedPayment::where('kid_id', $kidId)->when($currentMonth != 'all', function ($query) use ($currentMonth) {
        //     $query->whereMonth('created_at', $currentMonth);
        // })->sum('amount') ?? 0;

        if (isset($invoiceData) && !empty($kid)) {
            return view('ledgers.kid', compact('endOfMonth', 'startOfMonth', 'currentMonth', 'kid', 'invoiceData'));
        }

        return view('ledgers.kid', compact('currentMonth'))->with('error', 'No record found');
    }

    public function generalLedger()
    {
        $adminSettings = AdminSetting::first();


        $kids = Kid::with('provider', 'parent')->orderBy('created_at', 'desc')->paginate(10);
        foreach ($kids->items() as $item) {
            $kid_age = $item->kid_age;

            if ($kid_age < 2) {
                $kidRate = $adminSettings->infant ?? 49.84;
                $defaultMinistryRate = $adminSettings->ministry_rate_infant ?? 52;
            } elseif ($kid_age < 3) {
                $kidRate = $adminSettings->toddler ?? 47.60;
                $defaultMinistryRate = $adminSettings->ministry_rate_toddler ?? 52;
            } else {
                $kidRate = $adminSettings->pre_school ?? 47.20;
                $defaultMinistryRate = $adminSettings->ministry_rate_pre_school ?? 52;
            }

            $rate = $kidRate - ($kidRate * ($defaultMinistryRate / 100));
            $rate = round($rate, 2);
            $item->kid_rate = $rate;
        }
        return view('ledgers.general', compact('kids'));
    }

    public function registrationLedger()
    {
        $kids = Invoice::where('registeration_fee', '>', 0)->with('kid')->paginate(10);
        return view('ledgers.registration', compact('kids'));
    }

    public function securityLedger()
    {
        $kids = Invoice::where('advance_payment', '>', 0)->with('kid')->paginate(10);
        $payment = '';
        $paymentPaid = False;
        if (isset($kids) && !empty($kids)) {
            foreach ($kids->items() as $kid) {
                // $invoice = Invoice::where('kid_id', $kid->id)->where('advance_payment', '>', 0)->first();
                $payment = InvoiceReceivedPayment::whereMonth('date', carbon::parse($kid->created_at))->whereYear('date', carbon::parse($kid->created_at))->first();
                if (isset($payment) && !empty($payment) && $payment->amount > $kid->net_amount) {
                    $kid->paymentPaid = True;
                    $kid->payment_date = $payment->date;
                }
            }
        }
        return view('ledgers.security', compact('kids', 'paymentPaid'));
    }

    public function bankLedger()
    {
        $payments = DayCarePayment::orderBy('created_at', 'desc')->with('provider')->get();
        $invoices = Invoice::orderBy('created_at', 'desc')->with('kid')->get();
        $funds = MinistryFunding::with('fundingCategory')->get();
        return view('ledgers.bank', compact('payments', 'invoices', 'funds'));
    }

    public function gpLedger(Request $request)
    {
        $providers = DaycareProvider::where('status', 1)->get();

        $currentMonth = Carbon::now();
        if (isset($request->month) && !empty($request->month) && $request->month != 'all') {
            $currentMonth = Carbon::create(Carbon::now()->year, $request->month, 1, 0, 0, 0);
        }
        if (isset($request->month) && !empty($request->month) && $request->month == 'all') {
            $currentMonth = 'all';
        }
        foreach ($providers as $provider) {
            $provider->parent_pay = Invoice::where('provider_id', $provider->id)->when($currentMonth != 'all', function ($query) use ($currentMonth) {
                $query->whereMonth('created_at', $currentMonth);
            })->sum('net_amount');
            $provider->ministry_pay = Invoice::where('provider_id', $provider->id)->when($currentMonth != 'all', function ($query) use ($currentMonth) {
                $query->whereMonth('created_at', $currentMonth);
            })->sum('ministry_amount');
            $provider->registration = Invoice::where('provider_id', $provider->id)->when($currentMonth != 'all', function ($query) use ($currentMonth) {
                $query->whereMonth('created_at', $currentMonth);
            })->sum('registeration_fee');
            $provider->payment = PaidPayment::where('provider_id', $provider->id)->when($currentMonth != 'all', function ($query) use ($currentMonth) {
                $query->whereMonth('created_at', $currentMonth);
            })->sum('amount');
        }
// return $currentMonth;
        return view('ledgers.gp', compact('providers', 'currentMonth'));
    }
}
