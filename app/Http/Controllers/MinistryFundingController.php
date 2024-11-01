<?php

namespace App\Http\Controllers;

use App\Models\FundingCategory;
use App\Models\Invoice;
use App\Models\MinistryFunding;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MinistryFundingController extends Controller
{

    public function fundings(Request $request)
    {
        $search = $request->input('search_text');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $baseQuery = MinistryFunding::query();

        if (isset($search) && !empty($search)) {

            $baseQuery->where('amount', '=', $search)
                ->orWhereHas('fundingCategory', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('type', 'like', "%$search%");
                });
        }

        // if (isset($endDate) && !empty($endDate)) {
        //     $baseQuery->whereDate('to', '<=', $endDate);
        // }

        $fundings = $baseQuery->with('fundingCategory')->latest()->paginate(10);
        return view('ministry-funding.index', compact('fundings'));
    }


    public function addFunding(Request $request)
    {
        return view('ministry-funding.edit');
    }

    public function insertFunding(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'funding_category_id' => 'required',
            'amount' => 'required|numeric|between:0.01,9999999.99',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $funding = new MinistryFunding();
        $funding->funding_category_id = $validatedData['funding_category_id'];
        $funding->amount = $validatedData['amount'];
        $funding->date = $validatedData['date'];
        // $funding->type = $validatedData['type'];
        // $funding->from = $validatedData['from'];
        // $funding->to = $validatedData['to'];
        $funding->save();

        return redirect()->route('fundings')->with('success', 'Funding added successfully');
    }



    public function editFunding(Request $request, $id)
    {
        $funding = MinistryFunding::find($id);
        if (!$funding) {
            return redirect()->back()->with('error', 'Funding not found');
        }
        return view('ministry-funding.edit', compact('funding'));
    }


    public function updateFunding(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'funding_category_id' => 'required',
            'amount' => 'required|numeric|between:0.01,9999999.99',
            'date' => 'required',
            // 'type' => 'required|string',
            // 'from' => 'required|date',
            // 'to' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $funding = MinistryFunding::find($id);
        $funding->funding_category_id = $validatedData['funding_category_id'];
        $funding->amount = $validatedData['amount'];
        $funding->date = $validatedData['date'];
        // $funding->type = $validatedData['type'];
        // $funding->from = $validatedData['from'];
        // $funding->to = $validatedData['to'];
        $funding->save();
        return redirect()->route('fundings')->with('success', 'Funding updated successfully');
    }

    public function deletefunding(Request $request, $id)
    {
        $funding = MinistryFunding::find($id);

        if (!$funding) {
            return redirect()->back()->with('error', 'Funding not found');
        }

        $funding->delete();

        return redirect()->route('fundings')->with('success', 'Funding deleted successfully');
    }

    public function fundingCategories(Request $request)
    {
        $search = $request->input('search_text');

        $baseQuery = FundingCategory::query();

        if (isset($search) && !empty($search)) {
            $baseQuery->where('name', 'like', "%$search%")
                ->orWhere('type', 'like', "%$search%");
        }

        $categories = $baseQuery->latest()->paginate(10);

        return view('ministry-funding.categories', compact('categories'));
    }

    public function insertFundingCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $funding = new FundingCategory();
        $funding->name = $validatedData['name'];
        $funding->type = $validatedData['type'];
        $funding->save();

        return redirect()->route('funding.categories')->with('success', 'Funding category added successfully');
    }

    public function editFundingCategory(Request $request,$id)
    {
        $funding = FundingCategory::find($id);

        if(!$funding)
        {
            return redirect()->back()->with('error', 'Funding not found');
        }

        return view('ministry-funding.category-edit', compact('funding'));
    }

    public function updateFundingCategory(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $funding = FundingCategory::find($id);
        $funding->name = $validatedData['name'];
        $funding->type = $validatedData['type'];
        $funding->save();

        return redirect()->route('funding.categories')->with('success', 'Funding Category updated successfully');
    }

    public function deletefundingCategory(Request $request, $id)
    {
        $funding = FundingCategory::find($id);

        if (!$funding) {
            return redirect()->back()->with('error', 'Funding not found');
        }

        $funding->delete();

        return redirect()->route('funding.categories')->with('success', 'Funding Category deleted successfully');
    }
}
