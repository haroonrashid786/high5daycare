<?php

namespace App\Http\Controllers;

use App\Helper\GlobalHelper;
use App\Models\AdminSetting;
use App\Models\DaycareProvider;
use App\Models\DispensingRecord;
use App\Models\Invoice;
use App\Models\InvoiceReceivedPayment;
use App\Models\Kid;
use App\Models\KidEmergencyInformation;
use App\Models\KidMeal;
use App\Models\KidMedicationConsent;
use App\Models\KidSupervision;
use App\Models\Parents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use PDF;
use Dompdf\Dompdf;


class ParentController extends Controller
{

    public function index()
    {
        $authUser = User::find(Auth::id());
        
        // if(!$authUser->email == 'testparent@mailinator.com')
        // {
        // Auth::logout();
        // return redirect()->route('login')
        // ->with('error', 'As of now, we would like to inform you that the platform is currently undergoing its final stages of development and testing. We appreciate your enthusiasm and patience during this process.');
        // }

        $parent = Auth::user()->parent;
        $kids = Kid::where('parent_id', $parent->id)->where('status', 1)->get();

        $totalDocuments = 0;
        $filledDocumentsCount = 0;

        foreach ($kids as $kid) {
            $filledDocumentsCount +=
                $kid->emergencyInformation()->count() +
                $kid->supervision()->count() +
                $kid->releaseInformation()->count() +
                $kid->photoPermission()->count() +
                $kid->alternateSleeping()->count() +
                $kid->drugInformation()->count() +
                $kid->medicationConsent()->count() +
                $kid->individualPlan()->count() +
                $kid->contract()->count() +
                $kid->immunizationRecord()->count() +
                $kid->anaphylacticEmergency()->count();

            $totalDocuments += 11;
        }

        $unfilledDocuments = $totalDocuments - $filledDocumentsCount;

        return view('parent.index', compact('kids', 'totalDocuments', 'filledDocumentsCount', 'unfilledDocuments'));
    }

    public function kids(Request $request)
    {
        $baseQuery = Kid::query()->where('parent_id', Auth::user()->parent->id);
        if (isset($request->search_text) && !empty($request->search_text)) {
            $searchText = strtolower($request->input('search_text'));
            $baseQuery->where(function ($query) use ($searchText) {
                $query->where('full_name', 'LIKE', "%$searchText%")
                    ->orWhere('contact_number', 'LIKE', "%$searchText%")->orWhere('code', 'LIKE', "%$searchText%");
            });
        }
        $kids = $baseQuery->latest()->paginate(10);

        return view('kids.index', compact('kids'));
    }

    public function kidDocuments($id)
    {

        $kid = Kid::find($id);
        return view('kids.documents', compact('kid'));
    }

    public function addUpdateKidEmergency(Request $request, $kid)
    {
        $validator = Validator::make($request->all(), [
            'doctor_name' => 'required|string',
            'doctor_address' => 'required|string',
            'medical_center' => 'nullable|string',
            'doctor_phone' => 'required|string',
            'emergency_contact_surname' => 'required|string',
            'emergency_contact_first_name' => 'required|string',
            'emergency_contact_address' => 'required|string',
            'emergency_contact_relationship' => 'required|string',
            'health_card_number' => 'required|string',
            'health_card_dob' => 'required|date',
            'allergies' => 'required|string',
            'health_conditions' => 'required|string',
            'parent_signature' => 'required|string',
            'parent_signature_date' => 'required|date',
            'child_name' => 'required|string',
            'emergency_contact_c_no' => 'required|string',
            'emergency_contact_p_no' => 'required|string',
            'emergency_contact_surname_2' => 'nullable|string',
            'emergency_contact_first_name_2' => 'nullable|string',
            'emergency_contact_address_2' => 'nullable|string',
            'emergency_contact_relationship_2' => 'nullable|string',
            'emergency_contact_c_no_2' => 'nullable|string',
            'emergency_contact_p_no_2' => 'nullable|string',
            'emergency_contact_surname_3' => 'nullable|string',
            'emergency_contact_first_name_3' => 'nullable|string',
            'emergency_contact_address_3' => 'nullable|string',
            'emergency_contact_relationship_3' => 'nullable|string',
            'emergency_contact_c_no_3' => 'nullable|string',
            'emergency_contact_p_no_3' => 'nullable|string',
            'emergency_contact_surname_4' => 'nullable|string',
            'emergency_contact_first_name_4' => 'nullable|string',
            'emergency_contact_address_4' => 'nullable|string',
            'emergency_contact_relationship_4' => 'nullable|string',
            'emergency_contact_c_no_4' => 'nullable|string',
            'emergency_contact_p_no_4' => 'nullable|string',
            'health_card_number_2' => 'nullable|string',
            'health_card_dob_2' => 'nullable|date',
            'allergies_2' => 'nullable|string',
            'health_conditions_2' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kid = Kid::find($kid);

        $validatedData = $validator->validated();

        if ($kid) {
            // Check if the kid already has emergency information
            if ($kid->emergencyInformation) {
                // Update the existing emergency information
                $kid->emergencyInformation->update($validatedData);
            } else {
                // Create a new emergency information record for the kid
                $kid->emergencyInformation()->create($validatedData);
            }
            return redirect()->route('kid.documents', ['id' => $kid])->with('success', 'Emergency information saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }



    public function storeOrUpdateSupervision(Request $request, $kidId)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'transportation_method' => 'required|string|in:vehicle,walking,other',
            'vehicle_model' => 'nullable|string',
            'vehicle_year' => 'nullable|string',
            'vehicle_color' => 'nullable|string',
            'other_details' => 'nullable|string',
            'location_name' => 'nullable|string',
            'location_address' => 'nullable|string',
            'means_of_transport' => 'nullable|string',
            'child_care_provider_sign' => 'nullable|string',
            'child_care_provider_sign_date' => 'nullable|date',
            'parent_guardian_sign' => 'nullable|string',
            'parent_guardian_sign_date' => 'nullable|date',
            'child_name' => 'required|string',
            'child_provider_name' => 'required|string',
            'child_provider_address' => 'required|string',

            'location_name_2' => 'nullable|string',
            'location_address_2' => 'nullable|string',
            'means_of_transport_2' => 'nullable|string',
            'location_name_3' => 'nullable|string',
            'location_address_3' => 'nullable|string',
            'means_of_transport_3' => 'nullable|string',
            'location_name_4' => 'nullable|string',
            'location_address_4' => 'nullable|string',
            'means_of_transport_4' => 'nullable|string',
            'location_name_5' => 'nullable|string',
            'location_address_5' => 'nullable|string',
            'means_of_transport_5' => 'nullable|string',
            'location_name_6' => 'nullable|string',
            'location_address_6' => 'nullable|string',
            'means_of_transport_6' => 'nullable|string',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kid = Kid::find($kidId);

        if ($kid) {
            // Check if the kid already has supervision information
            $supervision = KidSupervision::where('kid_id', $kidId)->first();

            if (!$supervision) {
                // If no record exists, create a new one
                $supervision = new KidSupervision();
                $supervision->kid_id = $kidId;
            }

            // Fill the supervision model with validated data
            $supervision->fill($validator->validated());

            // Save the supervision record
            $supervision->save();

            return redirect()->route('kid.documents', ['id' => $kid])->with('success', 'Supervision information saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }



    public function storeOrUpdateRelease(Request $request, $kidId)
    {
        $validator = Validator::make($request->all(), [
            'child_name' => 'required|string',
            'name' => 'required|string',
            'home_address' => 'required|string',
            'relationship' => 'required|string',
            'place_of_work' => 'required|string',
            'work_address' => 'required|string',
            'cell_number' => 'required|string',
            'phone_number' => 'required|string',
            'work_number' => 'required|string',
            'special_instructions' => 'required|string',


            'name_2' => 'required|string',
            'home_address_2' => 'required|string',
            'relationship_2' => 'required|string',
            'place_of_work_2' => 'required|string',
            'work_address_2' => 'required|string',
            'cell_number_2' => 'required|string',
            'phone_number_2' => 'required|string',
            'work_number_2' => 'required|string',
            'special_instructions_2' => 'required|string',


            'name_3' => 'required|string',
            'home_address_3' => 'required|string',
            'relationship_3' => 'required|string',
            'place_of_work_3' => 'required|string',
            'work_address_3' => 'required|string',
            'cell_number_3' => 'required|string',
            'phone_number_3' => 'required|string',
            'work_number_3' => 'required|string',
            'special_instructions_3' => 'required|string',


            'authorization_name' => 'required|string',
            'authorization_relationship' => 'required|string',
            'authorization_signature' => 'required|string',
            'authorization_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kid = Kid::find($kidId);

        $validatedData = $validator->validated();

        if ($kid) {
            // Check if the kid already has release information
            if ($kid->releaseInformation) {
                // Update the existing release information
                $kid->releaseInformation->update($validatedData);
            } else {
                // Create a new release information record for the kid
                $kid->releaseInformation()->create($validatedData);
            }
            return redirect()->route('kid.documents', ['id' => $kid])->with('success', 'Release information saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }


    public function storeOrUpdatePhotoPermission(Request $request, $kidId)
    {
        $validator = Validator::make($request->all(), [
            'parent_name' => 'required|string',
            'child_name' => 'required|string',
            'date_of_birth' => 'required|string',
            'guardian_name' => 'required|string',
            'consent_given' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kid = Kid::find($kidId);

        $validatedData = $validator->validated();

        $validatedData['consent_given'] = !empty($request->input('consent_given')) ? 1 : 0;

        if ($kid) {
            // Check if the kid already has photo permission
            if ($kid->photoPermission) {
                // Update the existing photo permission
                $kid->photoPermission->update($validatedData);
            } else {
                // Create a new photo permission record for the kid
                $kid->photoPermission()->create($validatedData);
            }
            return redirect()->route('kid.documents', ['id' => $kid])->with('success', 'Photo permission saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }

    public function storeOrUpdateAlternateSleeping(Request $request, $kidId)
    {
        $validator = Validator::make($request->all(), [
            'parent_name' => 'required|string',
            'child_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'sleeping_problems' => 'nullable',
            'sleeping_problem_type' => 'nullable|string',
            'night_sleep_duration' => 'nullable|string',
            'day_sleep_pattern' => 'nullable',
            'sleeping_position' => 'nullable|string',
            'special_ways_to_sleep' => 'nullable',
            'cries_before_sleep' => 'nullable',
            'cries_after_waking_up' => 'nullable',
            'sleeps_in_own_room' => 'nullable',
            'sleeps_in_own_crib_bed' => 'nullable',
            'special_toys_blanket' => 'nullable',
            'consent_to_sleep_on_cot' => 'nullable',
            'consent_to_sleep_on_playpen' => 'nullable',
            'consent_to_sleep_on_provider_bed' => 'nullable',
            'consent_to_sleep_on_couch' => 'nullable',
            'consent_to_sleep_on_other' => 'nullable',
            'parent_signature' => 'required|string',
            'awaking_time' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kid = Kid::find($kidId);

        $validatedData = $validator->validated();

        $validatedData['sleeping_problems'] = !empty($request->input('sleeping_problems')) ? 1 : 0;
        $validatedData['cries_before_sleep'] = !empty($request->input('cries_before_sleep')) ? 1 : 0;
        $validatedData['cries_after_waking_up'] = !empty($request->input('cries_after_waking_up')) ? 1 : 0;
        $validatedData['sleeps_in_own_room'] = !empty($request->input('sleeps_in_own_room')) ? 1 : 0;
        $validatedData['special_ways_to_sleep'] = !empty($request->input('special_ways_to_sleep')) ? 1 : 0;
        $validatedData['sleeps_in_own_crib_bed'] = !empty($request->input('sleeps_in_own_crib_bed')) ? 1 : 0;

        if ($kid) {
            // Check if the kid already has photo permission
            if ($kid->alternateSleeping) {
                // Update the existing photo permission
                $kid->alternateSleeping->update($validatedData);
            } else {
                // Create a new photo permission record for the kid
                $kid->alternateSleeping()->create($validatedData);
            }
            return redirect()->route('kid.documents', ['id' => $kid])->with('success', 'Alternate sleeping saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }

    public function storeOrUpdateKidDrug(Request $request, $kidId)
    {
        $validator = Validator::make($request->all(), [
            'drug_name.*' => 'required',
            'allowed.*' => 'required',
            'brand.*' => 'nullable|string',
            'comments.*' => 'nullable|string',
            'parent_signature' => 'required|string',
            'parent_name' => 'required|string',
            'child_name' => 'required|string',
            'dob' => 'required|date',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kid = Kid::find($kidId);

        if ($kid) {
            foreach ($request->input('drug_id') as $index => $drugId) {
                $drugInformationData = [
                    'drug_id' => $drugId,
                    'drug_name' => $request->drug_name[$index] ?? null,
                    'allowed' => $request->allowed[$index] ?? 0,
                    'brand' => $request->brand[$index] ?? null,
                    'comments' => $request->comments[$index] ?? null,
                    'parent_signature' => $request->parent_signature,
                    'parent_name' => $request->parent_name,
                    'child_name' => $request->child_name,
                    'dob' => $request->dob,
                ];
                // Check if the kid already has drug information for this drug
                $existingDrugInfo = $kid->drugInformation()->where('drug_id', $drugId)->first();
                if (!$existingDrugInfo) {
                    // Create a new drug information record for the kid
                    $kid->drugInformation()->create($drugInformationData);
                } else {
                    // Update the existing drug information
                    $existingDrugInfo->update($drugInformationData);
                }
            }

            return redirect()->route('kid.documents', ['id' => $kid])->with('success', 'Drug information saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }


    public function storeOrUpdateKidMedication(Request $request, $kidId)
    {
        $rules = [
            'child_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'physician_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'medication_name' => 'required|string|max:255',
            'medication_prescribed_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'dosage' => 'required|string|max:255',
            'parent_times_given' => 'required|string|max:255',
            'provider_times_given' => 'required|string|max:255',
            'provider_amount_given' => 'required|string|max:255',
            'storage_instructions' => 'required|string|max:255',
            'side_effects' => 'required|string',
            'parent_signature' => 'required|string|max:255',
            // 'dispensing_records' => 'array',
            // 'dispensing_records.*.date' => 'required|date',
            // 'dispensing_records.*.item_given' => 'required|string|max:255',
            // 'dispensing_records.*.dosage' => 'required|string|max:255',
            // 'dispensing_records.*.signature' => 'required|string|max:255',
            // 'dispensing_records.*.observations' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kid = Kid::find($kidId);

        if ($kid) {

            if ($kid->medicationConsent) {
                // Update the existing Medication
                $kid->medicationConsent->update($request->except('dispensing_records'));
                $kidMedicationConsent = $kid->medicationConsent;
            } else {
                // Create a new Medication for the kid
                $kidMedicationConsent = $kid->medicationConsent()->create($request->except('dispensing_records'));
            }


            if ($kidMedicationConsent) {
                $dispensingRecords = $request->input('dispensing_records');
                if ($dispensingRecords && is_array($dispensingRecords)) {
                    // Delete existing records
                    if ($kidMedicationConsent->dispensingRecords) {
                        $kidMedicationConsent->dispensingRecords()->delete();
                    }

                    foreach ($dispensingRecords as $recordData) {
                        $dispensingRecord = new DispensingRecord($recordData);
                        $kidMedicationConsent->dispensingRecords()->save($dispensingRecord);
                    }
                }
            }
            return redirect()->route('kid.documents', ['id' => $kidId])->with('success', 'Medication Consent saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }

    public function storeOrUpdateAnaphylacticEmergency(Request $request, $kidId)
    {
        $rules = [
            'child_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,jpg|max:2048',
            'peanuts' => 'nullable',
            'tree_nuts' => 'nullable',
            'eggs' => 'nullable',
            'milk' => 'nullable',
            'insect_stings' => 'nullable|string|max:255',
            'latex' => 'nullable|string|max:255',
            'medications' => 'nullable|string|max:255',
            'others' => 'nullable|string|max:255',
            'epipen_jr' => 'nullable',
            'epipen' => 'nullable',
            'twinjet_015mg' => 'nullable',
            'twinjet_030mg' => 'nullable',
            'location_of_auto_injectors' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'emergency_contact_home_phone' => 'nullable|string|max:20',
            'emergency_contact_cell_phone' => 'nullable|string|max:20',
            'emergency_contact_work_phone' => 'nullable|string|max:20',

            'emergency_contact_name_2' => 'nullable|string|max:255',
            'emergency_contact_relationship_2' => 'nullable|string|max:255',
            'emergency_contact_home_phone_2' => 'nullable|string|max:20',
            'emergency_contact_cell_phone_2' => 'nullable|string|max:20',
            'emergency_contact_work_phone_2' => 'nullable|string|max:20',

            'parent_signature' => 'nullable|string|max:255',



        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $validatedData['peanuts'] = !empty($request->input('peanuts')) ? 1 : 0;
        $validatedData['tree_nuts'] = !empty($request->input('tree_nuts')) ? 1 : 0;
        $validatedData['eggs'] = !empty($request->input('eggs')) ? 1 : 0;
        $validatedData['milk'] = !empty($request->input('milk')) ? 1 : 0;
        $validatedData['epipen_jr'] = !empty($request->input('epipen_jr')) ? 1 : 0;
        $validatedData['epipen'] = !empty($request->input('epipen')) ? 1 : 0;
        $validatedData['twinjet_015mg'] = !empty($request->input('twinjet_015mg')) ? 1 : 0;
        $validatedData['twinjet_030mg'] = !empty($request->input('twinjet_030mg')) ? 1 : 0;

        $kid = Kid::find($kidId);

        $uploadedFiles = [];
        $uploadedFile = $request->file('photo');

        if ($kid) {

            if ($uploadedFile) {
                $uploadedFiles['photo'] = $uploadedFile;
                $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/kids/forms');
                $validatedData['photo'] = $uploadedFiles['photo'];
            }

            if ($kid->anaphylacticEmergency) {
                // Update the anaphylactic Emergency
                $kid->anaphylacticEmergency->update($validatedData);
            } else {
                // Create a new anaphylactic Emergency for the kid
                $kid->anaphylacticEmergency()->create($validatedData);
            }

            return redirect()->route('kid.documents', ['id' => $kid])->with('success', 'Anaphylactic Emergency saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }



    public function storeOrUpdateIndividualAction(Request $request, $kidId)
    {
        $rules = [

            'child_name' => 'required|string|max:255',
            'child_home_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'child_care_provider' => 'required|string|max:255',
            'child_care_address' => 'required|string|max:255',
            'child_care_phone' => 'required|string|max:20',
            'emergency_contact_name' => 'required|string|max:20',
            'emergency_contact_phone_work'  => 'nullable|string|max:20',
            'emergency_contact_phone_cell' => 'nullable|string|max:20',
            'emergency_contact_phone_home' => 'nullable|string|max:20',
            'observed_requirements' => 'nullable|string|max:255',
            'call_parent_guardian' => 'nullable|string|max:255',
            'parent_guardian_name' => 'required|string|max:255',
            'parent_guardian_phone_work' => 'nullable|string|max:20',
            'parent_guardian_phone_cell' => 'nullable|string|max:20',
            'parent_guardian_phone_home' => 'nullable|string|max:20',
            'call_911' => 'nullable',
            'call_doctor' => 'nullable',
            'doctor_name' => 'nullable',
            'doctor_phone' => 'nullable',
            'medication_name' => 'nullable',
            'dose' => 'nullable',
            'signature' => 'required',
            'date' => 'required',

            'medical_condition' => 'required|string',
            'symptoms' => 'required|string',
            'acute' => 'nullable',
            'chronic' => 'nullable',
            'triggers' => 'required|string',
            'other_information' => 'required|string',
            'daily_modification' => 'required|string',
            'medical_devices' => 'required|string',
            'support' => 'required|string',
            'evacuation_procedure' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['acute'] = $request->input('acute') ?? 0;
        $validatedData['chronic'] = $request->input('chronic') ?? 0;
        
        $kid = Kid::find($kidId);

        if ($kid) {

            if ($kid->individualPlan) {
                // Update the Individual Plan
                $kid->individualPlan->update($validatedData);
            } else {
                // Create a new Individual Plan for the kid
                $kid->individualPlan()->create($validatedData);
            }
            return redirect()->route('kid.documents', ['id' => $kid])->with('success', 'Individual plan saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }


    public function storeOrUpdateContract(Request $request, $kidId)
    {
        $rules = [

            'parent_name' => 'required|string|max:255',
            'parent_signature' => 'required',
            'date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        if (!empty($request->contract_type) && $request->contract_type == 'toddler') {
            $validatedData['contract_type'] = 'toddler';
        } else {
            $validatedData['contract_type'] = 'infant';
        }

        $kid = Kid::find($kidId);

        if ($kid) {
            if ($kid->contract) {
                // Update the contract Plan
                $kid->contract->update($validatedData);
            } else {
                // Create a new contract for the kid
                $kid->contract()->create($validatedData);
            }
            return redirect()->route('kid.documents', ['id' => $kid])->with('success', 'Contract saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }



    public function storeOrUpdateImmunization(Request $request, $kidId)
    {
        $rules = [
            'file' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png,webp',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $uploadedFiles = [];

        $uploadedFile = $request->file('file');

        $kid = Kid::find($kidId);

        if ($kid) {

            if ($uploadedFile) {
                $uploadedFiles['file'] = $uploadedFile;
                $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/kid/immunization');
            }

            if ($kid->immunizationRecord) {
                // Update the immunizationRecord Plan
                $kid->immunizationRecord->update([
                    'file' => $uploadedFiles['file']
                ]);
            } else {
                // Create a new immunizationRecord for the kid
                $kid->immunizationRecord()->create([
                    'file' => $uploadedFiles['file']
                ]);
            }
            return redirect()->route('kid.documents', ['id' => $kid])->with('success', 'Immunization record saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }



    public function viewInvoice($invoiceId, Request $request)
    {
        $invoice = Invoice::where('invoice_number', $invoiceId)->with('parent', 'provider', 'invoiceData.kid')->first();
        $adminSettings = AdminSetting::first();

        $formattedDate = Carbon::parse($invoice->created_at);
        $alreadyPaid = InvoiceReceivedPayment::where('kid_id', $invoice->kid_id)->whereMonth('date', $formattedDate)->value('amount') ?? 0;

        foreach ($invoice->invoiceData as $item) {
            $kid_age = $item->kid_age;
            $item->isSubsidized = false;

            if ($kid_age < 2) {
                $kidRate = $adminSettings->infant ?? 49.84;
                $defaultMinistryRate = $adminSettings->ministry_rate_infant ?? 52;
            } elseif ($kid_age >=2 && $kid_age < 4) {
                $kidRate = $adminSettings->toddler ?? 47.60;
                $defaultMinistryRate = $adminSettings->ministry_rate_toddler ?? 52;
            } else {
                $kidRate = $adminSettings->pre_school ?? 47.20;
                $defaultMinistryRate = $adminSettings->ministry_rate_pre_school ?? 52;
            }

            // $rate = $kidRate - ($kidRate * ($defaultMinistryRate / 100));
            // $rate = round($rate, 2);
            $rate =round($kidRate * (1 - ($defaultMinistryRate / 100)), 2);

            // Now, you can use $rate for further processing or update it in the item data
            if ($item->ministry_share == 0) {
                $item->isSubsidized = true;
                $nonSubsidizedRate = round($item->rate * (1 - ($defaultMinistryRate / 100)), 2);
                $item->kid_rate_for_non_subsidized_days = $nonSubsidizedRate;
                $item->kid_rate_for_subsidized_days = round(optional($item->kid)->subsidized_percentage - ($item->rate * ($defaultMinistryRate / 100)), 2);
            } elseif (!empty($item->subsidized_days) && !empty($item->non_subsidized_days)) {
                $item->isSubsidized = true;
                // Given rate for subsidized days
                // $rateForSubsidizedDays = $item->rate;
                // // Calculate rate for non-subsidized days
                // $rateForNonSubsidizedDays = $rateForSubsidizedDays - (($defaultMinistryRate / 100) * $rateForSubsidizedDays);
                // $unifiedRate = ($item->subsidized_days * $rateForSubsidizedDays + $item->non_subsidized_days * $rateForNonSubsidizedDays) / ($item->subsidized_days + $item->non_subsidized_days);
                // $item->kid_rate = round($unifiedRate,2);
                $nonSubsidizedRate = round($item->rate * (1 - ($defaultMinistryRate / 100)), 2);
                $item->kid_rate_for_non_subsidized_days = $nonSubsidizedRate;
                $item->kid_rate_for_subsidized_days = round(optional($item->kid)->subsidized_percentage - ($item->rate * ($defaultMinistryRate / 100)), 2);
            } else {
                $item->kid_rate = $rate;
            }
        }

        // if ($invoice->invoiceItems->kid_age < 2) {
        //     $kidRate = $adminSettings->infant ?? 49.84;
        //     $defaultMinistryRate = $adminSettings->ministry_rate_infant ?? 52;
        // } elseif ($invoice->invoiceItems->kid_age < 3) {
        //     $kidRate = $adminSettings->toddler ?? 47.60;
        //     $defaultMinistryRate = $adminSettings->ministry_rate_toddler ?? 52;
        // } else {
        //     $kidRate = $adminSettings->pre_school ?? 47.20;
        //     $defaultMinistryRate = $adminSettings->ministry_rate_pre_school ?? 52;
        // }

        // $rate = $kidRate - ($kidRate * ($defaultMinistryRate / 100));
        // $rate = round($rate, 2);

        $user = User::find(Auth::id());

        if (isset($user) && $user->hasRole('Admin') && !$request->view_pdf == 1) {
            return view('payments.generate-invoice', compact('invoice', 'alreadyPaid'));
        } else {

            // return view('payments.generate-invoice',compact('invoice'));
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

            // Output the generated PDF
            return $pdf->stream('invoice.pdf', ['Attachment' => 0]);
        }
    }


    public function providerDetails()
    {
        $user = User::find(Auth::id());

        if (isset($user) && $user->hasRole('Parent')) {
            $provider = DaycareProvider::where('id', $user->parent->provider->id)->with('images')->first();
            return view('parent.provider-detail', compact('provider'));
        } else {
            abort(401);
        }
    }

    public function parentContract($parent)
    {
        $parent = Parents::find($parent);
        return view('newUI.parent-guide', compact('parent'));
    }

    public function updateParentContract(Request $request, $parent)
    {

        $rules = [
            'contract_signature' => 'required',
            'contract_signature_date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $parent = Parents::find($parent);

        if ($parent) {
            $parent->contract_signature =  $validatedData['contract_signature'];
            $parent->contract_signature_date =  $validatedData['contract_signature_date'];
            $parent->save();
            return redirect()->route('settings')->with('success', 'Contract saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Parent not found.');
        }
    }

    public function storeOrUpdateKidEnrollementForm(Request $request, $kidId)
    {
        $rules = [
            'surname' => 'nullable|string',
            'given_name' => 'nullable|string',
            'sex' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
            'special_need' => 'nullable',
            'allergies_life_threatening' => 'nullable',
            'allergies_non_life_threatening' => 'nullable',
            'medical_condition' => 'nullable',
            'potty_trained' => 'nullable',
            'special_feeding_arrangements' => 'nullable',
            'extra_concern' => 'nullable|string',

            'mother_surname' => 'nullable|string|max:255',
            'mother_given_name' => 'nullable|string|max:255',
            'mother_home_address' => 'nullable|string|max:255',
            'mother_postal_code' => 'nullable|string|max:20',
            'mother_cell_phone' => 'nullable|string|max:20',
            'mother_home_phone' => 'nullable|string|max:20',
            'mother_work_place' => 'nullable|string|max:255',
            'mother_work_address' => 'nullable|string|max:255',
            'mother_work_phone' => 'nullable|string|max:20',
            'mother_email' => 'nullable|email|max:255',
            'mother_date_of_birth' => 'nullable|date',
            'mother_custody' => 'nullable',

            'father_surname' => 'nullable|string|max:255',
            'father_given_name' => 'nullable|string|max:255',
            'father_home_address' => 'nullable|string|max:255',
            'father_postal_code' => 'nullable|string|max:20',
            'father_cell_phone' => 'nullable|string|max:20',
            'father_home_phone' => 'nullable|string|max:20',
            'father_work_place' => 'nullable|string|max:255',
            'father_work_address' => 'nullable|string|max:255',
            'father_work_phone' => 'nullable|string|max:20',
            'father_email' => 'nullable|email|max:255',
            'father_date_of_birth' => 'nullable|date',
            'father_custody' => 'nullable',
            


            'type_of_care' => 'nullable|in:parttime,fulltime,before/after',
            'start_date' => 'nullable|date',
            'days_of_care' => 'nullable|string',
            'term_date' => 'nullable|date',
            'house_of_care' => 'nullable|string',

            'parent_sign' => 'nullable|string',
            'provider_sign' => 'nullable|string',
            'agency_sign' => 'nullable|string',
            'chiled_file_number' => 'nullable|string',
            'deposit_amount' => 'nullable|string',


        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $validatedData['sex'] = $request->input('sex') ?? 'male';
        $validatedData['special_need'] = $request->input('special_need') ?? 0;
        $validatedData['allergies_life_threatening'] = $request->input('allergies_life_threatening') ?? 0;
        $validatedData['allergies_non_life_threatening'] = $request->input('allergies_non_life_threatening') ?? 0;
        $validatedData['medical_condition'] = !empty($request->input('medical_condition')) ? 1 : 0;
        $validatedData['potty_trained'] = !empty($request->input('potty_trained')) ? 1 : 0;
        $validatedData['special_feeding_arrangements'] = $request->input('special_feeding_arrangements') ?? 0;
        $validatedData['mother_custody'] = $request->input('mother_custody') ?? 0;
        $validatedData['father_custody'] = $request->input('father_custody') ?? 0;

        $kid = Kid::find($kidId);



        if ($kid) {

            if ($kid->enrollementForm) {
                // Update the anaphylactic Emergency
                $kid->enrollementForm->update($validatedData);
            } else {
                // Create a new anaphylactic Emergency for the kid
                $kid->enrollementForm()->create($validatedData);
            }

            return redirect()->route('kid.documents', ['id' => $kid])->with('success', 'Child enrollment form saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kid not found.');
        }
    }
}
