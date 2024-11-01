<?php

namespace App\Http\Controllers;

use App\Helper\GlobalHelper;
use App\Jobs\GenerateInvoices;
use App\Jobs\GeneratePayments;
use App\Models\AdminSetting;
use App\Models\Attendance;
use App\Models\DayCarePayment;
use App\Models\DayCarePaymentItem;
use App\Models\DaycareProvider;
use App\Models\Invoice;
use App\Models\InvoiceFund;
use App\Models\InvoiceItem;
use App\Models\InvoiceReceivedPayment;
use App\Models\Kid;
use App\Models\PaidPayment;
use App\Models\Parents;
use App\Models\PaymentFunding;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;

class PaymentController extends Controller
{

    public function payments()
    {
        $user = User::find(Auth::id());

        $totalInvoices = 0;
        $totalPayments = 0;

        $invoices = Invoice::query();
        $payments = DayCarePayment::query();



        if (isset($user) && $user->hasRole('Admin')) {
            $totalInvoices = $invoices->count();
            $totalPayments = $payments->count();
        } elseif (isset($user) && $user->hasRole('Franchise')) {
            $totalPayments = $payments->where('provider_id', $user->provider->id)->count();
            $totalInvoices = 0;
        } elseif (isset($user) && $user->hasRole('Parent')) {

            $totalInvoices = $invoices->where('parent_id', $user->parent->id)->count();
            $totalPayments = 0;
        }

        return view('payment', compact('totalInvoices', 'totalPayments'));
    }


    // ************ Invoices Module **************

    public function invoices(Request $request)
    {
        $user = User::find(Auth::id());

        $baseQuery = Invoice::query();

        if (isset($user) && $user->hasRole('Parent')) {
            $baseQuery->where('parent_id', $user->parent->id);
        }

        if (isset($request->search_text) && !empty($request->search_text)) {
            $searchText = strtolower($request->input('search_text'));
            $baseQuery->where(function ($query) use ($searchText) {
                $query->where('invoice_number', 'LIKE', "%$searchText%")
                    ->orWhereHas('invoiceItems.kid', function ($query) use ($searchText) {
                        $query->where('full_name', 'LIKE', "%$searchText%");
                    })->orWhereHas('provider', function ($query) use ($searchText) {
                        $query->where('name', 'LIKE', "%$searchText%");
                    })->orWhereHas('provider', function ($query) use ($searchText) {
                        $query->where('code', 'LIKE', "%$searchText%");
                    })->orWhereHas('parent', function ($query) use ($searchText) {
                        $query->where('code', 'LIKE', "%$searchText%");
                    });
            });
        }

        if (isset($request->date) && !empty($request->date)) {
            $baseQuery->where(function ($query) use ($request) {
                $query->whereDate('date', $request->date);
            });
        }

        $invoices = $baseQuery->with('parent')->latest()->paginate(10);

        foreach ($invoices as $invoice) {
            $netAmount = $invoice->net_amount;
            $paidAmount = InvoiceReceivedPayment::where('kid_id', $invoice->kid_id)
                ->whereMonth('date', Carbon::parse($invoice->created_at))->sum('amount');

            if ($paidAmount > 0 && $paidAmount < $netAmount) {
                $invoice->invoice_status = 'Partially Paid';
            } elseif ($netAmount == $paidAmount || $paidAmount > $netAmount) {
                $invoice->invoice_status = 'Paid';
            } else {
                $invoice->invoice_status = 'Unpaid';
            }
        }

        return view('invoices', compact('invoices'));
    }

    public function getProviders(Request $request)
    {
        $baseQuery = DaycareProvider::query();

        // Search Provider based on coming text
        if (isset($request->search_text) && !empty($request->search_text)) {
            $searchText = strtolower($request->input('search_text'));
            $baseQuery->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', "%$searchText%")
                    ->orWhere('code', 'LIKE', "%$searchText%")
                    ->orWhere('phone_number', 'LIKE', "%$searchText%")
                    ->orWhere('email', 'LIKE', "%$searchText%")
                    ->orWhere('city', 'LIKE', "%$searchText%");
            });
        }
        // Search Provider based on coming text

        $providers = $baseQuery->where('status', 1)->latest()->paginate(10);
        return view('payments.get-providers', compact('providers'));
    }


    public function generateInvoice($code, Request $request)
    {
        $parent = Parents::where('code', $code)->first();

        if (!$parent) {
            return redirect()->back()->with('error', 'Parent not found.');
        }

        $selectedDate = now();
        if (isset($request->selected_month) && (!empty($request->selected_month)) && $request->selected_month == 'previous') {
            $selectedDate = $selectedDate->subMonth();
        }

        $currentMonth = $selectedDate->month;
        $firstDayOfMonth = $selectedDate->copy()->startOfMonth();
        $lastDayOfMonth = $selectedDate->copy()->endOfMonth();

        $kids = Kid::where('parent_id', $parent->id)->where('status', 1)->get();

        if (isset($kids) && !empty($kids) && count($kids) > 0) {

            foreach ($kids as $kid) {

                $totalPresenceCount = 0;
                $totalInvoiceAmount = 0;
                $totalMinistryShare = 0;
                $totalActualAmount = 0;
                $balance = 0;
                $subsidaryAmount = 0;
                $newAmount = 0;
                $previousSecurityDeposit = 0;

                $existingInvoice = Invoice::where('kid_id', $kid->id)->whereMonth('created_at', $currentMonth)->first();

                if ($existingInvoice) {
                    $previousSecurityDeposit = $existingInvoice->advance_payment ?? 0;

                    $existingRecord = InvoiceReceivedPayment::where('kid_id', $kid->id)->whereMonth('date', $currentMonth)->first();

                    if ($existingRecord) {
                        $newAmount = $existingRecord->amount;
                    }

                    // $balance = $existingInvoice->balance;
                    if (empty($kid->advance_payment)) {
                        $kid->advance_payment = $existingInvoice->advance_payment;
                    }

                    if (empty($kid->registeration_fee)) {
                        $kid->registeration_fee = $existingInvoice->registeration_fee;
                    }

                    $kid->save();
                    $existingInvoice->delete();
                    // $rp = InvoiceReceivedPayment::whereMonth('date', $currentMonth)->first();
                    // if ($rp) {
                    //     $rp->delete();
                    // }
                }

                $kidContractDate = '';
                if (!empty($kid->contract_start)) {
                    $kidContractDate = Carbon::parse($kid->contract_start);
                }

                $extraCharges = 0;
                $kidSecurityDeposit = 0;
                $kidRegisterationFee = 0;
                $previousBalance = 0;

                if (isset($kidContractDate) &&  !empty($kidContractDate) && $kidContractDate->isSameMonth($selectedDate) && $kidContractDate->isSameYear($selectedDate)) {
                    $kidRegisterationFee = $kid->registeration_fee;
                    $kidSecurityDeposit = $kid->advance_payment;
                    $extraCharges = $kidRegisterationFee + $kidSecurityDeposit;
                }

                $previousInvoice = Invoice::where('kid_id', $kid->id)->whereMonth('created_at', '<>', $currentMonth)->latest()->first();
                if ($previousInvoice) {
                    $balance += $previousInvoice->balance;
                    $previousBalance = $previousInvoice->balance;
                }

                $invoiceNumber = GlobalHelper::generateInvoiceNumber($kid->code, $selectedDate, $kid->id);
                $invoice = new Invoice();
                $invoice->parent_id = $parent->id;
                $invoice->kid_id = $kid->id;
                $invoice->provider_id = $parent->daycare_provider_id;
                $invoice->invoice_number = $invoiceNumber;
                $invoice->previous_balance = $previousBalance;
                $invoice->created_at = $lastDayOfMonth;
                $invoice->updated_at = $lastDayOfMonth;
                $invoice->date = now();
                $invoice->save();


                $kidAgeAtEndOfMonth = GlobalHelper::calculateAgeForPayment($kid->dob, $lastDayOfMonth);
                $kidAgeAtStartOfMonth = GlobalHelper::calculateAgeForPayment($kid->dob, $firstDayOfMonth);


                // Check if the kid's birthday is in the current month
                $birthdayInCurrentMonth = Carbon::parse($kid->dob)->month == $currentMonth;
                $rateChangeAfterBirthday = false;

                if (isset($birthdayInCurrentMonth) && !empty($birthdayInCurrentMonth)) {
                    $presenceCountAfterBirthday = Attendance::where('kid_id', $kid->id)
                        ->where('date', '>=', $firstDayOfMonth)
                        ->where('date', '<=', $lastDayOfMonth)
                        ->whereDay('date', '>=', Carbon::parse($kid->dob)->day)
                        ->count();

                    $presenceCountBeforeBirthday = Attendance::where('kid_id', $kid->id)
                        ->where('date', '>=', $firstDayOfMonth)
                        ->where('date', '<=', $lastDayOfMonth)
                        ->whereDay('date', '<', Carbon::parse($kid->dob)->day)
                        ->count();

                    $presenceCount = $presenceCountAfterBirthday + $presenceCountBeforeBirthday;

                    $adminSettings = AdminSetting::first();

                    if ($kidAgeAtStartOfMonth < 2) {
                        $startRate = $adminSettings->infant ?? 49.84;
                        $defaultMinistryRateStart = $adminSettings->ministry_rate_infant ?? 52;
                    } elseif ($kidAgeAtStartOfMonth >= 2 && $kidAgeAtStartOfMonth < 4) {
                        $startRate = $adminSettings->toddler ?? 47.60;
                        $defaultMinistryRateStart = $adminSettings->ministry_rate_toddler ?? 52;
                    } else {
                        $startRate = $adminSettings->pre_school ?? 47.20;
                        $defaultMinistryRateStart = $adminSettings->ministry_rate_pre_school ?? 52;
                    }

                    if ($kidAgeAtEndOfMonth < 2) {
                        $endRate = $adminSettings->infant ?? 49.84;
                        $defaultMinistryRateEnd = $adminSettings->ministry_rate_infant ?? 52;
                    } elseif ($kidAgeAtEndOfMonth >= 2 && $kidAgeAtEndOfMonth < 4) {
                        $endRate = $adminSettings->toddler ?? 47.60;
                        $defaultMinistryRateEnd = $adminSettings->ministry_rate_toddler ?? 52;
                    } else {
                        $endRate = $adminSettings->pre_school ?? 47.20;
                        $defaultMinistryRateEnd = $adminSettings->ministry_rate_pre_school ?? 52;
                    }

                    $kidAgeAtEndOfMonthTotal = $endRate * $presenceCountAfterBirthday;
                    $kidAgeAtStartOfMonthTotal = $startRate * $presenceCountBeforeBirthday;

                    $kidTotal = $kidAgeAtEndOfMonthTotal + $kidAgeAtStartOfMonthTotal;

                    $subsidizedFrom = Carbon::parse($kid->subsidized_from);
                    $subsidizedTo = Carbon::parse($kid->subsidized_to);
                    $subsidizedDaysInCurrentMonthBeforeBD = 0;
                    $subsidizedDaysInCurrentMonthAfterBD = 0;

                    for ($date = $subsidizedFrom; $date <= $subsidizedTo; $date->addDay()) {
                        if ($date->month == $currentMonth) {
                            $beforeBD = Attendance::where('kid_id', $kid->id)
                                ->where('date', $date)->whereDay('date', '<', Carbon::parse($kid->dob)->day)
                                ->count() > 0;

                            $afterBD = Attendance::where('kid_id', $kid->id)
                                ->where('date', $date)->whereDay('date', '>=', Carbon::parse($kid->dob)->day)
                                ->count() > 0;

                            if ($beforeBD) {
                                $subsidizedDaysInCurrentMonthBeforeBD++;
                            }

                            if ($afterBD) {
                                $subsidizedDaysInCurrentMonthAfterBD++;
                            }
                        }
                    }

                    $ministryDaysInCurrentMonthBeforeBD = $presenceCountBeforeBirthday - $subsidizedDaysInCurrentMonthBeforeBD;
                    $ministryDaysInCurrentMonthAfterBD = $presenceCountAfterBirthday - $subsidizedDaysInCurrentMonthAfterBD;

                    $subsidizedAmountBeforeBD = 0;
                    $subsidizedAmountAfterBD = 0;
                    $ministryAmountBeforeBD = 0;
                    $ministryAmountAfterBD = 0;

                    $defaultSubsidizedRate = $kid->subsidized_percentage ?? 0;
                    $subsidizedAmountBeforeBD = round($subsidizedDaysInCurrentMonthBeforeBD * $defaultSubsidizedRate, 2);
                    $subsidizedAmountAfterBD = round($subsidizedDaysInCurrentMonthAfterBD * $defaultSubsidizedRate, 2);

                    // if ($subsidizedDaysInCurrentMonthBeforeBD > 0) {
                    //     // $subsidizedAmount = ($subsidizedDaysInCurrentMonth) * $rate * ($defaultSubsidizedRate / 100);
                    //     if ($defaultSubsidizedRate > 0) {
                    //         $amountForSubsidizedDaysBeforeBD = $ministryDaysInCurrentMonthBeforeBD * $startRate;

                    //         if ($defaultSubsidizedRate > $amountForSubsidizedDaysBeforeBD) {
                    //             $subsidizedAmountBeforeBD = $subsidizedDaysInCurrentMonthBeforeBD * $startRate;
                    //             $remainingSubsidizedBeforeBD = $defaultSubsidizedRate - $subsidizedAmountBeforeBD;
                    //             $kid->update(['subsidized_percentage' => $remainingSubsidizedBeforeBD]);
                    //         } else {
                    //             $subsidizedAmountBeforeBD = $defaultSubsidizedRate;
                    //             $remainingSubsidizedBeforeBD = $defaultSubsidizedRate - $subsidizedAmountBeforeBD;
                    //             $kid->update(['subsidized_percentage' => $remainingSubsidizedBeforeBD]);
                    //         }
                    //     }
                    // }

                    if ($ministryDaysInCurrentMonthBeforeBD > 0) {
                        $ministryAmountBeforeBD = ($ministryDaysInCurrentMonthBeforeBD) * round($startRate * ($defaultMinistryRateStart / 100), 2);
                    }

                    // if ($subsidizedDaysInCurrentMonthAfterBD > 0) {
                    //     // $subsidizedAmount = ($subsidizedDaysInCurrentMonth) * $rate * ($defaultSubsidizedRate / 100);
                    //     if ($defaultSubsidizedRate > 0) {
                    //         $amountForSubsidizedDaysAfterBD = $ministryDaysInCurrentMonthAfterBD * $endRate;

                    //         if ($defaultSubsidizedRate > $amountForSubsidizedDaysAfterBD) {
                    //             $subsidizedAmountAfterBD = $subsidizedDaysInCurrentMonthAfterBD * $endRate;
                    //             $remainingSubsidizedAfterBD = $defaultSubsidizedRate - $subsidizedAmountAfterBD;
                    //             $kid->update(['subsidized_percentage' => $remainingSubsidizedAfterBD]);
                    //         } else {
                    //             $subsidizedAmountAfterBD = $defaultSubsidizedRate;
                    //             $remainingSubsidizedAfterBD = $defaultSubsidizedRate - $subsidizedAmountAfterBD;
                    //             $kid->update(['subsidized_percentage' => $remainingSubsidizedAfterBD]);
                    //         }
                    //     }
                    // }

                    if ($ministryDaysInCurrentMonthAfterBD > 0) {
                        $ministryAmountAfterBD = ($ministryDaysInCurrentMonthAfterBD) * round($endRate * ($defaultMinistryRateEnd / 100), 2);
                    }

                    $miniShareBeforeBD = $ministryAmountBeforeBD;
                    $miniShareAfterBD =  $ministryAmountAfterBD;

                    $miniShare = $miniShareBeforeBD + $miniShareAfterBD;
                    $amountForSubsidizedDays =  $subsidizedAmountBeforeBD + $subsidizedAmountAfterBD;

                    if (isset($presenceCountBeforeBirthday) && !empty($presenceCountBeforeBirthday)) {
                        $invoiceItem = new InvoiceItem();
                        $invoiceItem->invoice_id = $invoice->id;
                        $invoiceItem->kid_id = $kid->id;
                        $invoiceItem->kid_age = $kidAgeAtStartOfMonth;
                        $invoiceItem->presence_count = $presenceCountBeforeBirthday;
                        $invoiceItem->rate = $startRate;
                        $invoiceItem->amount = $kidAgeAtStartOfMonthTotal;
                        $invoiceItem->ministry_share = $miniShareBeforeBD;
                        $invoiceItem->subsidized_days = $subsidizedDaysInCurrentMonthBeforeBD;
                        $invoiceItem->non_subsidized_days = $ministryDaysInCurrentMonthBeforeBD;
                        $invoiceItem->kid_total = $kidAgeAtStartOfMonthTotal - $miniShareBeforeBD;
                        $invoiceItem->created_at = $lastDayOfMonth;
                        $invoiceItem->updated_at = $lastDayOfMonth;
                        $invoiceItem->save();
                    }

                    if (isset($presenceCountAfterBirthday) && !empty($presenceCountAfterBirthday)) {
                        $invoiceItem = new InvoiceItem();
                        $invoiceItem->invoice_id = $invoice->id;
                        $invoiceItem->kid_id = $kid->id;
                        $invoiceItem->kid_age = $kidAgeAtEndOfMonth;
                        $invoiceItem->presence_count = $presenceCountAfterBirthday;
                        $invoiceItem->rate = $endRate;
                        $invoiceItem->amount = $kidAgeAtEndOfMonthTotal;
                        $invoiceItem->ministry_share = $miniShareAfterBD;
                        $invoiceItem->subsidized_days = $subsidizedDaysInCurrentMonthAfterBD;
                        $invoiceItem->non_subsidized_days = $ministryDaysInCurrentMonthAfterBD;
                        $invoiceItem->kid_total = $kidAgeAtEndOfMonthTotal - $miniShareAfterBD;
                        $invoiceItem->created_at = $lastDayOfMonth;
                        $invoiceItem->updated_at = $lastDayOfMonth;
                        $invoiceItem->save();
                    }

                    $totalPresenceCount += $presenceCount;
                    $totalActualAmount += $kidTotal;
                    $totalMinistryShare += $miniShare;
                    $totalInvoiceAmount += (($kidTotal + $extraCharges) - $miniShare) - $amountForSubsidizedDays;
                    $subsidaryAmount += $amountForSubsidizedDays;
                } else {
                    $presenceCount = Attendance::where('kid_id', $kid->id)
                        ->where('date', '>=', $firstDayOfMonth)
                        ->where('date', '<=', $lastDayOfMonth)
                        ->count();
                    $kidAge = GlobalHelper::calculateAgeFromDOB($kid->dob);
                    $adminSettings = AdminSetting::first();

                    if ($kidAge < 2) {
                        $rate = $adminSettings->infant ?? 49.84;
                        $defaultMinistryRate = $adminSettings->ministry_rate_infant ?? 52;
                    } elseif ($kidAge >= 2 && $kidAge < 4) {
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
                    $amountForSubsidizedDays = round($subsidizedDaysInCurrentMonth * $defaultSubsidizedRate, 2);

                    if ($subsidizedDaysInCurrentMonth > 0) {
                        // $subsidizedAmount = ($subsidizedDaysInCurrentMonth) * $rate * ($defaultSubsidizedRate / 100);
                        // if ($defaultSubsidizedRate > 0) {
                        //     $amountForSubsidizedDays = $subsidizedDaysInCurrentMonth * $rate;

                        //     if ($defaultSubsidizedRate > $amountForSubsidizedDays) {
                        //         $subsidizedAmount = $subsidizedDaysInCurrentMonth * $rate;

                        //         $remainingSubsidized = $defaultSubsidizedRate - $subsidizedAmount;
                        //         $kid->update(['subsidized_percentage' => $remainingSubsidized]);
                        //     } else {
                        //         $subsidizedAmount = $defaultSubsidizedRate;
                        //         $remainingSubsidized = $defaultSubsidizedRate - $subsidizedAmount;
                        //         $kid->update(['subsidized_percentage' => $remainingSubsidized]);
                        //     }
                        // }
                    }

                    if ($ministryDaysInCurrentMonth > 0) {
                        $ministryAmount = ($ministryDaysInCurrentMonth) * round($rate * ($defaultMinistryRate / 100), 2);
                    }


                    $miniShare = $ministryAmount;

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
                    $invoiceItem->created_at = $lastDayOfMonth;
                    $invoiceItem->updated_at = $lastDayOfMonth;
                    $invoiceItem->save();

                    $totalPresenceCount += $presenceCount;
                    $totalActualAmount += $kidTotal;
                    $totalMinistryShare += $miniShare;
                    $totalInvoiceAmount += (($kidTotal + $extraCharges) - $miniShare) - $amountForSubsidizedDays;
                    $subsidaryAmount += $amountForSubsidizedDays;
                }



                if (isset($presenceCount) && !empty($presenceCount) && $presenceCount > 0) {

                    if ($presenceCount > 0) {
                        $invoice->total_presence = $totalPresenceCount;
                        $invoice->total = $totalActualAmount;
                        $invoice->ministry_amount = $totalMinistryShare;
                        $invoice->grand_total = $totalInvoiceAmount;
                        $invoice->registeration_fee = $kidRegisterationFee;
                        // $invoice->advance_payment = $kid->advance_payment;
                        // $invoice->advance_payment = $kidSecurityDeposit;
                        $invoice->security_deposit = $kidSecurityDeposit;
                        $invoice->subsidary_amount = $subsidaryAmount;

                        $invoiceBalance = 0;

                        // if (isset($kid->advance_payment) && !empty($kid->advance_payment)) {
                        //     if ($kid->advance_payment > $totalInvoiceAmount) {
                        //         // If advance payment is greater than the total amount, maintain balance
                        //         $invoiceBalance = $balance + $kid->advance_payment;
                        //     } else {
                        //         $invoiceBalance = $kid->advance_payment;
                        //     }

                        //     $kid->advance_payment = 0;
                        //     $kid->registeration_fee = 0;
                        //     $kid->save();
                        // } else {
                        //     $invoiceBalance = $balance;
                        // }

                        $invoiceBalance = $balance;

                        if ($invoiceBalance > $totalInvoiceAmount) {
                            $finalNetAmount = 0;
                            $invoiceBalance =  $invoiceBalance - $totalInvoiceAmount;
                        } else {

                            $finalNetAmount = $totalInvoiceAmount - $invoiceBalance;
                            $invoiceBalance = 0;
                        }

                        $invoice->net_amount = $finalNetAmount;
                        $invoice->balance = $invoiceBalance;
                        $invoice->save();

                        // if (isset($invoice) && $newAmount > $invoice->net_amount) {
                        //     $invoice->balance = $invoice->balance + ($newAmount - $invoice->net_amount);
                        //     $invoice->save();
                        // }

                        if (isset($invoice) && $newAmount <= $invoice->net_amount) {
                            $invoice->balance = 0;
                            $invoice->net_amount = $invoice->net_amount - $newAmount;
                            $invoice->save();
                        } elseif (isset($invoice) && $newAmount > $invoice->net_amount) {
                            $invoice->balance = ($newAmount - $invoice->net_amount);
                            $invoice->net_amount = 0;
                            $invoice->save();
                        }

                        $securityDepositBalance = 0;

                        if (isset($previousSecurityDeposit) && !empty($previousSecurityDeposit)) {
                            if ($previousSecurityDeposit >= $invoice->net_amount) {
                                // If advance payment is greater than the total amount, maintain balance
                                $securityDepositBalance = $invoice->balance + $previousSecurityDeposit;
                            } else {
                                $securityDepositBalance = $invoice->balance + $previousSecurityDeposit;
                            }
                            $invoice->advance_payment = $previousSecurityDeposit;
                            $invoice->save();
                            $kid->advance_payment = 0;
                            $kid->save();
                        } else {
                            $securityDepositBalance = $invoice->balance;
                        }

                        if ($securityDepositBalance >= $invoice->net_amount) {
                            $finalNetAmount = 0;
                            $securityDepositBalance =  $securityDepositBalance - $invoice->net_amount;
                        } else {
                            $finalNetAmount = $invoice->net_amount - $securityDepositBalance;
                            $securityDepositBalance = 0;
                        }

                        $invoice->net_amount = $finalNetAmount;
                        $invoice->balance = $securityDepositBalance;
                        $invoice->save();
                    }
                } else {
                    $invoice->delete();
                }
            }
        }

        return redirect()->route('invoices', ['search_text' => $parent->code, 'date' => now()->format('Y-m-d')]);
    }







    public function updateInvoice(Request $request, $invoiceNumber)
    {
        $invoice = Invoice::where('invoice_number', $invoiceNumber)->first();

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found']);
        }

        // if (isset($invoice->advance_payment) && !empty($invoice->advance_payment)) {

        //     if ($invoice->advance_payment > $invoice->grand_total) {
        //         // If advance payment is greater than the total amount, maintain balance
        //         $invoiceBalance = $invoice->previous_balance + $invoice->advance_payment;
        //     } else {
        //         $invoiceBalance = $invoice->advance_payment;
        //     }
        // } else {
        //     $invoiceBalance = $invoice->previous_balance;
        // }

        // if ($invoiceBalance > $invoice->grand_total) {
        $finalNetAmount = $invoice->net_amount;
        //     $invoiceBalance =  $invoiceBalance - $invoice->grand_total;
        // } else {
        //     $finalNetAmount = $invoice->grand_total - $invoiceBalance;
        $invoiceBalance = $invoice->balance;
        // }

        // Get user input for description and amount
        $description = $request->description;
        $amount = $request->amount;

        // Update the invoice fields based on the user's modifications
        $invoice->modified_description = $description;
        $invoice->modified_amount = $amount ?: 0;
        // Save the modification

        $newTotal = 0;
        $newBalance = 0;

        $balance = $invoiceBalance;
        $newNetAmount = ($finalNetAmount + $amount);

        if ($newNetAmount >= $balance) {
            $newTotal = $newNetAmount - $balance;
            $newBalance = 0;
        } else {
            $newTotal = 0;
            $newBalance = $balance - $newNetAmount;
        }

        $ministryFund = $invoice->added_ministry_fund_type;
        $ministryFundAmount = $invoice->added_ministry_fund_amount;

        if (!empty($ministryFund) && !empty($ministryFundAmount)) {
            $fundTotal = $newTotal - $ministryFundAmount;

            if ($fundTotal > $newBalance) {
                $newTotal = $fundTotal - $newBalance;
                $newBalance = 0;
            } else {
                $newTotal = 0;
                $newBalance = $newBalance - $fundTotal;
            }
        }

        $invoice->net_amount = $newTotal;
        $invoice->balance = $newBalance;
        $invoice->save();

        return response()->json(['message' => 'Invoice updated successfully']);
    }


    public function addMinistryFund(Request $request, $invoiceNumber)
    {
        $invoice = Invoice::where('invoice_number', $invoiceNumber)->first();

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found']);
        }

        $fund = new InvoiceFund();
        $fund->invoice_id = $invoice->id;
        $fund->name = $request->ministry_fund_name;
        $fund->amount = $request->ministry_amount;
        $fund->save();

        $invoice->grand_total += $request->ministry_amount;
        $invoice->net_amount += $request->ministry_amount;
        $invoice->save();
        // if (isset($invoice->advance_payment) && !empty($invoice->advance_payment)) {

        //     if ($invoice->advance_payment > $invoice->grand_total) {
        //         // If advance payment is greater than the total amount, maintain balance
        //         $invoiceBalance = $invoice->previous_balance + $invoice->advance_payment;
        //     } else {
        //         $invoiceBalance = $invoice->advance_payment;
        //     }
        // } else {
        //     $invoiceBalance = $invoice->previous_balance;
        // }

        // if ($invoiceBalance > $invoice->grand_total) {
        //     $finalNetAmount = 0;
        //     $invoiceBalance =  $invoiceBalance - $invoice->grand_total;
        // } else {
        //     $finalNetAmount = $invoice->grand_total - $invoiceBalance;
        //     $invoiceBalance = 0;
        // }

        // $amount = $invoice->modified_amount;

        // $newTotal = 0;
        // $newBalance = 0;

        // $fundAddedTotal = 0;
        // $fundAddedBalance = 0;

        // $ministryFund = $request->ministry_fund_name;
        // $ministryFundAmount = $request->ministry_amount;

        // if (!empty($amount)) {

        //     $balance = $invoiceBalance;
        //     $newNetAmount = ($finalNetAmount + $amount);

        //     if ($newNetAmount > $balance) {
        //         $newTotal = $newNetAmount - $balance;
        //         $newBalance = 0;
        //     } else {
        //         $newTotal = 0;
        //         $newBalance = $balance - $newNetAmount;
        //     }

        //     $fundTotal = $newTotal - $ministryFundAmount;

        //     if ($fundTotal > $newBalance) {
        //         $fundAddedTotal = $fundTotal - $newBalance;
        //         $fundAddedBalance = 0;
        //     } else {
        //         $fundAddedTotal = 0;
        //         $fundAddedBalance = $newBalance - $fundTotal;
        //     }
        // } else {

        //     $fundTotal = $finalNetAmount - $ministryFundAmount;

        //     if ($fundTotal > $invoiceBalance) {
        //         $fundAddedTotal = $fundTotal - $invoiceBalance;
        //         $fundAddedBalance = 0;
        //     } else {
        //         $fundAddedTotal = 0;
        //         $fundAddedBalance = $invoiceBalance - $fundTotal;
        //     }
        // }

        // $invoice->added_ministry_fund_type = $ministryFund;
        // $invoice->added_ministry_fund_amount = $ministryFundAmount;
        // $invoice->net_amount = $fundAddedTotal;
        // $invoice->balance = $fundAddedBalance;
        // $invoice->save();

        return response()->json(['message' => 'Fund added successfully']);
    }

    // ************ Invoices Module **************



    // ************ Pay Stub Module **************


    public function payStubs(Request $request)
    {
        $user = User::find(Auth::id());

        $baseQuery = DayCarePayment::query();

        if (isset($user) && $user->hasRole('Franchise')) {
            $baseQuery->where('provider_id', $user->provider->id);
        }

        if (isset($request->search_text) && !empty($request->search_text)) {
            $searchText = strtolower($request->input('search_text'));
            $baseQuery->where(function ($query) use ($searchText) {
                $query->where('payment_number', 'LIKE', "%$searchText%")
                    ->orWhereHas('paymentItems.kid', function ($query) use ($searchText) {
                        $query->where('full_name', 'LIKE', "%$searchText%");
                    });
            });
        }

        if (isset($request->date) && !empty($request->date)) {
            $baseQuery->where(function ($query) use ($request) {
                $query->whereDate('date', $request->date);
            });
        }

        $payments = $baseQuery->with('provider')->latest()->paginate(10);

        foreach ($payments as $payment) {
            $netAmount = $payment->net_amount;
            $paidAmount = PaidPayment::where('provider_id', $payment->provider_id)
                ->whereMonth('date', Carbon::parse($payment->created_at))->sum('amount');

            if ($paidAmount > 0 && $paidAmount < $netAmount) {
                $payment->payment_status = 'Partially Paid';
            } elseif ($netAmount == $paidAmount || $paidAmount > $netAmount) {
                $payment->payment_status = 'Paid';
            } else {
                $payment->payment_status = 'Unpaid';
            }
        }

        return view('pay-stubs', compact('payments'));
    }


    public function getParents(Request $request)
    {
        $baseQuery = Parents::query();

        // Search Parents based on coming text
        if (isset($request->search_text) && !empty($request->search_text)) {
            $searchText = strtolower($request->input('search_text'));
            $baseQuery->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', "%$searchText%")
                    ->orWhere('code', 'LIKE', "%$searchText%")
                    ->orWhere('phone_number', 'LIKE', "%$searchText%")
                    ->orWhere('email', 'LIKE', "%$searchText%")
                    ->orWhere('city', 'LIKE', "%$searchText%")
                    ->orWhereHas('provider', function ($subQuery) use ($searchText) {
                        $subQuery->where('name', 'LIKE', "%$searchText%");
                    });
            });
        }

        // Search parents based on coming text

        $parents = $baseQuery->where('status', 1)->latest()->paginate(10);

        return view('payments.get-parents', compact('parents'));
    }


    public function generatePayment($code, Request $request)
    {
        $provider = DaycareProvider::where('id', $code)->first();

        $payment = '';

        if (!$provider) {
            return redirect()->back()->with('error', 'Provider not found.');
        }

        if (empty($provider->infant_percentage)) {
            return redirect()->back()->with('error', 'Infant percentage is not set for this provider');
        }

        if (empty($provider->toddler_percentage)) {
            return redirect()->back()->with('error', 'Toddler percentage is not set for this provider');
        }

        if (empty($provider->pre_school_percentage)) {
            return redirect()->back()->with('error', 'Pre school percentage is not set for this provider');
        }

        // Logic for setting the last day and month of the invoice
        $selectedDate = now();

        if (isset($request->selected_month) && (!empty($request->selected_month)) && ($request->selected_month == 'previous_complete' || $request->selected_month == 'previous_second_fortnight' || $request->selected_month == 'previous_first_fortnight')) {
            $selectedDate = $selectedDate->subMonth();
        }

        $currentMonth = $selectedDate->month;
        $firstDayOfMonth = $selectedDate->copy()->startOfMonth();
        $lastDayOfMonth = $selectedDate->copy()->setDay($selectedDate->daysInMonth);

        if ($request->selected_month == 'current_first_fortnight' || $request->selected_month == 'previous_first_fortnight') {
            // Treat it as the first fortnight
            $lastDayOfMonth = $selectedDate->copy()->startOfMonth()->addDays(14);
        } elseif ($request->selected_month == 'current_second_fortnight' || $request->selected_month == 'previous_second_fortnight') {
            // Treat it as the second fortnight
            $lastDayOfMonth = $selectedDate->copy()->setDay($selectedDate->daysInMonth);
        }
        // Logic for setting the last day and month of the invoice

        $balance = 0;

        $existingPayment = DayCarePayment::where('provider_id', $provider->id)
            ->whereMonth('created_at', $currentMonth)
            ->first();

        $modifiedDescription = '';
        $modifiedAmount = 0;
        $fundDescription = '';
        $fundAmount = 0;
        $previousPaymentId = '';

        if ($existingPayment && !empty($existingPayment)) {
            $balance = $existingPayment->balance;
            $modifiedDescription = $existingPayment->modified_description;
            $modifiedAmount = $existingPayment->modified_amount;
            $previousPaymentId = $existingPayment->id;
            $existingPayment->delete();
        }

        $existingkids = Kid::where('provider_id', $provider->id)->where('status', 1)->pluck('id')->toArray();
        $tempKids = Attendance::whereNotIn('kid_id', $existingkids)->where('provider_id', $provider->id)->whereNotNull('kid_id')->distinct()->pluck('kid_id')->toArray();
        $kidIds = array_merge($existingkids, $tempKids);
        $allKids = Kid::whereIn('id', $kidIds)->get();

        $total_no_of_days = 0;
        $total = 0;

        // Check if there are kids with presence count greater than 0
        $hasKidsWithPresence = false;

        $previousPayment = DayCarePayment::where('provider_id', $provider->id)->latest()->first();
        if ($previousPayment) {
            $balance = $previousPayment->balance;
        }

        $paymentNumber = GlobalHelper::generatePaymentNumber($provider->code, $selectedDate, $provider->id);
        $payment = new DayCarePayment();
        $payment->provider_id = $provider->id;
        $payment->payment_number = $paymentNumber;
        $payment->date = now();
        $payment->save();

        if (isset($previousPaymentId) && !empty($previousPaymentId)) {
            $previousFundings = PaymentFunding::where('payment_id', $previousPaymentId)->get();
            if (isset($previousFundings) && !empty($previousFundings) && count($previousFundings) > 0) {
                foreach ($previousFundings as $pf) {
                    $pf->payment_id = $payment->id;
                    $pf->save();
                }
            }
        }

        $providerAttendance = 0;

        foreach ($allKids as $kid) {
            $kidAgeAtEndOfMonth = GlobalHelper::calculateAgeForPayment($kid->dob, $lastDayOfMonth);
            $kidAgeAtStartOfMonth = GlobalHelper::calculateAgeForPayment($kid->dob, $firstDayOfMonth);

            // Check if the kid's birthday is in the current month
            $birthdayInCurrentMonth = Carbon::parse($kid->dob)->month == $currentMonth;
            $rateChangeAfterBirthday = false;

            if ($kidAgeAtStartOfMonth < 2) {
                $startRate = $provider->infant_percentage;
            } elseif ($kidAgeAtStartOfMonth >= 2 && $kidAgeAtStartOfMonth < 4) {
                $startRate = $provider->toddler_percentage;
            } else {
                $startRate = $provider->pre_school_percentage;
            }

            if ($kidAgeAtEndOfMonth < 2) {
                $endRate = $provider->infant_percentage;
            } elseif ($kidAgeAtEndOfMonth >= 2 && $kidAgeAtEndOfMonth < 4) {
                $endRate = $provider->toddler_percentage;
            } else {
                $endRate = $provider->pre_school_percentage;
            }

            if (isset($startRate) && isset($endRate) && $startRate != $endRate) {
                $rateChangeAfterBirthday = true;
            }

            if (isset($birthdayInCurrentMonth) && !empty($birthdayInCurrentMonth) && $rateChangeAfterBirthday) {

                $presenceCountFirstFortnightBeforeBd = 0;
                $presenceCountFirstFortnightAfterBD = 0;
                $presenceCountSecondFortnightBeforeBD = 0;
                $presenceCountSecondFortnightAfterBD = 0;
                $firstFornightBeforeBDTotal = 0;
                $firstFornightAfterBDTotal = 0;
                $secondFornightBeforeBDTotal = 0;
                $secondFornightAfterBDTotal = 0;

                // Calculate the presence count for the current month
                $presenceCount = Attendance::where('kid_id', $kid->id)->where('provider_id', $provider->id)
                    ->whereMonth('date', $currentMonth)->whereDate('date', '<=', $lastDayOfMonth)->whereNotNull('kid_id')
                    ->count();

                $providerAttendance = max($providerAttendance, $presenceCount);

                if ($request->selected_month == 'current_first_fortnight' || $request->selected_month == 'previous_first_fortnight' || $request->selected_month == 'previous_complete' || $request->selected_month == 'current_complete') {
                    $presenceCountFirstFortnightBeforeBd = Attendance::where('kid_id', $kid->id)->where('provider_id', $provider->id)
                        ->whereMonth('date', $currentMonth)
                        ->whereDay('date', '<=', 15)
                        ->whereDay('date', '<', Carbon::parse($kid->dob)->day)->whereNotNull('kid_id')
                        ->count();

                    $presenceCountFirstFortnightAfterBD = Attendance::where('kid_id', $kid->id)->where('provider_id', $provider->id)
                        ->whereMonth('date', $currentMonth)
                        ->whereDay('date', '<=', 15)
                        ->whereDay('date', '>=', Carbon::parse($kid->dob)->day)->whereNotNull('kid_id')
                        ->count();
                }

                if ($request->selected_month == 'current_second_fortnight' || $request->selected_month == 'previous_second_fortnight' || $request->selected_month == 'previous_complete' || $request->selected_month == 'current_complete') {
                    $presenceCountSecondFortnightBeforeBD = Attendance::where('kid_id', $kid->id)->where('provider_id', $provider->id)
                        ->whereMonth('date', $currentMonth)
                        ->whereDay('date', '>', 15)
                        ->whereDay('date', '<', Carbon::parse($kid->dob)->day)->whereNotNull('kid_id')
                        ->count();

                    $presenceCountSecondFortnightAfterBD = Attendance::where('kid_id', $kid->id)->where('provider_id', $provider->id)
                        ->whereMonth('date', $currentMonth)
                        ->whereDay('date', '>', 15)
                        ->whereDay('date', '>=', Carbon::parse($kid->dob)->day)->whereNotNull('kid_id')
                        ->count();
                }

                if ($presenceCount > 0) {

                    $hasKidsWithPresence = true;

                    $firstFornightBeforeBDTotal = $startRate * $presenceCountFirstFortnightBeforeBd;
                    $firstFornightAfterBDTotal =  $endRate * $presenceCountFirstFortnightAfterBD;

                    $secondFornightBeforeBDTotal = $startRate * $presenceCountSecondFortnightBeforeBD;
                    $secondFornightAfterBDTotal = $endRate * $presenceCountSecondFortnightAfterBD;
                    // Calculate the kid's total based on rate and presence count
                    $firstFornightTotal = $firstFornightBeforeBDTotal + $firstFornightAfterBDTotal;
                    $secondFornightTotal = $secondFornightBeforeBDTotal + $secondFornightAfterBDTotal;

                    if ($request->selected_month == 'current_second_fortnight' || $request->selected_month == 'previous_second_fortnight' || $request->selected_month == 'previous_complete' || $request->selected_month == 'current_complete') {
                        $kidTotal = $firstFornightTotal + $secondFornightTotal;
                    } else {

                        $kidTotal = $firstFornightTotal;
                    }

                    // Create an invoice data record for each kid
                    if ($presenceCountFirstFortnightBeforeBd > 0) {
                        $paymentItem1 = new DayCarePaymentItem();
                        $paymentItem1->payment_id = $payment->id;
                        $paymentItem1->kid_id = $kid->id;
                        $paymentItem1->kid_age = $kidAgeAtStartOfMonth;
                        $paymentItem1->no_of_days = $presenceCountFirstFortnightBeforeBd;
                        $paymentItem1->rate = $startRate;
                        $paymentItem1->amount = $firstFornightBeforeBDTotal;
                        $paymentItem1->created_at = $lastDayOfMonth;
                        $paymentItem1->first_fortnight = 1;
                        $paymentItem1->save();
                    }

                    if ($presenceCountFirstFortnightAfterBD > 0) {
                        $paymentItem2 = new DayCarePaymentItem();
                        $paymentItem2->payment_id = $payment->id;
                        $paymentItem2->kid_id = $kid->id;
                        $paymentItem2->kid_age = $kidAgeAtStartOfMonth;
                        $paymentItem2->no_of_days = $presenceCountFirstFortnightAfterBD;
                        $paymentItem2->rate = $endRate;
                        $paymentItem2->amount = $firstFornightAfterBDTotal;
                        $paymentItem2->created_at = $lastDayOfMonth;
                        $paymentItem2->first_fortnight = 1;
                        $paymentItem2->save();
                    }

                    if ($presenceCountSecondFortnightBeforeBD > 0 && ($request->selected_month == 'current_second_fortnight' || $request->selected_month == 'previous_second_fortnight' || $request->selected_month == 'previous_complete' || $request->selected_month == 'current_complete')) {
                        $paymentItem3 = new DayCarePaymentItem();
                        $paymentItem3->payment_id = $payment->id;
                        $paymentItem3->kid_id = $kid->id;
                        $paymentItem3->kid_age = $kidAgeAtEndOfMonth;
                        $paymentItem3->no_of_days = $presenceCountSecondFortnightBeforeBD;
                        $paymentItem3->rate = $startRate;
                        $paymentItem3->amount = $secondFornightBeforeBDTotal;
                        $paymentItem3->created_at = $lastDayOfMonth;
                        $paymentItem3->second_fortnight = 1;
                        $paymentItem3->save();
                    }

                    if ($presenceCountSecondFortnightAfterBD > 0 && ($request->selected_month == 'current_second_fortnight' || $request->selected_month == 'previous_second_fortnight' || $request->selected_month == 'previous_complete' || $request->selected_month == 'current_complete')) {
                        $paymentItem4 = new DayCarePaymentItem();
                        $paymentItem4->payment_id = $payment->id;
                        $paymentItem4->kid_id = $kid->id;
                        $paymentItem4->kid_age = $kidAgeAtEndOfMonth;
                        $paymentItem4->no_of_days = $presenceCountSecondFortnightAfterBD;
                        $paymentItem4->rate = $endRate;
                        $paymentItem4->amount = $secondFornightAfterBDTotal;
                        $paymentItem4->created_at = $lastDayOfMonth;
                        $paymentItem4->second_fortnight = 1;
                        $paymentItem4->save();
                    }

                    $total_no_of_days += $presenceCount;
                    $total += $kidTotal;
                }
            } else {

                // Calculate the presence count for the current month
                $presenceCount = Attendance::where('kid_id', $kid->id)->where('provider_id', $provider->id)
                    ->whereMonth('date', $currentMonth)->whereDate('date', '<=', $lastDayOfMonth)->whereNotNull('kid_id')
                    ->count();

                $providerAttendance = max($providerAttendance, $presenceCount);

                if ($request->selected_month == 'current_first_fortnight' || $request->selected_month == 'previous_first_fortnight' || $request->selected_month == 'previous_complete' || $request->selected_month == 'current_complete') {
                    $presenceCountFirstFortnight = Attendance::where('kid_id', $kid->id)->where('provider_id', $provider->id)
                        ->whereMonth('date', $currentMonth)
                        ->whereDay('date', '<=', 15)->whereNotNull('kid_id')
                        ->count();
                } else {
                    $presenceCountFirstFortnight = 0;
                }

                if ($request->selected_month == 'current_second_fortnight' || $request->selected_month == 'previous_second_fortnight' || $request->selected_month == 'previous_complete' || $request->selected_month == 'current_complete') {
                    $presenceCountSecondFortnight = Attendance::where('kid_id', $kid->id)->where('provider_id', $provider->id)
                        ->whereMonth('date', $currentMonth)
                        ->whereDay('date', '>', 15)->whereNotNull('kid_id')
                        ->count();
                } else {
                    $presenceCountSecondFortnight = 0;
                }

                if ($presenceCount > 0) {

                    $hasKidsWithPresence = true;

                    $kidAge = GlobalHelper::calculateAgeFromDOB($kid->dob);

                    // Get rate settings based on kid's age
                    if ($kidAge < 2) {
                        $rate = $provider->infant_percentage;
                    } elseif ($kidAge >= 2 && $kidAge < 4) {
                        $rate = $provider->toddler_percentage;
                    } else {
                        $rate = $provider->pre_school_percentage;
                    }

                    // Calculate the kid's total based on rate and presence count
                    $firstFornightTotal = $rate * $presenceCountFirstFortnight;
                    $secondFornightTotal = $rate * $presenceCountSecondFortnight;

                    if ($request->selected_month == 'current_second_fortnight' || $request->selected_month == 'previous_second_fortnight' || $request->selected_month == 'previous_complete' || $request->selected_month == 'current_complete') {
                        $kidTotal = $firstFornightTotal + $secondFornightTotal;
                    } else {

                        $kidTotal = $firstFornightTotal;
                    }

                    // Create an invoice data record for each kid
                    if ($presenceCountFirstFortnight > 0) {
                        $paymentItem5 = new DayCarePaymentItem();
                        $paymentItem5->payment_id = $payment->id;
                        $paymentItem5->kid_id = $kid->id;
                        $paymentItem5->kid_age = $kidAge;
                        $paymentItem5->no_of_days = $presenceCountFirstFortnight;
                        $paymentItem5->rate = $rate;
                        $paymentItem5->amount = $firstFornightTotal;
                        $paymentItem5->created_at = $lastDayOfMonth;
                        $paymentItem5->first_fortnight = 1;
                        $paymentItem5->save();
                    }

                    if ($presenceCountSecondFortnight > 0 && ($request->selected_month == 'current_second_fortnight' || $request->selected_month == 'previous_second_fortnight' || $request->selected_month == 'previous_complete' || $request->selected_month == 'current_complete')) {
                        $paymentItem6 = new DayCarePaymentItem();
                        $paymentItem6->payment_id = $payment->id;
                        $paymentItem6->kid_id = $kid->id;
                        $paymentItem6->kid_age = $kidAge;
                        $paymentItem6->no_of_days = $presenceCountSecondFortnight;
                        $paymentItem6->rate = $rate;
                        $paymentItem6->amount = $secondFornightTotal;
                        $paymentItem6->created_at = $lastDayOfMonth;
                        $paymentItem6->second_fortnight = 1;
                        $paymentItem6->save();
                    }

                    $total_no_of_days += $presenceCount;
                    $total += $kidTotal;
                }
            }
        }

        if ($hasKidsWithPresence) {

            $providerHcegFund = 0;
            $providerGogFund = 0;

            if (!empty($provider->hceg_funding)) {
                $providerHcegFund = $provider->hceg_funding * $providerAttendance;
            }

            if (!empty($provider->ministry_funding)) {
                $providerGogFund = $provider->ministry_funding * $providerAttendance;
            }

            $total += $providerHcegFund + $providerGogFund;

            $totalBalance = 0;
            $finalNetAmount = 0;

            if ($balance > $total) {
                $finalNetAmount = 0;
                $totalBalance =  $balance - $total;
            } else {
                $finalNetAmount = $total - $balance;
                $totalBalance = 0;
            }

            // if (!empty($provider->ministry_funding) && !empty($provider->hceg_funding)) {
            //     $funding = $provider->ministry_funding + $provider->hceg_funding;
            // } elseif (!empty($provider->ministry_funding)) {
            //     $funding = $provider->ministry_funding;
            // } elseif (!empty($provider->hceg_funding)) {
            //     $funding = $provider->hceg_funding;
            // }else{
            //  $funding = 0;
            // }

            $payment->total_no_of_days = $total_no_of_days; // Save total presence count
            $payment->total = $total; // Save total payment amount
            $payment->net_amount = $finalNetAmount/*+ $funding */; // Save total payment amount
            $payment->previous_balance = $balance; // Save total payment amount
            $payment->balance = $totalBalance; // Save total payment amount
            $payment->created_at = $lastDayOfMonth;
            $payment->modified_description = $modifiedDescription;
            $payment->modified_amount = $modifiedAmount;
            $payment->added_ministry_fund_type = $fundDescription;
            $payment->added_ministry_fund_amount = $fundAmount;
            $payment->hceg_fund = $providerHcegFund;
            $payment->gog_fund = $providerGogFund;
            $payment->provider_presence = $providerAttendance;
            $payment->save();
            // Send Email
        } else {
            $payment->delete();
        }

        $payment = DayCarePayment::where('id', $payment->id)->with('provider', 'paymentItems.kid')->first();

        if (isset($payment) && !empty($payment)) {
            return redirect()->route('view.payment', ['paymentId' => $payment->payment_number]);
        } else {
            return redirect()->back()->with('error', 'No generateable days found for this provider');
        }
    }

    public function updatePayment(Request $request, $paymentNumber)
    {
        $payment = DayCarePayment::where('payment_number', $paymentNumber)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found']);
        }

        // $provider = DaycareProvider::where('id', $payment->provider_id)->first();

        $previousBalance = $payment->previous_balance;

        $paymentBalance = 0;
        $finalNetAmount = 0;

        if ($previousBalance > $payment->total) {
            // $finalNetAmount = 0;
            $paymentBalance =  $previousBalance - $payment->total;
        } else {
            $finalNetAmount = $payment->total - $previousBalance;
            // $paymentBalance = 0;
        }

        // Get user input for description and amount
        $description = $request->description;
        $amount = $request->amount;

        // Update the invoice fields based on the user's modifications
        $payment->modified_description = $description;
        $payment->modified_amount = $amount ?: 0;
        // Save the modification

        $newTotal = 0;
        $newBalance = 0;

        $newNetAmount = ($finalNetAmount + $amount);

        if ($newNetAmount > $paymentBalance) {
            $newTotal = $newNetAmount - $paymentBalance;
            $newBalance = 0;
        } else {
            $newTotal = 0;
            $newBalance = $paymentBalance - $newNetAmount;
        }

        $ministryFund = $payment->added_ministry_fund_type;
        $ministryFundAmount = $payment->added_ministry_fund_amount;

        if (!empty($ministryFund) && !empty($ministryFundAmount)) {
            $fundTotal = $newTotal + $ministryFundAmount;

            if ($fundTotal > $newBalance) {
                $newTotal = $fundTotal - $newBalance;
                $newBalance = 0;
            } else {
                $newTotal = 0;
                $newBalance = $newBalance - $fundTotal;
            }
        }

        $payment->net_amount = $newTotal;
        $payment->balance = $newBalance;
        $payment->save();

        return response()->json(['message' => 'Payment updated successfully']);
    }

    public function addMinistryFundInPayment(Request $request, $paymentNumber)
    {
        $payment = DayCarePayment::where('payment_number', $paymentNumber)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found']);
        }

        $fund = new PaymentFunding();
        $fund->payment_id = $payment->id;
        $fund->name = $request->ministry_fund_name;
        $fund->amount = $request->ministry_amount;
        $fund->save();

        $payment->total += $request->ministry_amount;
        $payment->net_amount += $request->ministry_amount;
        $payment->save();
        // $previousBalance = $payment->previous_balance;

        // $paymentBalance = 0;
        // $finalNetAmount = 0;

        // if ($previousBalance > $payment->total) {
        //     // $finalNetAmount = 0;
        //     $paymentBalance =  $previousBalance - $payment->total;
        // } else {
        //     $finalNetAmount = $payment->total - $previousBalance;
        //     // $paymentBalance = 0;
        // }

        // // Get user input for description and amount
        // $amount = $payment->modified_amount;

        // $newTotal = 0;
        // $newBalance = 0;

        // $fundAddedTotal = 0;
        // $fundAddedBalance = 0;

        // $ministryFund = $request->ministry_fund_name;
        // $ministryFundAmount = $request->ministry_amount;

        // if (!empty($amount)) {
        //     $newNetAmount = ($finalNetAmount + $amount);

        //     if ($newNetAmount > $paymentBalance) {
        //         $newTotal = $newNetAmount - $paymentBalance;
        //         $newBalance = 0;
        //     } else {
        //         $newTotal = 0;
        //         $newBalance = $paymentBalance - $newNetAmount;
        //     }

        //     $fundTotal = $newTotal + $ministryFundAmount;
        //     if ($fundTotal > $newBalance) {
        //         $fundAddedTotal = $fundTotal - $newBalance;
        //         $fundAddedBalance = 0;
        //     } else {
        //         $fundAddedTotal = 0;
        //         $fundAddedBalance = $newBalance - $fundTotal;
        //     }
        // } else {

        //     $fundTotal = $finalNetAmount + $ministryFundAmount;

        //     if ($fundTotal > $paymentBalance) {
        //         $fundAddedTotal = $fundTotal - $paymentBalance;
        //         $fundAddedBalance = 0;
        //     } else {
        //         $fundAddedTotal = 0;
        //         $fundAddedBalance = $paymentBalance - $fundTotal;
        //     }
        // }

        // $payment->added_ministry_fund_type = $ministryFund;
        // $payment->added_ministry_fund_amount = $ministryFundAmount;
        // $payment->net_amount = $fundAddedTotal;
        // $payment->balance = $fundAddedBalance;
        // $payment->save();

        return response()->json(['message' => 'Fund added successfully']);
    }
    // ************ Pay Stub Module **************


    public function sendPaymentAsEmail(Request $request)
    {
        $type = $request->type;
        $number = $request->number;

        if (empty($type) || empty($number)) {
            return redirect()->back()->with('error', 'Invoice or payment number is required.');
        }

        if ($type == 'invoice') {

            $invoice = Invoice::where('invoice_number', $number)->with('parent', 'provider', 'invoiceItems.kid')->first();

            if (!$invoice) {
                return redirect()->back()->with('error', ' Invoice not found.');
            }

            $formattedDate = Carbon::parse($invoice->created_at);
            $alreadyPaid = InvoiceReceivedPayment::where('kid_id', $invoice->kid_id)->whereMonth('date', $formattedDate)->value('amount') ?? 0;

            $type = 'InvoiceGenerated';
            $recipients = User::where('id', $invoice->parent->user_id)->pluck('id')->toArray();

            if (isset($recipients) && !empty($recipients) && count($recipients) > 0) {
                GlobalHelper::sendUpdateNotification($recipients, $type);
            }

            $monthName = Carbon::parse($invoice->created_at)->format('F');

            $html = View::make('pdf.invoice', compact('invoice', 'alreadyPaid'))->render();
            // Create a new Dompdf instance
            $pdf = new Dompdf([
                'isPhpEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'chroot' => public_path(),
            ]);
            // Load HTML content into Dompdf
            $pdf->loadHtml($html);
            // (Optional) Set paper size and orientation
            $pdf->setPaper('A4', 'portrait');
            // Render the PDF
            $pdf->render();
            $pdfOutput = $pdf->output();

            Mail::send([], [], function ($message) use ($invoice, $monthName, $pdfOutput) {
                $message->to('usamayaqub302@gmail.com')->subject("Your monthly invoice for $monthName is here.")
                ->text("Dear {$invoice->kid->full_name} Parent,\n\nYour invoice for the month of $monthName is attached. Please find herewith the attachment.")
                ->attachData($pdfOutput, 'invoice.pdf', [
                    'mime' => 'application/pdf',
                ]);
            });

            // GlobalHelper::sendEmail($invoice->parent->email, "Guess what? It's that time of the month again! Your monthly invoice for $monthName is here.", 'pdf.invoice', $data);
        } elseif ($type == 'payment') {

            $payment = DayCarePayment::where('payment_number', $number)->with('provider', 'paymentItems.kid')->first();

            if (!$payment) {
                return redirect()->back()->with('error', 'Payment not found.');
            }

            $formattedDate = Carbon::parse($payment->created_at);
            $alreadyPaid = PaidPayment::where('provider_id', $payment->provider_id)->whereMonth('date', $formattedDate)->value('amount') ?? 0;

            // Send Notification
            $type = 'PaymentGenerated';

            // Admin and parent
            $recipients = User::where('id', $payment->provider->user_id)->pluck('id')->toArray();
            // Admin and parent

            if (isset($recipients) && !empty($recipients) && count($recipients) > 0) {
                GlobalHelper::sendUpdateNotification($recipients, $type);
            }

            $data = [
                'payment' => $payment,
            ];

            $monthName = Carbon::parse($payment->created_at)->format('F');
            $html = View::make('pdf.payment', compact('payment', 'alreadyPaid'))->render();
            // Create a new Dompdf instance
            $pdf = new Dompdf([
                'isPhpEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'chroot' => public_path(),
            ]);
            // Load HTML content into Dompdf
            $pdf->loadHtml($html);
            // (Optional) Set paper size and orientation
            $pdf->setPaper('A4', 'portrait');
            // Render the PDF
            $pdf->render();
            $pdfOutput = $pdf->output();

            Mail::send([], [], function ($message) use ($payment, $monthName, $pdfOutput) {
                $message->to($payment->provider->email)->subject("Your monthly payment for $monthName is here.")
                ->text("Dear {$payment->provider->name},\n\nYour payment for the month of $monthName is generated. Please find herewith the attachment.")
                ->attachData($pdfOutput, 'vendor-payment.pdf', [
                    'mime' => 'application/pdf',
                ]);
            });
            // GlobalHelper::sendEmail($payment->provider->email, "Guess what? It's that time of the month again! Your monthly payment for $monthName is here.", 'pdf.payment', $data);
            // Send Email
        }

        return redirect()->back()->with('success', 'Email sent successfully.');
    }



    public function payInvoice(Request $request)
    {
        $amount = $request->amount;
        $date = $request->invoiceDate;
        $kidId = $request->kid_id;
        $netAmount = $request->net_amount;

        $formattedDate = Carbon::parse($request->invoiceDate);
        $month = $formattedDate->month;
        $formattedPaymentDate = Carbon::parse($request->payment_date);


        if (!empty($amount) && !empty($date)) {

            $invoice = Invoice::where('kid_id', $kidId)->whereMonth('created_at', $month)->first();

            $existingRecord = InvoiceReceivedPayment::where('kid_id', $kidId)->whereMonth('date', $formattedDate)->first();

            // if(isset($existingRecord) && empty($invoice->net_amount))
            // {
            //     $newAmount = $existingRecord->amount + $amount;
            //     $existingRecord->amount = $newAmount;
            //     $existingRecord->created_at = $formattedPaymentDate;
            //     $existingRecord->save();

            //     if (isset($invoice)) {
            //         $invoice->balance = $invoice->balance + $amount;
            //         $invoice->save();
            //     }

            // }
            // else
            if (isset($existingRecord)) {
                $newAmount = $existingRecord->amount + $amount;
                $existingRecord->amount = $newAmount;
                $existingRecord->created_at = $formattedPaymentDate;
                $existingRecord->save();

                if (isset($invoice) && empty($netAmount)) {
                    $invoice->balance = $invoice->balance + $amount;
                    $invoice->save();
                } elseif (isset($invoice) && $amount <= $netAmount) {
                    // $invoice->balance
                    $invoice->balance = 0;
                    $invoice->net_amount = $netAmount - $amount;
                    $invoice->save();
                } elseif (isset($invoice) && $amount > $netAmount) {
                    $invoice->balance = ($amount - $netAmount);
                    $invoice->net_amount = 0;
                    $invoice->save();
                }
            }
            // elseif(isset($existingRecord) && !empty($invoice->net_amount) && !empty($invoice->advance_payment))
            // {
            //     $netAmount = $invoice->net_amount;
            //     $newAmount = $amount;
            //     if (isset($invoice) && $newAmount <= $netAmount) {
            //         // $invoice->balance
            //         $invoice->balance = 0;
            //         $invoice->net_amount = $netAmount;
            //         $invoice->save();
            //     } elseif (isset($invoice) && $newAmount > $netAmount) {
            //         $invoice->balance = ($newAmount - $netAmount);
            //         $invoice->save();
            //     }
            //     $existingRecord->amount = $existingRecord->amount + $newAmount;
            //     $existingRecord->created_at = $formattedPaymentDate;
            //     $existingRecord->save();
            // }
            // elseif (isset($existingRecord) && !empty($invoice->net_amount)) {
            //     $newAmount = $existingRecord->amount + $amount;
            //     if (isset($invoice) && $newAmount <= $netAmount) {
            //         // $invoice->balance
            //         $invoice->balance = 0;
            //         $invoice->save();
            //     } elseif (isset($invoice) && $newAmount > $netAmount) {
            //         // $invoice->balance+
            //         $invoice->balance = ($newAmount - $netAmount);
            //         $invoice->save();
            //     }
            //     $existingRecord->amount = $newAmount;
            //     $existingRecord->created_at = $formattedPaymentDate;
            //     $existingRecord->save();
            // } 
            // elseif(!empty($invoice->advance_payment))
            // {
            //     $netAmount = $invoice->net_amount; 
            //     $newAmount = $amount;  

            //     if (isset($invoice) && $newAmount <= $netAmount) {
            //         // $invoice->balance
            //         $invoice->balance = 0;
            //         $invoice->net_amount = $netAmount;
            //         $invoice->save();
            //     } elseif (isset($invoice) && $newAmount > $netAmount) {
            //         $invoice->balance = ($newAmount - $netAmount);
            //         $invoice->save();
            //     }
            //     $record = new InvoiceReceivedPayment();
            //     $record->kid_id = $kidId;
            //     $record->amount = $amount;
            //     $record->date = $formattedDate;
            //     $record->created_at = $formattedPaymentDate;
            //     $record->save();
            // }
            else {
                // if (isset($invoice) && $amount <= $netAmount) {
                //     $invoice->balance = 0;
                //     $invoice->save();
                // } elseif (isset($invoice) && $amount > $netAmount) {
                //     $invoice->balance = ($amount - $netAmount);
                //     $invoice->save();
                // }
                if (isset($invoice) && empty($netAmount)) {
                    $invoice->balance = $invoice->balance + $amount;
                    $invoice->save();
                } elseif (isset($invoice) && $amount <= $netAmount) {
                    // $invoice->balance
                    $invoice->balance = 0;
                    $invoice->net_amount = $netAmount - $amount;
                    $invoice->save();
                } elseif (isset($invoice) && $amount > $netAmount) {
                    $invoice->balance = ($amount - $netAmount);
                    $invoice->net_amount = 0;
                    $invoice->save();
                }

                $record = new InvoiceReceivedPayment();
                $record->kid_id = $kidId;
                $record->amount = $amount;
                $record->date = $formattedDate;
                $record->created_at = $formattedPaymentDate;
                $record->save();
            }

            return response()->json(['paidAmount' => $amount]);
        }

        return response()->json(['error' => 'Something went wrong'], 400);
    }

    public function payPayment(Request $request)
    {
        $amount = $request->amount;
        $date = $request->paymentDate;
        $providerId = $request->provider_id;
        $netAmount = $request->net_amount;

        $formattedDate = Carbon::parse($request->paymentDate);
        $month = $formattedDate->month;
        $formattedPaymentDate = Carbon::parse($request->payment_date);

        if (!empty($amount) && !empty($date)) {

            $payment = DayCarePayment::where('provider_id', $providerId)->whereMonth('created_at', $month)->first();

            $existingRecord = PaidPayment::where('provider_id', $providerId)->whereMonth('date', $formattedDate)->first();

            if ($existingRecord) {
                $newAmount = $existingRecord->amount + $amount;
                if (isset($payment) && $newAmount > $netAmount) {
                    $payment->balance = $newAmount - $netAmount;
                    $payment->save();
                }
                $existingRecord->amount = $newAmount;
                $existingRecord->created_at = $formattedPaymentDate;
                $existingRecord->save();
            } else {

                if (isset($payment) && $amount > $netAmount) {
                    $payment->balance = $amount - $netAmount;
                    $payment->save();
                }

                $record = new PaidPayment();
                $record->provider_id = $providerId;
                $record->amount = $amount;
                $record->date = $formattedDate;
                $record->created_at = $formattedPaymentDate;
                $record->save();
            }

            return response()->json(['paidAmount' => $amount]);
        }

        return response()->json(['error' => 'Something went wrong'], 400);
    }

    public function addSecurityDeposit($invoiceNumber)
    {
        $invoice = Invoice::where('invoice_number', $invoiceNumber)->first();

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found']);
        }

        $kid = Kid::where('id', $invoice->kid_id)->first();

        if (!$kid) {
            return response()->json(['message' => 'Kid not found']);
        }

        // $alreadyPaid = InvoiceReceivedPayment::where('kid_id', $invoice->kid_id)->whereMonth('date', Carbon::parse($invoice->created_at))->value('amount');
        // $netAmount = 0;

        // if (isset($alreadyPaid) && $alreadyPaid > 0) {
        //     if ($alreadyPaid >= $invoice->net_amount) {
        //         $netAmount = 0;
        //     } else {
        //         $netAmount = round($invoice->net_amount - $alreadyPaid, 2);
        //     }
        // } else {
        //     $netAmount = round($invoice->net_amount, 2);
        // }

        // $balance = $invoice->balance;

        if (isset($kid->advance_payment) && !empty($kid->advance_payment)) {
            if ($kid->advance_payment >= $invoice->net_amount) {
                // If advance payment is greater than the total amount, maintain balance
                $invoiceBalance = $invoice->balance + $kid->advance_payment;
            } else {
                $invoiceBalance = $invoice->balance + $kid->advance_payment;
            }
            $invoice->advance_payment = $kid->advance_payment;
            $invoice->save();
            $kid->advance_payment = 0;
            $kid->save();
        } else {
            $invoiceBalance = $invoice->balance;
        }

        if ($invoiceBalance >= $invoice->net_amount) {
            $finalNetAmount = 0;
            $invoiceBalance =  $invoiceBalance - $invoice->net_amount;
        } else {
            $finalNetAmount = $invoice->net_amount - $invoiceBalance;
            $invoiceBalance = 0;
        }

        $invoice->net_amount = $finalNetAmount;
        $invoice->balance = $invoiceBalance;
        $invoice->save();

        return response()->json(['message' => 'Security depoist added successfully']);
    }
}
