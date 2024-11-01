<?php

namespace App\Helper;

use App\Jobs\SendEmailJob;
use App\Models\Attendance;
use App\Models\ClosedMonth;
use App\Models\DayCarePayment;
use App\Models\DaycareProvider;
use App\Models\Invoice;
use App\Models\Kid;
use App\Models\KidAccidentReport;
use App\Models\KidMeal;
use App\Models\NapTime;
use App\Models\Notification;
use App\Models\Parents;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Rmunate\Utilities\SpellNumber;

class GlobalHelper
{

    public static function uploadAndSaveFile($files, $destinationDirectory, $fileName = null)
    {
        $urls = [];

        foreach ($files as $key => $file) {

            if ($file instanceof UploadedFile) {

                $ext = strtolower($file->getClientOriginalExtension());

                // Generate a unique filename if not provided
                $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . $key . time() . '.' . $ext;

                $destinationPath  = public_path($destinationDirectory);

                if (!File::isDirectory($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                if (in_array($ext, ['jpeg', 'png', 'jpg', 'webp', 'gif'])) {
                    $url = $destinationDirectory . '/' . $fileName;
                    $image = Image::make($file->getRealPath());
                    $image->save($destinationPath . '/' . $fileName, config('custom.image_quality'));
                } elseif (in_array($ext, ['pdf', 'docx', 'xls', 'csv', 'xlsx', 'txt', 'text', 'docx'])) {
                    $url = $destinationDirectory . '/' . $fileName;
                    $file->move($destinationPath, $fileName);
                } else {
                    continue;
                }

                $urls[$key] = $url;
            }
        }
        return $urls;
    }



    public static function generateProviderCode()
    {
        // // Generate a random 5-digit number (to fit within the 6-digit limit)
        // $suffix = mt_rand(10000, 99999);

        // // Concatenate '1' as the prefix to the random number
        // $code = '1' . $suffix;

        // // Check if the generated code already exists in the 'Parents' table
        // while (DaycareProvider::where('code', $code)->exists()) {
        //     // If the code already exists, regenerate a new random suffix and update the code
        //     $suffix = mt_rand(10000, 99999);
        //     $code = '1' . $suffix;
        // }

        // // Return the unique generated code
        // return $code;
        // Extract the numeric part of the code
        $lastCode = DaycareProvider::latest()->value('code');

        $suffix = (int) $lastCode;
        // Increment the numeric part by 1
        $newSuffix = $suffix + 1;

        // Concatenate '1' as the prefix to the incremented suffix
        $newCode = $newSuffix;
        // Return the new incremented code
        return $newCode;
    }

    public static function generateParentCode()
    {
        // // Generate a random 5-digit number (to fit within the 6-digit limit)
        // $suffix = mt_rand(10000, 99999);

        // // Concatenate '1' as the prefix to the random number
        // $code = '3' . $suffix;

        // // Check if the generated code already exists in the 'Parents' table
        // while (Parents::where('code', $code)->exists()) {
        //     // If the code already exists, regenerate a new random suffix and update the code
        //     $suffix = mt_rand(10000, 99999);
        //     $code = '3' . $suffix;
        // }

        // // Return the unique generated code
        // return $code;

        $lastCode = Parents::latest()->value('code');

        $suffix = (int) $lastCode;
        // Increment the numeric part by 1
        $newSuffix = $suffix + 1;

        // Concatenate '1' as the prefix to the incremented suffix
        $newCode = $newSuffix;
        // Return the new incremented code
        return $newCode;
    }


    public static function generateKidCode($parentCode)
    {
        $lastCode = Kid::max('code') ?? 200000;
        $kidCode = $lastCode + 1;
        return $kidCode;
    }


    public static function generateTicketNumber()
    {
        $code = mt_rand(100000, 999999);
        // Check if the generated code already exists and regenerate if necessary
        while (Ticket::where('ticket_id', $code)->exists()) {
            $code = mt_rand(100000, 999999);
        }
        return $code;
    }

    public static function generateIncidentNumber()
    {
        $code = mt_rand(100000, 999999);
        // Check if the generated code already exists and regenerate if necessary
        while (KidAccidentReport::where('incident_number', $code)->exists()) {
            $code = mt_rand(100000, 999999);
        }
        return $code;
    }


    public static function sendEmail($to, $subject, $view, $data = [])
    {
        try {
            // Mail::send($view, $data, function ($message) use ($to, $subject) {
            //     $message->to($to)->subject($subject);
            // });
            // Dispatch the email sending job to the queue
            SendEmailJob::dispatch($to, $subject, $view, $data);
            return true; // Email job dispatched successfully
        } catch (\Exception $e) {
            info($e);
            // Log or handle any exceptions here
            return false; // Email job dispatching failed
        }
    }

    public static function getMonthlyProviderCounts()
    {
        $monthlyProviderCounts = [];

        // Initialize the array with zeros for each month.
        for ($month = 1; $month <= 12; $month++) {
            $monthlyProviderCounts[] = 0; // Add 0 to the array.
        }

        // Query the database to count providers created in each month.
        $providers = DaycareProvider::all();

        foreach ($providers as $provider) {
            $createdDate = $provider->created_at;
            $month = date('n', strtotime($createdDate)); // Extract the month (1-12).

            // Increment the count for the respective month.
            $monthlyProviderCounts[$month - 1]++; // Subtract 1 to align with array indexes.
        }

        return $monthlyProviderCounts;
    }

    public static function getMonthlyParentsCounts()
    {
        $user = User::find(Auth::id());

        if (isset($user) && !empty($user)) {

            // Query the database to count parents created in each month.
            if ($user->hasRole('Admin')) {
                $parents = Parents::all();
            } else {
                $parents = Parents::where('daycare_provider_id', $user->provider->id)->get();
            }

            $monthlyParentCounts = [];

            // Initialize the array with zeros for each month.
            for ($month = 1; $month <= 12; $month++) {
                $monthlyParentCounts[] = 0; // Add 0 to the array.
            }



            foreach ($parents as $parent) {
                $createdDate = $parent->created_at;
                $month = date('n', strtotime($createdDate)); // Extract the month (1-12).
                // Increment the count for the respective month.
                $monthlyParentCounts[$month - 1]++; // Subtract 1 to align with array indexes.
            }
            return $monthlyParentCounts;
        }
    }

    public static function getMonthlyKidCounts()
    {
        $user = User::find(Auth::id());

        if (isset($user) && !empty($user)) {
            // Query the database to count kids created in each month.
            if ($user->hasRole('Admin')) {
                $kids = Kid::all();
            } elseif ($user->hasRole('Franchise')) {
                $kids = Kid::where('provider_id', $user->provider->id)->get();
            }
            $monthlyKidCounts = [];
            // Initialize the array with zeros for each month.
            for ($month = 1; $month <= 12; $month++) {
                $monthlyKidCounts[] = 0; // Add 0 to the array.
            }

            foreach ($kids as $kid) {
                $createdDate = $kid->created_at;
                $month = date('n', strtotime($createdDate)); // Extract the month (1-12).
                // Increment the count for the respective month.
                $monthlyKidCounts[$month - 1]++; // Subtract 1 to align with array indexes.
            }
            return $monthlyKidCounts;
        }
    }



    public static function sendUpdateNotification(array $recipients, $type)
    {
        $notificationData = NotificationData::{"get" . $type . "NotificationData"}();

        if (!$notificationData) {
            // Handle unknown or missing notification type
            return;
        }

        $userIds = is_array($recipients) ? $recipients : [$recipients];
        $now = now();

        foreach ($userIds as $userId) {
            $notifications[] = [
                'user_id' => $userId,
                'type' => $notificationData['type'],
                'title' => $notificationData['title'],
                'message' => $notificationData['message'],
                'url' => $notificationData['url'],
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

    public static function isAttendanceMarked($studentId, $attendanceDate, $providerId = null)
    {
        $attendanceRecord = Attendance::where('kid_id', $studentId)->where('provider_id', $providerId)
            ->where('date', $attendanceDate)
            ->first();
        // If an attendance record exists, return true; otherwise, return false.
        return $attendanceRecord ? true : false;
    }


    public static function calculateAgeFromDOB($dob)
    {
        // $birthdate = new DateTime($dob);
        // $today = new DateTime('now');
        // $ageInterval = $birthdate->diff($today);

        // $years = $ageInterval->y;
        // $months = $ageInterval->m;
        // $days = $ageInterval->d;

        // $decimalAge = $years + ($months / 12) + ($days / 365.25);
        // // Round to 2 decimal places
        // $decimalAge = round($decimalAge, 2);

        // return $decimalAge;

        $birthdate = new DateTime($dob);
        $today = new DateTime('now');

        $ageInterval = $birthdate->diff($today);
        $years = $ageInterval->y;
        $months = $ageInterval->m;
  
        $decimalAge = $years . "." . $months;

        // Round to 2 decimal places
        // $decimalAge = number_format($decimalAge, 2);

        return $decimalAge;
    }

    public static function calculateAgeForPayment($dob, $date)
    {
        $birthdate = new DateTime($dob);
        $today = new DateTime($date);
        $ageInterval = $birthdate->diff($today);

        $years = $ageInterval->y;
        $months = $ageInterval->m;

        $decimalAge = $years . "." . $months;

        return $decimalAge;
    }


    public static function generateInvoiceNumber($kidCode, $selectedDate, $kidId)
    {

        $datePart = $selectedDate->format('my');
        $invoiceNumber = $datePart . $kidCode;

        // $existingInvoice = Invoice::where('kid_id', $kidId)->whereMonth('created_at', $selectedDate->format('m'))->first();
        // $existingInvoice = Invoice::where('invoice_number', $invoiceNumber)->first();

        // if (isset($existingInvoice) && !empty($existingInvoice)) {
        //     $invoiceNumber++;
        // }

        return $invoiceNumber;
    }

    public static function generatePaymentNumber($providerCode, $selectedDate, $providerId)
    {
        if (empty($providerCode)) {
            $providerCode = '100001';
        }

        $datePart = $selectedDate->format('my');
        $paymentNumber = $datePart . $providerCode;

        $existingPayment = DayCarePayment::where('provider_id', $providerId)->where('payment_number', $paymentNumber)->first();
        if (isset($existingPayment) && !empty($existingPayment)) {
            $paymentNumber = $existingPayment->paymentNumber++;
        }

        return $paymentNumber;
    }

    public static function convertNumberToWords($amount, $locale, $currency, $fraction)
    {
        // return true;
        // Return the formatted amount and words with currency and fraction
        return SpellNumber::value($amount)->locale($locale)->currency($currency)
            ->fraction($fraction)->toMoney();
    }


    public static function showCloseMonthButton()
    {
        try {
            // Find the last attendance date
            $lastAttendanceDate = Attendance::max('date');

            // Check if there are attendance records
            if ($lastAttendanceDate) {
                // Extract the year and month from the last attendance date
                $year = date('Y', strtotime($lastAttendanceDate));
                $month = date('n', strtotime($lastAttendanceDate));

                // Check if the month is already closed
                $isMonthClosed = ClosedMonth::where('year', $year)
                    ->where('month', $month)
                    ->exists();

                // Check if it's within the last five days of the month
                $isWithinLastFiveDays = now()->setYear($year)->setMonth($month)->endOfMonth()->diffInDays(now()) <= 5;

                return !$isMonthClosed || $isWithinLastFiveDays;
            } else {
                // If there are no attendance records, show the close button
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
    }


    public static function isAttendanceDisabled($provdierId, $attendanceDate)
    {
        try {
            // Find the current date
            $currentDate = Carbon::parse($attendanceDate);

            // Extract the year and month from the current date
            $year = date('Y', strtotime($currentDate));
            $month = date('n', strtotime($currentDate));

            // Calculate the previous month and year
            $previousMonth = ($month == 1) ? 12 : $month - 1;
            $previousYear = ($month == 1) ? $year - 1 : $year;

            $checkAttendance = Attendance::where('provider_id', $provdierId)
                ->whereMonth('date', $previousMonth)
                ->whereYear('date', $previousYear)->first();

            if ($checkAttendance) {
                // Check if the previous month is closed
                $isPreviousMonthClosed = ClosedMonth::where('year', $previousYear)
                    ->where('month', $previousMonth)
                    ->exists();
            } else {
                // If no attendance records, consider the previous month as not closed
                $isPreviousMonthClosed = true;
            }

            return !$isPreviousMonthClosed;
        } catch (\Exception $e) {
            return false;
        }
    }

}
