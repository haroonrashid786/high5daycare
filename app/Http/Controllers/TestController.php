<?php

namespace App\Http\Controllers;

use App\Helper\GlobalHelper;
use App\Models\Attendance;
use App\Models\DayCarePayment;
use App\Models\DayCarePaymentItem;
use App\Models\DaycareProvider;
use App\Models\Kid;
use App\Models\PaymentFunding;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TestController extends Controller
{
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
        $tempKids = Attendance::whereNotIn('kid_id', $existingkids)->whereMonth('date',$currentMonth)->where('provider_id', $provider->id)->whereNotNull('kid_id')->distinct()->pluck('kid_id')->toArray();
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
            } 
            else {

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

        if ($payment && isset($payment->paymentItems) && !empty($payment->paymentItems) && count($payment->paymentItems) > 0) {
            $idsToDelete = [];
            foreach ($payment->paymentItems as $paymentItem) {
                // Check if the kid's ID exists in $kidIds array
                if (!in_array($paymentItem->kid_id, $kidIds)) {
                    $idsToDelete[] = $paymentItem->id;
                }
            }
            DayCarePaymentItem::whereIn('id', $idsToDelete)->delete();
        }

        if (isset($payment) && !empty($payment)) {
            return redirect()->route('view.payment', ['paymentId' => $payment->payment_number]);
        } else {
            return redirect()->back()->with('error', 'No generateable days found for this provider');
        }
    }




}
