<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use App\Models\ParentSurvey;
use App\Models\ProviderSurvey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{

    public function index()
    {
        $totalParentSurveyCount = ParentSurvey::count();
        $totalProviderSurveyCount = ProviderSurvey::count();
        $showProviderSurvey = false;
        $showParentsSurvey = false;

        $user = User::find(Auth::id());

        if (isset($user) && $user->hasRole('Parent')) {
            $totalParentSurveyCount = ParentSurvey::where('parent_id', $user->parent->id)->count();
        }

        if (isset($user) && $user->hasRole('Franchise')) {
            $totalProviderSurveyCount = ProviderSurvey::where('provider_id', $user->provider->id)->count();
        }

        $adminSettings = AdminSetting::first();
        if ($adminSettings->show_providers_survey == 1) {
            $showProviderSurvey = true;
        }
        if ($adminSettings->show_parents_survey == 1) {
            $showParentsSurvey = true;
        }

        return view('survey.index', compact('totalParentSurveyCount', 'totalProviderSurveyCount', 'showProviderSurvey', 'showParentsSurvey'));
    }

    public function parentsSurveys(Request $request)
    {
        $search = $request->input('search_text');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $user = User::find(Auth::id());
        $baseQuery = ParentSurvey::query();

        if (isset($user) && $user->hasRole('Parent')) {
            $baseQuery->whereDate('parent_id', Auth::user()->parent->id);
        }

        if (isset($startDate) && !empty($startDate)) {
            $baseQuery->whereDate('created_at', '>=', $startDate);
        }

        if (isset($endDate) && !empty($endDate)) {
            $baseQuery->whereDate('created_at', '<=', $endDate);
        }

        if (isset($search) && !empty($search)) {
            $baseQuery->whereHas('parent', function ($parentQuery) use ($search) {
                $parentQuery->where('name', 'like', "%$search%");
            });
        }

        $parentsSurveys = $baseQuery->latest()->paginate(10);

        return view('survey.index-parents', compact('parentsSurveys'));
    }

    public function providerSurveys(Request $request)
    {
        $search = $request->input('search_text');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $user = User::find(Auth::id());
        $baseQuery = ProviderSurvey::query();

        if (isset($user) && $user->hasRole('Franchise')) {
            $baseQuery->where('provider_id', Auth::user()->provider->id);
        }

        if (isset($startDate) && !empty($startDate)) {
            $baseQuery->whereDate('created_at', '>=', $startDate);
        }

        if (isset($endDate) && !empty($endDate)) {
            $baseQuery->whereDate('created_at', '<=', $endDate);
        }

        if (isset($search) && !empty($search)) {
            $baseQuery->whereHas('provider', function ($providerQuery) use ($search) {
                $providerQuery->where('name', 'like', "%$search%");
            });
        }

        $providersSurveys = $baseQuery->latest()->paginate(10);

        return view('survey.index-providers', compact('providersSurveys'));
    }

    public function view_survey(Request $request, $id)
    {
        if ($request->view_parent == 1) {
            $survey = ParentSurvey::find($id);

            if ($survey) {
                return view('survey.parent', compact('survey'));
            }

            abort(404);
        } elseif ($request->view_provider == 1) {

            $survey = ProviderSurvey::find($id);

            if ($survey) {
                return view('survey.provider', compact('survey'));
            }
            abort(404);
        }

        return redirect()->back()->with('error', 'Access denied');
    }

    public function addParentSurvey(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question1' => 'nullable',
            'question2' => 'nullable',
            'question3' => 'nullable',
            'question17' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $user = User::find(Auth::id());

        if (isset($user) && $user->hasRole('Parent')) {
            $validatedData['parent_id'] = $user->parent->id;
            $validatedData['q1'] = !empty($request->input('question1')) ? 1 : 0;
            $validatedData['q2'] = !empty($request->input('question2')) ? 1 : 0;
            $validatedData['q3'] = !empty($request->input('question3')) ? 1 : 0;
            $validatedData['q4'] = !empty($request->input('question4')) ? 1 : 0;
            $validatedData['q5'] = !empty($request->input('question5')) ? 1 : 0;
            $validatedData['q6'] = !empty($request->input('question6')) ?? 0;
            $validatedData['q7'] = !empty($request->input('question7')) ? 1 : 0;
            $validatedData['q8'] = !empty($request->input('question8')) ? 1 : 0;
            $validatedData['q9'] = !empty($request->input('question9')) ? 1 : 0;
            $validatedData['q10'] = !empty($request->input('question10')) ?? 0;
            $validatedData['q11'] = !empty($request->input('question11')) ? 1 : 0;
            $validatedData['q12'] = !empty($request->input('question12')) ?? 0;
            $validatedData['q13'] = !empty($request->input('question13')) ? 1 : 0;
            $validatedData['q14'] = !empty($request->input('question14')) ? 1 : 0;
            $validatedData['q15'] = !empty($request->input('question15')) ?? 0;
            $validatedData['q16'] = !empty($request->input('question16')) ? 1 : 0;
            $validatedData['q17'] = $validatedData['q17'] ?? '';

            ParentSurvey::create($validatedData);

            return redirect()->route('survey.parents')->with('success', 'Survey Submitted Succesfully');
        }

        return redirect()->back()->with('error', 'Access Denied');
    }

    public function updateParentSurvey(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question1' => 'nullable',
            'question2' => 'nullable',
            'question3' => 'nullable',
            'question17' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $user = User::find(Auth::id());

        if (isset($user) && $user->hasRole('Parent')) {
            $validatedData['parent_id'] = $user->parent->id;
            $validatedData['q1'] = !empty($request->input('question1')) ? 1 : 0;
            $validatedData['q2'] = !empty($request->input('question2')) ? 1 : 0;
            $validatedData['q3'] = !empty($request->input('question3')) ? 1 : 0;
            $validatedData['q4'] = !empty($request->input('question4')) ? 1 : 0;
            $validatedData['q5'] = !empty($request->input('question5')) ? 1 : 0;
            $validatedData['q6'] = !empty($request->input('question6')) ?? 0;
            $validatedData['q7'] = !empty($request->input('question7')) ? 1 : 0;
            $validatedData['q8'] = !empty($request->input('question8')) ? 1 : 0;
            $validatedData['q9'] = !empty($request->input('question9')) ? 1 : 0;
            $validatedData['q10'] = !empty($request->input('question10')) ?? 0;
            $validatedData['q11'] = !empty($request->input('question11')) ? 1 : 0;
            $validatedData['q12'] = !empty($request->input('question12')) ?? 0;
            $validatedData['q13'] = !empty($request->input('question13')) ? 1 : 0;
            $validatedData['q14'] = !empty($request->input('question14')) ? 1 : 0;
            $validatedData['q15'] = !empty($request->input('question15')) ?? 0;
            $validatedData['q16'] = !empty($request->input('question16')) ? 1 : 0;
            $validatedData['q17'] = $validatedData['q17'] ?? '';

            $survey = ParentSurvey::find($id);
            if (!$survey) {
                return redirect()->back()->with('error', 'Survey not found');
            }

            $survey->update($validatedData);

            return redirect()->route('survey.parents')->with('success', 'Survey updated Succesfully');
        }

        return redirect()->back()->with('error', 'Access Denied');
    }

    public function addProviderSurvey(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'question17' => 'required|string',
            'question18' => 'required|string',
            'question19' => 'required|string',
            'question20' => 'required|string',
            'question21' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        $user = User::find(Auth::id());

        if (isset($user) && $user->hasRole('Franchise')) {
            $validatedData['provider_id'] = $user->provider->id;

            $validatedData['q1'] = $request->input('question1') ?? 'neutral';
            $validatedData['q2'] = $request->input('question2') ?? 'neutral';
            $validatedData['q3'] = $request->input('question3') ?? 'neutral';
            $validatedData['q4'] = $request->input('question4') ?? 'neutral';
            $validatedData['q5'] = $request->input('question5') ?? 'neutral';
            $validatedData['q6'] = $request->input('question6') ?? 'neutral';
            $validatedData['q7'] = $request->input('question7') ?? 'neutral';
            $validatedData['q8'] = $request->input('question8') ?? 'neutral';
            $validatedData['q9'] = $request->input('question9') ?? 'neutral';
            $validatedData['q10'] = $request->input('question10') ?? 'neutral';
            $validatedData['q11'] = $request->input('question11') ?? 'neutral';

            $validatedData['q12'] = $request->input('question12') ?? 0;
            $validatedData['q13'] = $request->input('question13') ?? 0;
            $validatedData['q14'] = $request->input('question14') ?? 0;
            $validatedData['q15'] = $request->input('question15') ?? 0;
            $validatedData['q16'] = $request->input('question16') ?? 0;

            $validatedData['q17'] = $validatedData['question17'] ?? '';
            $validatedData['q18'] = $validatedData['question18'] ?? '';
            $validatedData['q19'] = $validatedData['question19'] ?? '';
            $validatedData['q20'] = $validatedData['question20'] ?? '';
            $validatedData['q21'] = $validatedData['question21'] ?? '';

            ProviderSurvey::create($validatedData);
            return redirect()->route('survey.providers')->with('success', 'Survey Submitted Succesfully');
        }

        return redirect()->back()->with('error', 'Access Denied');
    }

    public function updateProviderSurvey(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'question17' => 'required|string',
            'question18' => 'required|string',
            'question19' => 'required|string',
            'question20' => 'required|string',
            'question21' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        $user = User::find(Auth::id());

        if (isset($user) && $user->hasRole('Franchise')) {
            $validatedData['provider_id'] = $user->provider->id;

            $validatedData['q1'] = $request->input('question1') ?? 'neutral';
            $validatedData['q2'] = $request->input('question2') ?? 'neutral';
            $validatedData['q3'] = $request->input('question3') ?? 'neutral';
            $validatedData['q4'] = $request->input('question4') ?? 'neutral';
            $validatedData['q5'] = $request->input('question5') ?? 'neutral';
            $validatedData['q6'] = $request->input('question6') ?? 'neutral';
            $validatedData['q7'] = $request->input('question7') ?? 'neutral';
            $validatedData['q8'] = $request->input('question8') ?? 'neutral';
            $validatedData['q9'] = $request->input('question9') ?? 'neutral';
            $validatedData['q10'] = $request->input('question10') ?? 'neutral';
            $validatedData['q11'] = $request->input('question11') ?? 'neutral';

            $validatedData['q12'] = $request->input('question12') ?? 0;
            $validatedData['q13'] = $request->input('question13') ?? 0;
            $validatedData['q14'] = $request->input('question14') ?? 0;
            $validatedData['q15'] = $request->input('question15') ?? 0;
            $validatedData['q16'] = $request->input('question16') ?? 0;

            $validatedData['q17'] = $validatedData['question17'] ?? '';
            $validatedData['q18'] = $validatedData['question18'] ?? '';
            $validatedData['q19'] = $validatedData['question19'] ?? '';
            $validatedData['q20'] = $validatedData['question20'] ?? '';
            $validatedData['q21'] = $validatedData['question21'] ?? '';

            $survey = ProviderSurvey::find($id);
            if (!$survey) {
                return redirect()->back()->with('error', 'Survey not found');
            }

            $survey->update($validatedData);
            return redirect()->route('survey.providers')->with('success', 'Survey updated Succesfully');
        }

        return redirect()->back()->with('error', 'Access Denied');
    }

    public function updateSurveyToogle(Request $request)
    {

        $adminSettings = AdminSetting::first();
        $message = '';

        if ($request->parent_survey_toogle == 1) {
            if ($adminSettings->show_parents_survey == 1) {
                $adminSettings->show_parents_survey = 0;
            } else {
                $adminSettings->show_parents_survey = 1;
            }

            $message = 'Parent survey toogle is updated';
        }

        if ($request->provider_survey_toogle == 1) {
            if ($adminSettings->show_providers_survey == 1) {
                $adminSettings->show_providers_survey = 0;
            } else {
                $adminSettings->show_providers_survey = 1;
            }
            $message = 'Provider survey toogle is updated';
        }

        $adminSettings->save();

        return redirect()->back()->with('success', $message);
    }
}
