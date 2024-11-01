<?php

namespace App\Http\Controllers;

use App\Helper\GlobalHelper;
use App\Models\Activity;
use App\Models\ActivitySheet;
use App\Models\AdminSetting;
use App\Models\Attendance;
use App\Models\ClosedMonth;
use App\Models\DailyUpdates;
use App\Models\DayCarePayment;
use App\Models\DaycareProvider;
use App\Models\DayCareVacation;
use App\Models\Kid;
use App\Models\KidAccidentReport;
use App\Models\KidMeal;
use App\Models\KidMealItem;
use App\Models\Notification;
use App\Models\PaidPayment;
use App\Models\Parents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class ProviderController extends Controller
{

    public function index()
    {
        $authUser = User::find(Auth::id());
        // if(!$authUser->email == 'testprovider@mailinator.com')
        // {
        //     Auth::logout();
        //     return redirect()->route('login')
        //     ->with('error', 'As of now, we would like to inform you that the platform is currently undergoing its final stages of development and testing. We appreciate your enthusiasm and patience during this process.');
        // }

        $kidsQuery = Kid::where('provider_id', Auth::user()->provider->id)->where('status', 1);
        $totalKids = $kidsQuery->count();
        $totalParents = Parents::where('daycare_provider_id', Auth::user()->provider->id)->where('status', 1)->count();
        $monthlyParentCounts = GlobalHelper::getMonthlyParentsCounts();
        $monthlyKidCounts = GlobalHelper::getMonthlyKidCounts();

        $adminSettings = AdminSetting::first();
        $totalSeatsAvailable = $adminSettings->spots_allowed_to_provider;
        $totalFreeSpaces = $totalSeatsAvailable - $totalKids;

        $totalInfants = 0;
        $totalToddlers = 0;
        $totalPreschoolers = 0;

        $kids = $kidsQuery->get();
        foreach ($kids as $kid) {
            if (!empty($kid->dob)) {
                $age = GlobalHelper::calculateAgeFromDOB($kid->dob);
                if ($age < 2) {
                    $totalInfants++;
                } elseif ($age >=2 && $age < 4) {
                    $totalToddlers++;
                } else {
                    $totalPreschoolers++;
                }
            }
        }

        $kidsWithUnfilledDocuments = 0;
        $totalDocuments = 11;

        $uKids = Kid::where('provider_id', Auth::user()->provider->id)->where('status', 1)->get();

        foreach ($uKids as $u) {
            $filledDocumentsCount =
                $u->emergencyInformation()->count() +
                $u->supervision()->count() +
                $u->releaseInformation()->count() +
                $u->photoPermission()->count() +
                $u->alternateSleeping()->count() +
                $u->drugInformation()->count() +
                $u->medicationConsent()->count() +
                $u->individualPlan()->count() +
                $u->contract()->count() +
                $u->immunizationRecord()->count() +
                $u->anaphylacticEmergency()->count();

            $unfilledDocuments = $totalDocuments - $filledDocumentsCount;

            if ($unfilledDocuments !== 0) {
                $kidsWithUnfilledDocuments++;
            }
        }

        return view('provider.index', compact('totalInfants', 'totalToddlers', 'totalPreschoolers', 'monthlyParentCounts', 'monthlyKidCounts', 'totalSeatsAvailable', 'totalFreeSpaces', 'kidsWithUnfilledDocuments'));
    }

    public function parents(Request $request)
    {
        $baseQuery = Parents::query()->where('daycare_provider_id', Auth::user()->provider->id);

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
        $parents = $baseQuery->latest()->paginate(10);
        return view('provider.parents', compact('parents'));
    }

    public function kids(Request $request)
    {
        $baseQuery = Kid::query()->where('provider_id', Auth::user()->provider->id);

        if (isset($request->search_text) && !empty($request->search_text)) {
            $searchText = strtolower($request->input('search_text'));
            $baseQuery->where(function ($query) use ($searchText) {
                $query->where('full_name', 'LIKE', "%$searchText%")
                    ->orWhere('contact_number', 'LIKE', "%$searchText%")->orWhere('code', 'LIKE', "%$searchText%");
            });
        }

        if (isset($request->parent_name) && !empty($request->parent_name)) {

            $baseQuery->whereHas('parent', function ($query) use ($request) {
                $query->where('name', 'LIKE', "%$request->parent_name%");
            });
        }

        $kids = $baseQuery->latest()->paginate(10);

        return view('kids.index', compact('kids'));
    }

    public function addAttendance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'file' => 'required|mimes:csv,xls,xlsx',
        ], [
            'file.mimes' => 'The file must be a CSV, XLS, or XLSX file.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $uploadedFiles = [];

        $uploadedFile = $request->file('file');

        if ($uploadedFile) {
            $uploadedFiles['file'] = $uploadedFile;
            $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/attendance');
            $activitySheet = new Attendance();
            $activitySheet->provider_id = Auth::user()->provider->id;
            $activitySheet->date = $request->input('date');
            $activitySheet->file = $uploadedFiles['file'];
            $activitySheet->save();
        }

        return redirect()->route('attendance')->with('success', 'Attendance sheet added successfully');
    }

    public function addDailyUpdates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'files' => 'required|array',
            'files.*' => 'required|mimes:png,jpg,jpeg,webp,gif',
        ], [
            'files.required' => 'Please upload at least one file.',
            'files.*.mimes' => 'Each file must be a PNG, JPG, JPEG, WEBP, GIF file.',
        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $uploadedFiles = [];
        $filesUploaded = $request->file('files');
        $uploadedFiles = GlobalHelper::uploadAndSaveFile($filesUploaded, 'uploads/daily_updates');

        $dailyUpdate = new DailyUpdates();
        $dailyUpdate->provider_id = Auth::user()->provider->id;
        $dailyUpdate->date = $request->input('date');
        $dailyUpdate->save();

        foreach ($uploadedFiles as $filePath) {
            $filesToAssociate[] = ['file' => $filePath];
        }

        $dailyUpdate->media()->createMany($filesToAssociate);

        // Send Notification
        $type = 'DailyUpdate';
        // All parents
        $recipients = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'Parent']);
        })->pluck('id')->toArray();
        // All parents
        if (isset($recipients) && (!empty($recipients)) && count($recipients) > 0) {
            GlobalHelper::sendUpdateNotification($recipients, $type);
        }
        // Send Notification

        return redirect()->route('daily-updates')->with('success', 'Daily updates added successfully');
    }


    public function deleteDailyUpdate($id)
    {
        $dailyUpdate = DailyUpdates::find($id);

        if (!$dailyUpdate) {
            return redirect()->back()->with('error', 'Daily update not found');
        }

        if (isset($dailyUpdate->media) && !empty($dailyUpdate->media)) {
            foreach ($dailyUpdate->media as $media) {
                $filePath = public_path($media->file);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
        $dailyUpdate->delete();
        return redirect()->back()->with('success', 'Daily update deleted successfully');
    }


    public function addActivitySheet(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'kid_id' => 'required',
                'date' => 'required',
                'activity_type.*' => 'required',
                'activity_type.*' => 'max:255',
                // 'file' => 'required|mimes:csv,xls,xlsx,pdf,txt,text,doc,docx',
            ]
            // ,[
            //     'file.mimes' => 'The file must be a CSV, XLS, PDF, TXT, DOCX or XLSX file.',
            // ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // $uploadedFiles = [];
        // $uploadedFile = $request->file('file');

        $user = User::find(Auth::id());



        if (isset($user) && $user->hasRole('Franchise')) {

            // if ($uploadedFile) {
            // $uploadedFiles['file'] = $uploadedFile;
            // $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/activity_sheets');

            $activitySheet = new ActivitySheet();
            // $activitySheet->kid_id = $request->kid_id;
            $activitySheet->provider_id = $user->provider->id;
            $activitySheet->date = $request->input('date');
            // $activitySheet->file = $uploadedFiles['file'];
            $activitySheet->save();

            // }

            $activityData = [];
            $activityTypes = $request->input('activity_type');
            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

            foreach ($activityTypes as $key => $activityType) {

                $activityDataRow = [
                    'activity_sheet_id' =>  $activitySheet->id,
                    'activity_type' => $activityType,
                ];

                foreach ($daysOfWeek as $day) {
                    $activityDataRow[strtolower($day) . '_activities'] = $request->input(strtolower($day) . '_activities')[$key];
                }

                $activityDataRow['activities_adjustment'] = $request->input('activities_adjustment')[$key];

                $activityData[] = $activityDataRow;
            }

            Activity::insert($activityData);

            // Send Notification
            $type = 'ActivitySheet';

            // All franchises and parents
            $recipients = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Admin', 'Parent']);
            })->pluck('id')->toArray();
            // All franchises and parents

            if (isset($recipients) && (!empty($recipients)) && count($recipients) > 0) {
                GlobalHelper::sendUpdateNotification($recipients, $type);
            }
            // Send Notification

            return redirect()->route('activity-sheets')->with('success', 'Activity sheet added successfully');
        }
    }

    public function updateActivitySheet(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'kid_id' => 'required',
                'date' => 'required',
                'activity_type.*' => 'required',
                'activity_type.*' => 'max:255',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $activitySheet = ActivitySheet::findOrFail($id);
        if (!$activitySheet) {
            return redirect()->back()->with('error', 'Activity sheet not found');
        }

        $activitySheet->update([
            // 'kid_id' => $request->kid_id,
            'date' => $request->input('date'),
        ]);

        if ($activitySheet->activities) {
            $activitySheet->activities->each->delete();
        }

        $activityData = [];
        $activityTypes = $request->input('activity_type');
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        foreach ($activityTypes as $key => $activityType) {
            $activityDataRow = [
                'activity_sheet_id' =>  $activitySheet->id,
                'activity_type' => $activityType,
            ];

            foreach ($daysOfWeek as $day) {
                $activityDataRow[strtolower($day) . '_activities'] = $request->input(strtolower($day) . '_activities')[$key];
            }

            $activityDataRow['activities_adjustment'] = $request->input('activities_adjustment')[$key];

            $activityData[] = $activityDataRow;
        }

        Activity::insert($activityData);

        return redirect()->route('activity-sheets')->with('success', 'Activity sheet updated successfully');
    }


    public function deleteActivitySheet($id)
    {
        $activitySheet = ActivitySheet::find($id);
        if (!$activitySheet) {
            return redirect()->back()->with('error', 'Activity sheet not found');
        }
        // $filePath = public_path($activitySheet->file);
        // if (file_exists($filePath)) {
        //     unlink($filePath);
        // }
        if ($activitySheet->activities) {
            $activitySheet->activities->each->delete();
        }
        $activitySheet->delete();
        return redirect()->back()->with('success', 'Activity sheet deleted successfully');
    }

    public function attendance(Request $request)
    {
        $user = User::find(Auth::id());

        $currentMonth = Carbon::now();

        if (isset($request->month) && !empty($request->month)) {
            $currentMonth = Carbon::create(Carbon::now()->year, $request->month, 1, 0, 0, 0);;
        }

        $baseQuery = Kid::where('status', 1)->whereDate('contract_start', '<=', $currentMonth)->latest();

        $provider = '';

        if (isset($user) && $user->hasRole('Admin') && isset($request->provider_id) && !empty($request->provider_id)) {
            $baseQuery->where('provider_id', $request->provider_id);
            $provider = DaycareProvider::where('id', $request->provider_id)->select(['id', 'code', 'name'])->first();
        } elseif (isset($user) && $user->hasRole('Franchise')) {
            $provider = DaycareProvider::where('id', $user->provider->id)->select(['id', 'code', 'name'])->first();
            $baseQuery->where('provider_id', $user->provider->id);
        } elseif (isset($user) && $user->hasRole('Parent')) {
            $provider = DaycareProvider::where('id', $user->parent->provider->id)->select(['id', 'code', 'name'])->first();
            $baseQuery->where('parent_id', $user->parent->id);
        }

        $kids = $baseQuery->get();

        if (isset($user) && $user->hasRole('Admin') && empty($request->provider_id)) {
            $kids = [];
        }


        return view('attendance', compact('currentMonth', 'kids', 'provider'));
    }


    public function viewAttendance(Request $request, $id)
    {
        $currentMonth = Carbon::now();
        $kid = Kid::find($id);
        $provider = DaycareProvider::find($request->provider_id);
        return view('single-attendance', compact('currentMonth', 'kid', 'provider'));
    }

    public function allAttendance(Request $request)
    {
        $user = User::find(Auth::id());

        $currentMonth = Carbon::now();

        if (isset($request->month) && !empty($request->month)) {
            $currentMonth = Carbon::create(Carbon::now()->year, $request->month, 1, 0, 0, 0);;
        }

        $baseQuery = Kid::where('status', 1)->where('contract_start', '<=', $currentMonth)->latest();

        $provider = '';

        if (isset($user) && $user->hasRole('Admin') && isset($request->provider_id) && !empty($request->provider_id)) {
            $provider = DaycareProvider::where('id', $request->provider_id)->select(['id', 'code', 'name'])->first();
            $baseQuery->where('provider_id', $request->provider_id);
        } elseif (isset($user) && $user->hasRole('Franchise')) {
            $provider = DaycareProvider::where('id', $user->provider->id)->select(['id', 'code', 'name'])->first();
            $baseQuery->where('provider_id', $user->provider->id);
        } elseif (isset($user) && $user->hasRole('Parent')) {
            $provider = DaycareProvider::where('id', $user->parent->provider->id)->select(['id', 'code', 'name'])->first();
            $baseQuery->where('parent_id', $user->parent->id);
        }

        $kids = $baseQuery->get();

        if (isset($user) && $user->hasRole('Admin') && empty($request->provider_id)) {
            $kids = [];
        }

        return view('all-attendance', compact('currentMonth', 'kids', 'provider'));
    }

    public function allAttendancePD(Request $request)
    {
        $user = User::find(Auth::id());

        $currentMonth = Carbon::now();

        if (isset($request->month) && isset($request->year) && !empty($request->month) && !empty($request->year)) {
            $currentMonth = Carbon::create($request->year, $request->month, 1, 0, 0, 0);
        }

        $baseQuery = Kid::where('status', 1)->where('contract_start', '<=', $currentMonth)->latest();

        $provider = '';

        if (isset($user) && $user->hasRole('Admin') && isset($request->provider_id) && !empty($request->provider_id)) {
            $provider = DaycareProvider::where('id', $request->provider_id)->select(['id', 'code', 'name'])->first();
            $baseQuery->where('provider_id', $request->provider_id);
        } elseif (isset($user) && $user->hasRole('Franchise')) {
            $provider = DaycareProvider::where('id', $user->provider->id)->select(['id', 'code', 'name'])->first();
            $baseQuery->where('provider_id', $user->provider->id);
        } elseif (isset($user) && $user->hasRole('Parent')) {
            $provider = DaycareProvider::where('id', $user->parent->provider->id)->select(['id', 'code', 'name'])->first();
            $baseQuery->where('parent_id', $user->parent->id);
        }

        $kids = $baseQuery->get();

        if (isset($user) && $user->hasRole('Admin') && empty($request->provider_id)) {
            $kids = [];
        }

        return view('survey.attendence', compact('currentMonth', 'kids', 'provider'));
    }

    public function allSnapPD(Request $request)
    {
        $user = User::find(Auth::id());

        $currentMonth = Carbon::now();

        if (isset($request->month) && !empty($request->month)) {
            $currentMonth = Carbon::create(Carbon::now()->year, $request->month, 1, 0, 0, 0);;
        }

        $baseQuery = Kid::where('status', 1)->where('contract_start', '<=', $currentMonth)->latest();

        $provider = '';

        if (isset($user) && $user->hasRole('Admin') && isset($request->provider_id) && !empty($request->provider_id)) {
            $provider = DaycareProvider::where('id', $request->provider_id)->select(['code', 'name'])->first();
            $baseQuery->where('provider_id', $request->provider_id);
        } elseif (isset($user) && $user->hasRole('Franchise')) {
            $baseQuery->where('provider_id', $user->provider->id);
        } elseif (isset($user) && $user->hasRole('Parent')) {
            $baseQuery->where('parent_id', $user->parent->id);
        }

        $kids = $baseQuery->get();

        if (isset($user) && $user->hasRole('Admin') && empty($request->provider_id)) {
            $kids = [];
        }

        return view('survey.nap_time', compact('currentMonth', 'kids', 'provider'));
    }

    public function markAttendance(Request $request)
    {
        try {

            // Get the kid ID and attendance date from the request
            $studentId = $request->input('student_id');
            $attendanceDate = $request->input('attendance_date');
            $drop_time = $request->input('drop_time');
            $pickup_time = $request->input('pickup_time');

            $kid = Kid::find($studentId);

            if (!$kid) {
                return response()->json(['success' => false, 'error' => 'Kid not found']);
            }

            // $isMonthDisabled = GlobalHelper::isAttendanceDisabled($kid->provider_id,$attendanceDate);

            // if($isMonthDisabled)
            // {
            //     return response()->json(['success' => true, 'message' => 'You are not allowed to mark attendance until the previous month is closed.', 'status' => '404']);
            // }    

            // Extract the year and month from the current date
            $year = date('Y', strtotime($attendanceDate));
            $month = date('n', strtotime($attendanceDate));

            $isPreviousMonthClosed = ClosedMonth::where('year', $year)
                ->where('month', $month)
                ->first();

            if ($isPreviousMonthClosed) {
                return response()->json(['success' => true, 'message' => 'You are not allowed to mark attendance when month is closed.', 'status' => '404']);
            }

            // Check if an attendance record already exists for this student and date
            $attendanceRecord = Attendance::where('kid_id', $studentId)
                ->where('date', $attendanceDate)
                ->first();
            // return $attendanceRecord;

            if ($attendanceRecord) {
                // If an attendance record exists, update it to mark the student as present
                // $attendanceRecord->present = 0;
                $attendanceRecord->delete();

                return response()->json(['success' => true, 'message' => 'Attendance Unmarked Successfully']);
            } else {
                // If no attendance record exists, create a new one and mark the student as present
                Attendance::create([
                    'provider_id' => $kid->provider_id,
                    'kid_id' => $studentId,
                    'date' => $attendanceDate,
                    'pickup_time' => $pickup_time,
                    'drop_time' => $drop_time,
                    'present' => 1,
                ]);
            }
            return response()->json(['success' => true, 'message' => 'Attendance Marked Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function updatePickupTime(Request $request)
    {
        $kid_id = $request->input('kid_id');
        $date = $request->input('date');
        $pickup_time = $request->input('pickup_time');

        // Check if an attendance record already exists for this student and date
        $attendanceRecord = Attendance::where('kid_id', $kid_id)
            ->where('date', $date)
            ->first();

        if ($attendanceRecord) {
            // Update the existing attendance record with the new pickup time
            $attendanceRecord->pickup_time = $pickup_time;
            $attendanceRecord->save();

            // You can return a success response if needed
            return response()->json(['success' => true, 'message' => 'Pickup Time Updated Successfully']);
        } else {

            return response()->json(['success' => false, 'message' => 'Attendance Record not found']);
        }
    }



    public function addMeal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'kid_id' => 'required',
            'date' => 'required',
            'end_date' => 'required',
            // 'meal' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();


        // $kid = Kid::find($request->kid_id);
        // if (!$kid) {
        //     return redirect()->back()->with('error', 'Kid not found');
        // }

        $authUser = User::find(Auth::id());


        if (isset($authUser) && $authUser->hasRole('Franchise')) {

            $validatedData['provider_id'] = $authUser->provider->id;

            $mealPlan = KidMeal::create($validatedData);

            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

            foreach ($daysOfWeek as $day) {
                $mealPlanItem = $mealPlan->items->where('day', $day)->first();

                if (!$mealPlanItem) {
                    $mealPlanItem = new KidMealItem();
                    $mealPlanItem->kid_meal_id = $mealPlan->id;
                    $mealPlanItem->day = $day;
                }

                $mealPlanItem->morning_snack = $request->input('morning_snack')[$day];
                $mealPlanItem->lunch = $request->input('lunch')[$day];
                $mealPlanItem->afternoon_snack = $request->input('afternoon_snack')[$day];
                $mealPlan->items()->save($mealPlanItem);
            }

            $parentsUserId = Parents::where('daycare_provider_id', $validatedData['provider_id'])->pluck('user_id')->toArray();

            // Send Notification
            $type = 'NewMeal';

            // Franchises and parent
            $recipients = User::whereHas('roles', function ($query) use ($parentsUserId) {
                $query->whereIn('name', ['Admin']);
            })->orWhereIn('id', $parentsUserId)->pluck('id')->toArray();
            // Franchises and parents

            if (isset($recipients) && (!empty($recipients)) && count($recipients) > 0) {
                GlobalHelper::sendUpdateNotification($recipients, $type);
            }
            // Send Notification
            return redirect()->route('meals.index')->with('success', 'Meal added successfully');
        }
    }

    public function updateMeal(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'kid_id' => 'required',
            'date' => 'required',
            'end_date' => 'required',
            // 'meal' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // $kid = Kid::find($request->kid_id);
        // if (!$kid) {
        //     return redirect()->back()->with('error', 'Kid not found');
        // }
        $authUser = User::find(Auth::id());

        $meal = KidMeal::find($id);

        if (!$meal) {
            return redirect()->back()->with('error', 'Meal not found');
        }

        if (isset($authUser) && $authUser->hasRole('Franchise')) {

            $validatedData['provider_id'] = $authUser->provider->id;
            $meal->date = $validatedData['date'];
            $meal->end_date = $validatedData['end_date'];
            $meal->provider_id = $validatedData['provider_id'];
            $meal->save();

            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

            foreach ($daysOfWeek as $day) {
                $mealPlanItem = $meal->items->where('day', $day)->first();

                if (!$mealPlanItem) {
                    $mealPlanItem = new KidMealItem();
                    $mealPlanItem->kid_meal_id = $meal->id;
                    $mealPlanItem->day = $day;
                }

                $mealPlanItem->morning_snack = $request->input('morning_snack')[$day];
                $mealPlanItem->lunch = $request->input('lunch')[$day];
                $mealPlanItem->afternoon_snack = $request->input('afternoon_snack')[$day];
                $meal->items()->save($mealPlanItem);
            }

            return redirect()->route('meals.index')->with('success', 'Meal updated successfully');
        }
    }


    public function deleteMeal($id)
    {
        $meal = KidMeal::find($id);

        if (!$meal) {
            return redirect()->back()->with('error', 'Meal not found');
        }

        if ($meal->items) {
            $meal->items->each->delete();
        }
        $meal->delete();

        return redirect()->back()->with('success', 'Meal deleted successfully');
    }

    public function viewMeal($id)
    {
        $meal = KidMeal::find($id);
        return view('kids.meal-view', compact('meal'));
    }

    public function viewPayment($paymentId, Request $request)
    {
        $payment = DayCarePayment::where('payment_number', $paymentId)->with('provider', 'paymentItems.kid')->first();
        $user = User::find(Auth::id());

        $formattedDate = Carbon::parse($payment->created_at);
        $alreadyPaid = PaidPayment::where('provider_id', $payment->provider_id)->whereMonth('date', $formattedDate)->value('amount') ?? 0;

        if (isset($user) && $user->hasRole('Admin') && !$request->view_pdf == 1) {
            return view('payments.generate-pay', compact('payment', 'alreadyPaid'));
        } else {

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

            // Output the generated PDF
            return $pdf->stream('payment.pdf', ['Attachment' => 0]);
        }
    }


    public function vacations(Request $request)
    {
        $user = User::find(Auth::id());
        $baseQuery = DayCareVacation::query();

        if (isset($user) && $user->hasRole('Franchise')) {
            $baseQuery->where('provider_id', $user->provider->id);
        } elseif (isset($user) && $user->hasRole('Parent')) {
            $baseQuery->where('provider_id', $user->parent->provider->id);
        }

        $vacations = $baseQuery->with('provider', 'alternateProvider')->latest()->paginate(10);

        $currentWeekStart = Carbon::now()->startOfWeek();
        $currentWeekEnd = Carbon::now()->endOfWeek();

        $providers = DaycareProvider::where('status', 1)->get();

        return view('vacations', compact('vacations', 'currentWeekStart', 'currentWeekEnd', 'providers'));
    }

    public function applyVacation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'new_daycare_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $providerId = auth()->user()->provider->id;

        DB::beginTransaction();

        try {
            // Create a new vacation record
            DayCareVacation::create([
                'provider_id' => $providerId,
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
            ]);

            // Commit the database transaction
            DB::commit();

            return redirect()->back()->with('success', 'Applied for Vacation successfully | Wait for admin approval.');
        } catch (\Exception $e) {
            // Handle any exceptions and rollback the transaction
            DB::rollBack();
            // Log the error, handle exceptions, and return an error response
            return redirect()->back()->with('error', 'An error occurred while marking the vacation.');
        }
    }

    public function updateKidStatus(Request $request)
    {
        // $status = $request->input('status');
        $kidId = $request->input('kid_id');

        $kid = Kid::find($kidId);

        if ($kid->status == 1) {
            $kid->status = 0;


            $age = GlobalHelper::calculateAgeFromDOB($kid->dob);

            if ($age < 2) {
                $type = 'infantVacant';
                $message = "We're Happy to Announce New Kid Spaces for Infants at " . $kid->provider->name;
                $title = 'Infant Position Free';
            }elseif ($age >=2 && $age < 4) {
                $title = 'Toddler Position Free';
                $type = 'toddlerVacant';
                $message = "New Kid Space Available for Your Energetic Toddlers at " . $kid->provider->name . '.' . " Register Now!";
            } else {
                $title = 'Pre Schoolers Position Free';
                $type = 'preSchoolVacant';
                $message = "Adventure Awaits! New Kid Spaces Open for Preschoolers at " . $kid->provider->name . '.' . " Start the Journey!";
            }

            // Franchises and Admin
            $recipients = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Admin']);
            })->pluck('id')->toArray();
            // Franchises and Admin

            if (isset($recipients) && (!empty($recipients)) && count($recipients) > 0) {

                $userIds = is_array($recipients) ? $recipients : [$recipients];
                $now = now();

                foreach ($userIds as $userId) {
                    $notifications[] = [
                        'user_id' => $userId,
                        'type' => $type,
                        'title' => $title,
                        'message' => $message,
                        'url' => route('admin.providers', ['search_text' => $kid->provider->code]),
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
        } else {
            $kid->status = 1;
        }

        $kid->save();
        return response()->json(['message' => 'Status updated successfully']);
    }

    public function showActivity($id)
    {
        $activitySheet = ActivitySheet::where('id', $id)->with('activities')->first();
        if (!$activitySheet) {
            return redirect()->back()->with('error', 'Activity sheet not found');
        }

        return view('view-activity', ['activitySheet' => $activitySheet]);
    }

    public function incidents(Request $request)
    {
        $user = User::find(Auth::id());
        $baseQuery = KidAccidentReport::query();

        if (isset($user) && $user->hasRole('Franchise')) {
            $baseQuery->where('provider_id', $user->provider->id);
        } elseif (isset($user) && $user->hasRole('Parent')) {

            $baseQuery->whereHas('kid.parent', function ($query) use ($user) {
                $query->where('parent_id', $user->parent->id);
            });
        }

        if (isset($request->search_query) && !empty($request->search_query)) {
            $searchText = strtolower($request->input('search_query'));
            $baseQuery->where(function ($query) use ($searchText) {
                $query->where('incident_number', 'LIKE', "%$searchText%");
            });
        }

        $reports = $baseQuery->latest()->paginate(10);
        return view('incidents', compact('reports'));
    }

    public function addIncident(Request $request)
    {
        $user = User::find(Auth::id());

        $kids = [];

        if (isset($user) && $user->hasRole('Franchise')) {
            $kids = Kid::where('status', 1)->get();
        }
        return view('provider.create-incident', compact('kids'));
    }

    public function addOrUpdateincident(Request $request, $reportId = null)
    {
        $validator = Validator::make($request->all(), [
            'kid_id' => 'required|exists:kids,id',
            'accident_date' => 'required',
            'accident_time' => 'required',
            'location' => 'required|string',
            'observer' => 'required|string',
            'nature_of_injury' => 'required',
            'nature_of_injury.*' => 'string',
            'other_injury' => 'nullable',
            'description' => 'required|string',
            'first_aid' => 'required|string',
            'phone_notified' => 'nullable',
            'phone_notified_time' => 'nullable|date_format:H:i',
            'phone_notified_by' => 'nullable|string',
            'voicemail_notified' => 'nullable',
            'voicemail_notified_time' => 'nullable|date_format:H:i',
            'voicemail_notified_by' => 'nullable|string',
            'email_notified' => 'nullable',
            'email_notified_time' => 'nullable|date_format:H:i',
            'email_notified_by' => 'nullable|string',
            'in_person_notified' => 'nullable',
            'in_person_notified_time' => 'nullable|date_format:H:i',
            'in_person_notified_by' => 'nullable|string',
            'report_provided_by' => 'required|string',
            'guardian_name' => 'nullable|string',
            'guardian_signature' => 'nullable|string',
            'provider_signature' => 'required|string',
            'childcare_provider_name' => 'required|string',
            'childcare_provider_address' => 'required|string',
            'filled_by' => 'nullable|string',
            'signature_filled_by' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kid = Kid::find($request->kid_id);

        if (!$kid) {
            return redirect()->back()->with('error', 'Kid not found');
        }

        $validatedData = $validator->validated();

        if (isset($request->nature_of_injury) && !empty($request->nature_of_injury)) {
            $validatedData['nature_of_injury'] = json_encode($request->input('nature_of_injury', []));
        } else {
            $validatedData['nature_of_injury'] = null;
        }

        $validatedData['incident_number'] = GlobalHelper::generateIncidentNumber();
        $validatedData['provider_id'] = $kid->provider_id;
        $validatedData['phone_notified'] = $request->phone_notified ? 1 : 0;
        $validatedData['voicemail_notified'] = $request->voicemail_notified ? 1 : 0;
        $validatedData['email_notified'] = $request->email_notified ? 1 : 0;
        $validatedData['in_person_notified'] = $request->in_person_notified ? 1 : 0;
        $validatedData['same_as_provider'] = $request->same_as_provider ? 1 : 0;

        if (!empty($reportId)) {

            $accidentReport = KidAccidentReport::findOrFail($reportId);
            $accidentReport->update($validatedData);
            $message = 'Accident report updated successfully';
        } else {
            $accidentReport = new KidAccidentReport($validatedData);
            // Save the accident report for the kid
            $kid->accidentReports()->save($accidentReport);
            $message = 'Accident report created successfully';

            $validatedData['parent'] = $kid->parent->name;
            GlobalHelper::sendEmail($kid->parent->email, "Alert! Accident report is added against your child {$kid->full_name}, please sign that", 'emails.accident_alert', $validatedData);

            $type = 'AccidentAlert';
            $recipients = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Admin']);
            })->orWhere('id', $kid->parent->user_id)->pluck('id')->toArray();

            if (isset($recipients) && !empty($recipients) && count($recipients) > 0) {
                GlobalHelper::sendUpdateNotification($recipients, $type);
            }
        }

        return redirect()->route('incidents')->with('success', $message);
    }

    public function viewIncident(Request $request, $id)
    {
        $user = User::find(Auth::id());
        $report = KidAccidentReport::where('incident_number', $id)->first();
        if (!$report) {
            return redirect()->back()->with('error', 'Report not found');
        }

        $kids = [];

        if (isset($user) && $user->hasRole('Franchise')) {
            $kids = Kid::where('status', 1)->get();
        } else {
            $kids = Kid::where('id', $report->kid_id)->get();
        }

        return view('provider.create-incident', compact('report', 'kids'));
    }

    public function aboutMe(Request $request, $providerId = null)
    {
        $user = User::find(Auth::id());
        $isFranchise = 0;

        if (isset($user) && $user->hasRole('Admin')) {
            if (empty($providerId)) {
                abort(404);
            }

            $provider = DaycareProvider::find($providerId);

            if (isset($provider) && !empty($provider)) {
                $aboutMe = $provider->aboutMe;
            } else {
                return redirect()->back()->with('error', 'Provider not found');
            }
        } elseif (isset($user) && $user->hasRole('Franchise')) {
            $isFranchise = true;
            $provider = $user->provider;
            $aboutMe = $provider->aboutMe;
        } else {
            if (empty($providerId)) {
                abort(404);
            }

            $provider = DaycareProvider::find($providerId);

            if (isset($provider) && !empty($provider)) {
                $aboutMe = $provider->aboutMe;
            } else {
                return redirect()->back()->with('error', 'Provider not found');
            }
        }
        return view('provider.aboutMe', compact('aboutMe', 'isFranchise'));
    }

    public function saveOrUpdateAboutMe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about_me' => 'required',
            'family_members' => 'required',
            'family_members_below_18' => 'required',
            'family_members_above_18' => 'required',
            'courses.*.name' => 'nullable|string',
            'courses.*.start_date' => 'nullable|date',
            'courses.*.end_date' => 'nullable|date|after:courses.*.start_date',
            'courses.*.organization' => 'nullable|string',
            // 'family_members' => 'required|array',
            // 'family_members.*.family_member_name' => 'required|string|max:255',
            // 'family_members.*.police_certificate' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $validatedData = $validator->validated();

        $authUser = User::find(Auth::id());
        $provider = $authUser->provider;

        if (isset($validatedData['courses']) && !empty($validatedData['courses'])) {
            $validatedData['courses'] = json_encode($request->input('courses', []));
        } else {
            $validatedData['courses'] = null;
        }

        $familyMembersData = $request->family_members_data;
        $preparedFamilyMembers = [];

        if (isset($familyMembersData) && !empty($familyMembersData) && count($familyMembersData) > 0) {
            foreach ($familyMembersData as $index => $familyMemberData) {
                $preparedFamilyMembers[$index] = [
                    'family_member_name' => $familyMemberData['family_member_name'],
                ];

                // Handle certificate file upload for all family members
                if (isset($familyMemberData['police_certificate']) && !empty($familyMemberData['police_certificate'])) {
                    $certificatePath = GlobalHelper::uploadAndSaveFile([$familyMemberData['police_certificate']], 'uploads/police_certificates');
                    $preparedFamilyMembers[$index]['police_certificate'] = $certificatePath[0];
                } elseif ($familyMember = $provider->aboutMe->familyMembers->get($index)) {
                    $preparedFamilyMembers[$index]['police_certificate'] = $familyMember->police_certificate;
                }

                if (isset($familyMemberData['health_certificate']) && !empty($familyMemberData['health_certificate'])) {
                    $certificatePath = GlobalHelper::uploadAndSaveFile([$familyMemberData['health_certificate']], 'uploads/health_certificates');
                    $preparedFamilyMembers[$index]['health_certificate'] = $certificatePath[0];
                } elseif ($familyMember = $provider->aboutMe->familyMembers->get($index)) {
                    $preparedFamilyMembers[$index]['health_certificate'] = $familyMember->health_certificate;
                }
            }
        }

        if ($provider->aboutMe) {
            // Update the existing about information
            $provider->aboutMe->update($validatedData);
        } else {
            // Create a new provider record for the provider
            $provider->aboutMe()->create($validatedData);
        }

        if (isset($familyMembersData) && !empty($familyMembersData) && count($familyMembersData) > 0) {
            $provider->aboutMe->familyMembers()->delete();
            $provider->aboutMe->familyMembers()->createMany($preparedFamilyMembers);
        }

        return redirect()->back()->with('success', 'About me information saved successfully.');
    }

    public function providerContract($provider)
    {
        $provider = DaycareProvider::find($provider);
        return view('newUI.provider-guide', compact('provider'));
    }

    public function updateProviderContract(Request $request, $provider)
    {
        $rules = [
            'contract_signature' => 'required',
            'contract_signature_date' => 'required',
            'admin_signature' => 'nullable',
            'admin_signature_date' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find(Auth::id());

        $validatedData = $validator->validated();

        $provider = DaycareProvider::find($provider);

        if ($provider) {
            $provider->contract_signature =  $validatedData['contract_signature'];
            $provider->contract_signature_date =  $validatedData['contract_signature_date'];
            $provider->admin_signature =  $validatedData['admin_signature'];
            $provider->admin_signature_date =  $validatedData['admin_signature_date'];
            $provider->save();

            $route = 'settings';

            if (isset($user) && $user->hasRole('Admin')) {
                $route = 'admin.providers';
            }

            return redirect()->route($route)->with('success', 'Contract saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Provider not found.');
        }
    }
}
