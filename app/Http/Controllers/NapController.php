<?php

namespace App\Http\Controllers;

use App\Models\DaycareProvider;
use App\Models\Kid;
use App\Models\NapTime;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NapController extends Controller
{
    public function Index(Request $request)
    {
        $user = User::find(Auth::id());

        $currentMonth = Carbon::now();


        if (isset($request->month) && isset($request->year) && !empty($request->month) && !empty($request->year)) {
            $currentMonth = Carbon::create($request->year, $request->month, 1, 0, 0, 0);
        }

        $baseQuery = Kid::where('status', 1)
            ->whereDate('contract_start', '<=', $currentMonth)
            ->whereDate('contract_end', '>=', $currentMonth)
            ->latest();

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

    public function markTiming(Request $request)
    {
        try {

            // Get the kid ID and attendance date from the request
            $kid_id = $request->input('kid_id');
            $date = $request->input('date');
            $sleeping_time = $request->input('sleeping_time');
            $awaking_time = $request->input('awaking_time');
            $checking_time = $request->input('checking_time');

            $kid = Kid::find($kid_id);

            if (!$kid) {
                return response()->json(['success' => false, 'error' => 'Kid not found']);
            }


            // Check if an attendance record already exists for this student and date
            $attendanceRecord = NapTime::where('kid_id', $kid_id)
                ->where('date', $date)
                ->first();
            // return $attendanceRecord;

            if ($attendanceRecord) {
                // If an attendance record exists, update it to mark the student as present
                // $attendanceRecord->present = 0;
                $attendanceRecord->checking_time = $checking_time;
                $attendanceRecord->sleeping_time = $sleeping_time;
                $attendanceRecord->awaking_time = $awaking_time;
                $attendanceRecord->save();

                return response()->json(['success' => true, 'message' => 'Nap Time Updated Successfully']);
            } else {
                // If no attendance record exists, create a new one and mark the student as present
                NapTime::create([
                    'provider_id' => $kid->provider_id,
                    'kid_id' => $kid_id,
                    'date' => $date,
                    'checking_time' => $checking_time,
                    'sleeping_time' => $sleeping_time,
                    'awaking_time' => $awaking_time,
                ]);
            }
            return response()->json(['success' => true, 'message' => 'Nap Time Stored Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function addNote(Request $request)
    {
        try {

            // Get the kid ID and attendance date from the request
            $kid_id = $request->input('kid_id');
            $date = $request->input('date');
            $note = $request->input('note');


            $kid = Kid::find($kid_id);

            if (!$kid) {
                return response()->json(['success' => false, 'error' => 'Kid not found']);
            }


            // Check if an attendance record already exists for this student and date
            $attendanceRecord = NapTime::where('kid_id', $kid_id)
                ->where('date', $date)
                ->first();
            // return $attendanceRecord;

            if ($attendanceRecord) {
                // If an attendance record exists, update it to mark the student as present
                // $attendanceRecord->present = 0;
                $attendanceRecord->note = $note;

                $attendanceRecord->save();

                return response()->json(['success' => true, 'message' => 'Note added Successfully']);
            }
            return response()->json(['success' => true, 'message' => 'Nap Time Stored Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function adminNapTimings(Request $request)
    {
        $baseQuery = DaycareProvider::where('status', 1);

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
        $providers = $baseQuery->latest()->paginate(10);

        return view('admin.nap', compact('providers'));
    }
}
