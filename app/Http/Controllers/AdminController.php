<?php

namespace App\Http\Controllers;

use App\Helper\GlobalHelper;
use App\Models\ActivitySheet;
use App\Models\ActivitySuggesstion;
use App\Models\AdminSetting;
use App\Models\Attendance;
use App\Models\ClosedMonth;
use App\Models\DaycareProvider;
use App\Models\Kid;
use App\Models\KidMeal;
use App\Models\DayCarePayment;
use App\Models\Parents;
use App\Models\ProviderImage;
use App\Models\Ticket;
use App\Models\StickyNote;
use App\Models\SubsidizedCertificate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function index()
    {
        $kidQuery = Kid::where('status', 1);
        $authUser = User::find(Auth::user()->id);
        $totalKids = $kidQuery->count();
        $totalProviders = DaycareProvider::where('status', 1)->count();
        $totalParents = Parents::where('status', 1)->count();
        $monthlyProviderCounts = GlobalHelper::getMonthlyProviderCounts();
        $monthlyParentCounts = GlobalHelper::getMonthlyParentsCounts();
        $monthlyKidCounts = GlobalHelper::getMonthlyKidCounts();

        $adminSettings = AdminSetting::first();

        $totalSeatsAvailable = $adminSettings->spots_allowed_to_provider * $totalProviders;
        $totalFreeSpaces = $totalSeatsAvailable - $totalKids;

        $totalInfants = 0;
        $totalToddlers = 0;
        $totalPreschoolers = 0;

        $kids = $kidQuery->get();
        foreach ($kids as $kid) {
            if (!empty($kid->dob)) {
                $age = GlobalHelper::calculateAgeFromDOB($kid->dob);
                if ($age < 2) {
                    $totalInfants++;
                } elseif ($age >= 2 && $age < 4) {
                    $totalToddlers++;
                } else {
                    $totalPreschoolers++;
                }
            }
        }


        $totalInfantsSeats = $adminSettings->infants_allowed_to_provider * $totalProviders;
        $totalToddlerSeats = $adminSettings->toddlers_allowed_to_provider * $totalProviders;
        $totalPreSchoolSeats = $adminSettings->pre_schoolers_allowed_to_provider * $totalProviders;

        $freeInfantSeats = max(0, $totalInfantsSeats - $totalInfants);
        $freeToddlerSeats = max(0, $totalToddlerSeats - $totalToddlers);
        $freePreSchoolSeats = max(0, $totalPreSchoolSeats - $totalPreschoolers);


        $tickets = $authUser->tickets()->with(['reason'])->latest('updated_at')->limit(5)->get();
        $payments = DayCarePayment::with('provider')->latest('updated_at')->limit(5)->get();
        $attendance = DaycareProvider::latest('updated_at')->limit(5)->get();


        return view('admin.index', compact(
            'monthlyProviderCounts',
            'monthlyParentCounts',
            'monthlyKidCounts',
            'totalKids',
            'totalProviders',
            'totalParents',
            'totalInfants',
            'totalToddlers',
            'totalPreschoolers',
            'totalSeatsAvailable',
            'totalFreeSpaces',
            'totalInfantsSeats',
            'totalToddlerSeats',
            'totalPreSchoolSeats',
            'freeInfantSeats',
            'freeToddlerSeats',
            'freePreSchoolSeats',
            'tickets',
            'payments',
            'attendance',
        ));
    }

    // &&&&&&&&&&& PROVIDERS CRUD FUNCTIONS &&&&&&&&&&&
    public function providers(Request $request)
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
        $baseQuery->selectRaw('*, (license IS NOT NULL) + (police_clearance IS NOT NULL) + (fire_inspection_certificate IS NOT NULL) + (health_assessment_certificate IS NOT NULL) + (cpr IS NOT NULL) + (fire_evacuation_program IS NOT NULL) + (insurance IS NOT NULL) + (contract IS NOT NULL) + (food_handler IS NOT NULL) + (offence_declaration IS NOT NULL) + (notice_of_personal_information_collection IS NOT NULL) + (covid_vaccine IS NOT NULL) + (sign_of_policies IS NOT NULL) + (landlord_approval_letter IS NOT NULL) + (pet_vaccination IS NOT NULL) + (additional_certification IS NOT NULL) AS filled_documents');
        $providers = $baseQuery->latest()->paginate(10);

        foreach ($providers as $provider) {
            // Retrieve admin settings for the current provider
            $adminSettings = AdminSetting::first();
            $totalKids = $provider->kids->where('status', 1)->count();

            // Check if admin settings exist for the provider
            if ($adminSettings) {
                // Calculate available seats and free spaces
                $totalSeatsAvailable = $adminSettings->spots_allowed_to_provider;
                $totalFreeSpaces = $totalSeatsAvailable - $totalKids; // Assuming totalKids is a property or method that retrieves the count of kids for the provider
            } else {
                // Handle the case where admin settings are not available for the provider
                $totalSeatsAvailable = 0;
                $totalFreeSpaces = 0;
            }

            // Initialize age group counters
            $totalInfants = 0;
            $totalToddlers = 0;
            $totalPreschoolers = 0;

            // Retrieve kids for the current provider
            $kids = $provider->kids;

            foreach ($kids as $kid) {
                if (!empty($kid->dob)) {
                    $age = GlobalHelper::calculateAgeFromDOB($kid->dob);

                    // Update age group counters
                    if ($age < 2) {
                        $totalInfants++;
                    } elseif ($age >= 2 && $age < 4) {
                        $totalToddlers++;
                    } else {
                        $totalPreschoolers++;
                    }
                }
            }

            // Add calculated values as properties to the provider object
            $provider->totalSeatsAvailable = $totalSeatsAvailable;
            $provider->totalFreeSpaces = $totalFreeSpaces;
            $provider->totalInfants =  $totalInfants . '/' .  isset($adminSettings) ? $adminSettings->infants_allowed_to_provider : 0;
            $provider->totalToddlers = $totalToddlers . '/' . isset($adminSettings) ? $adminSettings->toddlers_allowed_to_provider : 0;
            $provider->totalPreschoolers = $totalPreschoolers . '/' . isset($adminSettings) ? $adminSettings->pre_schoolers_allowed_to_provider : 0;
        }

        return view('admin.providers', compact('providers'));
    }

    public function addProvider()
    {
        return view('admin.add-provider');
    }

    public function insertProvider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'license' => 'nullable',
            'police_clearance' => 'nullable',
            'bank_details' => 'nullable',
            'password' => 'required|string|min:8|confirmed',
            'fire_inspection_certificate' => 'nullable|mimes:pdf,docx,doc,txt',
            'health_assessment_certificate' => 'nullable|mimes:pdf,docx,doc,txt',
            'cpr' => 'nullable|mimes:pdf,docx,doc,txt',
            'fire_evacuation_program' => 'nullable|mimes:pdf,docx,doc,txt',
            'insurance' => 'nullable|mimes:pdf,docx,doc,txt',
            'contract' => 'nullable|mimes:pdf,docx,doc,txt',
            'food_handler' => 'nullable|mimes:pdf,docx,doc,txt',
            'offence_declaration' => 'nullable|mimes:pdf,docx,doc,txt',
            'notice_of_personal_information_collection' => 'nullable|mimes:pdf,docx,doc,txt',
            'covid_vaccine' => 'nullable|mimes:pdf,docx,doc,txt',
            'sign_of_policies' => 'nullable|mimes:pdf,docx,doc,txt',
            'landlord_approval_letter' => 'nullable|mimes:pdf,docx,doc,txt',
            'pet_vaccination' => 'nullable|mimes:pdf,docx,doc,txt',
            'additional_certification' => 'nullable|mimes:pdf,docx,doc,txt',
            'program_statement_signature' => 'nullable',
            'behavioral_managements_signature' => 'nullable',
            'provider_responsibility_signature' => 'nullable',
            'thrc_membership_num' => 'nullable|string',
            'location_link' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'infant_percentage' => 'nullable',
            'toddler_percentage' => 'nullable',
            'pre_school_percentage' => 'nullable',
            'ministry_funding' => 'nullable',
            'hceg_funding' => 'nullable',
            'joining_date' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $validatedData['password'] = Hash::make($request->password);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('Franchise');

        $validatedData['user_id'] = $user->id;

        $uploadedFiles = [];

        $fileFields = [
            'logo', 'license', 'police_clearance', 'fire_inspection_certificate', 'health_assessment_certificate',
            'cpr', 'fire_evacuation_program', 'insurance', 'contract', 'food_handler', 'offence_declaration',
            'notice_of_personal_information_collection', 'covid_vaccine', 'sign_of_policies',
            'landlord_approval_letter', 'pet_vaccination', 'additional_certification', 'program_statement_signature', 'behavioral_managements_signature', 'provider_responsibility_signature',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $uploadedFiles[$field] = $request->file($field);
            }
        }

        $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/daycare_providers');

        $validatedData['logo'] = $uploadedFiles['logo'] ?? null;
        $validatedData['license'] = $uploadedFiles['license'] ?? null;
        $validatedData['police_clearance'] = $uploadedFiles['police_clearance'] ?? null;
        $validatedData['fire_inspection_certificate'] = $uploadedFiles['fire_inspection_certificate'] ?? null;
        $validatedData['health_assessment_certificate'] = $uploadedFiles['health_assessment_certificate'] ?? null;
        $validatedData['cpr'] = $uploadedFiles['cpr'] ?? null;
        $validatedData['fire_evacuation_program'] = $uploadedFiles['fire_evacuation_program'] ?? null;
        $validatedData['insurance'] = $uploadedFiles['insurance'] ?? null;
        $validatedData['contract'] = $uploadedFiles['contract'] ?? null;
        $validatedData['food_handler'] = $uploadedFiles['food_handler'] ?? null;
        $validatedData['offence_declaration'] = $uploadedFiles['offence_declaration'] ?? null;
        $validatedData['notice_of_personal_information_collection'] = $uploadedFiles['notice_of_personal_information_collection'] ?? null;
        $validatedData['covid_vaccine'] = $uploadedFiles['covid_vaccine'] ?? null;
        $validatedData['sign_of_policies'] = $uploadedFiles['sign_of_policies'] ?? null;
        $validatedData['landlord_approval_letter'] = $uploadedFiles['landlord_approval_letter'] ?? null;
        $validatedData['pet_vaccination'] = $uploadedFiles['pet_vaccination'] ?? null;
        $validatedData['additional_certification'] = $uploadedFiles['additional_certification'] ?? null;
        $validatedData['program_statement_signature'] = $uploadedFiles['program_statement_signature'] ?? null;
        $validatedData['behavioral_managements_signature'] = $uploadedFiles['behavioral_managements_signature'] ?? null;
        $validatedData['provider_responsibility_signature'] = $uploadedFiles['provider_responsibility_signature'] ?? null;
        $validatedData['status'] = $request->status ? 1 : 0;
        $validatedData['code'] = GlobalHelper::generateProviderCode();

        $daycareProvider = DaycareProvider::create($validatedData);

        // add provider images
        if (isset($request->provider_images) && !empty($request->provider_images)) {
            $portfolioImages = $request->provider_images;
            $uploadedPortfolioImages = [];
            $uploadedPortfolioImages = GlobalHelper::uploadAndSaveFile($portfolioImages, 'daycare_images');
            if (!empty($uploadedPortfolioImages)) {
                $daycareProvider->images()->createMany(array_map(function ($image) {
                    return ['image' => $image];
                }, $uploadedPortfolioImages));
            }
        }
        // add provider images

        $validatedData['password'] = $request->password;
        GlobalHelper::sendEmail($user->email, 'Welcome To High5 Daycare | Here are your steps to start with us', 'emails.welcome_provider', $validatedData);

        return redirect()->route('admin.providers')->with('success', 'Daycare provider created successfully');
    }



    public function editProvider(DaycareProvider $provider)
    {
        return view('admin.add-provider', compact('provider'));
    }

    public function updateProvider(Request $request, $id)
    {
        $daycareProvider = DaycareProvider::findOrFail($id);
        $authUser = User::find($daycareProvider->user_id);

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $authUser->id,
            'address' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'license' => 'nullable',
            'police_clearance' => 'nullable',
            'bank_details' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'fire_inspection_certificate' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'health_assessment_certificate' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'cpr' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'fire_evacuation_program' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'insurance' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'contract' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'food_handler' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'offence_declaration' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'notice_of_personal_information_collection' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'covid_vaccine' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'sign_of_policies' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'landlord_approval_letter' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'pet_vaccination' => 'nullable|mimes:pdf,docx,doc,txt,jpg,jpeg',
            'program_statement_signature' => 'nullable',
            'behavioral_managements_signature' => 'nullable',
            'provider_responsibility_signature' => 'nullable',
            'thrc_membership_num' => 'nullable|string',
            'location_link' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'infant_percentage' => 'nullable',
            'toddler_percentage' => 'nullable',
            'pre_school_percentage' => 'nullable',
            'ministry_funding' => 'nullable',
            'hceg_funding' => 'nullable',
            'joining_date' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if the user has updated each field before updating it
        if ($daycareProvider->name != $request->name) {
            $daycareProvider->name = $request->name;
            $authUser->name = $request->name;
        }

        if ($daycareProvider->phone_number != $request->phone_number) {
            $daycareProvider->phone_number = $request->phone_number;
        }

        if ($daycareProvider->email != $request->email) {
            $daycareProvider->email = $request->email;
            $authUser->email = $request->email;
        }

        if ($daycareProvider->country != $request->country) {
            $daycareProvider->country = $request->country;
        }

        if ($daycareProvider->city != $request->city) {
            $daycareProvider->city = $request->city;
        }

        if ($daycareProvider->state != $request->state) {
            $daycareProvider->state = $request->state;
        }

        if ($daycareProvider->address != $request->address) {
            $daycareProvider->address = $request->address;
        }

        if ($daycareProvider->location_link != $request->location_link) {
            $daycareProvider->location_link = $request->location_link;
        }

        if ($daycareProvider->postal_code != $request->postal_code) {
            $daycareProvider->postal_code = $request->postal_code;
        }

        if ($daycareProvider->thrc_membership_num != $request->thrc_membership_num) {
            $daycareProvider->thrc_membership_num = $request->thrc_membership_num;
        }

        // if ($daycareProvider->program_statement_signature != $request->program_statement_signature) {
        //     $daycareProvider->program_statement_signature = $request->program_statement_signature;
        // }

        // if ($daycareProvider->behavioral_managements_signature != $request->behavioral_managements_signature) {
        //     $daycareProvider->behavioral_managements_signature = $request->behavioral_managements_signature;
        // }

        // if ($daycareProvider->provider_responsibility_signature != $request->provider_responsibility_signature) {
        //     $daycareProvider->provider_responsibility_signature = $request->provider_responsibility_signature;
        // }

        if ($daycareProvider->infant_percentage != $request->infant_percentage) {
            $daycareProvider->infant_percentage = $request->infant_percentage;
        }

        if ($daycareProvider->toddler_percentage != $request->toddler_percentage) {
            $daycareProvider->toddler_percentage = $request->toddler_percentage;
        }

        if ($daycareProvider->pre_school_percentage != $request->pre_school_percentage) {
            $daycareProvider->pre_school_percentage = $request->pre_school_percentage;
        }

        if (!empty($request->bank_details)) {
            $daycareProvider->bank_details = $request->bank_details;
        }

        if (!empty($request->ministry_funding)) {
            $daycareProvider->ministry_funding = $request->ministry_funding;
        }

        if (!empty($request->hceg_funding)) {
            $daycareProvider->hceg_funding = $request->hceg_funding;
        }

        if (!empty($request->joining_date)) {
            $daycareProvider->joining_date = $request->joining_date;
        }

        $request['status'] = $request->status ? 1 : 0;

        $daycareProvider->status = $request->status;

        // Update the password if provided
        if (!empty($request->password)) {
            $authUser->password = Hash::make($request->password);
        }

        $authUser->save();


        // Check if files are present in the request and update them
        $uploadedFiles = [];

        $fileFields = [
            'logo', 'license', 'police_clearance', 'fire_inspection_certificate', 'health_assessment_certificate',
            'cpr', 'fire_evacuation_program', 'insurance', 'contract', 'food_handler', 'offence_declaration',
            'notice_of_personal_information_collection', 'covid_vaccine', 'sign_of_policies',
            'landlord_approval_letter', 'pet_vaccination', 'additional_certification', 'program_statement_signature', 'behavioral_managements_signature', 'provider_responsibility_signature',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $uploadedFiles[$field] = $request->file($field);
            }
        }
        // Upload and save logo, license, and police clearance
        $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/daycare_providers'); // Adjust the destination directory as needed

        if (!empty($uploadedFiles['logo'])) {
            $daycareProvider->logo = $uploadedFiles['logo'];
        }

        if (!empty($uploadedFiles['license'])) {
            $daycareProvider->license = $uploadedFiles['license'];
        }

        if (!empty($uploadedFiles['police_clearance'])) {
            $daycareProvider->police_clearance = $uploadedFiles['police_clearance'];
        }

        if (!empty($uploadedFiles['fire_inspection_certificate'])) {
            $daycareProvider->fire_inspection_certificate = $uploadedFiles['fire_inspection_certificate'];
        }

        if (!empty($uploadedFiles['health_assessment_certificate'])) {
            $daycareProvider->health_assessment_certificate = $uploadedFiles['health_assessment_certificate'];
        }

        if (!empty($uploadedFiles['cpr'])) {
            $daycareProvider->cpr = $uploadedFiles['cpr'];
        }

        if (!empty($uploadedFiles['fire_evacuation_program'])) {
            $daycareProvider->fire_evacuation_program = $uploadedFiles['fire_evacuation_program'];
        }

        if (!empty($uploadedFiles['program_statement_signature'])) {
            $daycareProvider->program_statement_signature = $uploadedFiles['program_statement_signature'];
        }

        if (!empty($uploadedFiles['behavioral_managements_signature'])) {
            $daycareProvider->behavioral_managements_signature = $uploadedFiles['behavioral_managements_signature'];
        }

        if (!empty($uploadedFiles['provider_responsibility_signature'])) {
            $daycareProvider->provider_responsibility_signature = $uploadedFiles['provider_responsibility_signature'];
        }


        if (!empty($uploadedFiles['insurance'])) {
            $daycareProvider->insurance = $uploadedFiles['insurance'];
        }

        if (!empty($uploadedFiles['contract'])) {
            $daycareProvider->contract = $uploadedFiles['contract'];
        }

        if (!empty($uploadedFiles['food_handler'])) {
            $daycareProvider->food_handler = $uploadedFiles['food_handler'];
        }

        if (!empty($uploadedFiles['offence_declaration'])) {
            $daycareProvider->offence_declaration = $uploadedFiles['offence_declaration'];
        }

        if (!empty($uploadedFiles['notice_of_personal_information_collection'])) {
            $daycareProvider->notice_of_personal_information_collection = $uploadedFiles['notice_of_personal_information_collection'];
        }

        if (!empty($uploadedFiles['covid_vaccine'])) {
            $daycareProvider->covid_vaccine = $uploadedFiles['covid_vaccine'];
        }

        if (!empty($uploadedFiles['sign_of_policies'])) {
            $daycareProvider->sign_of_policies = $uploadedFiles['sign_of_policies'];
        }

        if (!empty($uploadedFiles['landlord_approval_letter'])) {
            $daycareProvider->landlord_approval_letter = $uploadedFiles['landlord_approval_letter'];
        }

        if (!empty($uploadedFiles['pet_vaccination'])) {
            $daycareProvider->pet_vaccination = $uploadedFiles['pet_vaccination'];
        }

        if (!empty($uploadedFiles['additional_certification'])) {
            $daycareProvider->additional_certification = $uploadedFiles['additional_certification'];
        }

        $daycareProvider->save();


        // Delete and add provider images
        if ($request->has('delete_images') && !empty($request->delete_images) && $request->delete_images != '[]') {
            if (is_string($request->delete_images)) {
                $ids = json_decode($request->delete_images, true);
            } else {
                $ids = $request->delete_images;
            }
            foreach ($ids as $id) {
                ProviderImage::find($id)->delete();
            }
        }

        if (isset($request->provider_images) && !empty($request->provider_images)) {
            $portfolioImages = $request->provider_images;
            $uploadedPortfolioImages = [];
            $uploadedPortfolioImages = GlobalHelper::uploadAndSaveFile($portfolioImages, 'daycare_images');
            if (!empty($uploadedPortfolioImages)) {
                $daycareProvider->images()->createMany(array_map(function ($image) {
                    return ['image' => $image];
                }, $uploadedPortfolioImages));
            }
        }
        // Delete and add provider images

        return redirect()->route('admin.providers')->with('success', 'Daycare provider updated successfully');
    }

    // &&&&&&&&&&& PROVIDERS CRUD FUNCTIONS &&&&&&&&&&&



    // &&&&&&&&&&& PARENTS CRUD FUNCTIONS &&&&&&&&&&&

    public function addParent()
    {
        $providers = DaycareProvider::where('status', 1)->get();
        return view('admin.add-parent', compact('providers'));
    }

    public function insertParent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'address' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'display_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'password' => 'required|string|min:8|confirmed',
            'daycare_provider_id' => 'nullable',
            'photo_id_front' => 'nullable',
            'photo_id_back' => 'nullable',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $authUser = User::find(Auth::id());
        $route = '';

        if ($authUser->hasRole('Admin')) {
            $route = 'admin.parents';
            $provider_id = $request->daycare_provider_id;
        } else {
            $route = 'provider.parents';
            $provider_id = $authUser->provider->id;
        }

        $validatedData['daycare_provider_id'] = $provider_id;

        $validatedData['password'] = Hash::make($request->password);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('Parent');

        $validatedData['user_id'] = $user->id;

        $uploadedFiles = [];

        if ($request->hasFile('display_picture')) {
            $uploadedFiles['display_picture'] = $request->file('display_picture');
        }

        if ($request->hasFile('photo_id_front')) {
            $uploadedFiles['photo_id_front'] = $request->file('photo_id_front');
        }

        if ($request->hasFile('photo_id_back')) {
            $uploadedFiles['photo_id_back'] = $request->file('photo_id_back');
        }

        $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/daycare_parents');

        $validatedData['display_picture'] = $uploadedFiles['display_picture'] ?? null;
        $validatedData['photo_id_front'] = $uploadedFiles['photo_id_front'] ?? null;
        $validatedData['photo_id_back'] = $uploadedFiles['photo_id_back'] ?? null;
        $validatedData['status'] = $request->status ? 1 : 0;
        $validatedData['code'] = GlobalHelper::generateParentCode();

        $parent = Parents::create($validatedData);

        $validatedData['password'] = $request->password;
        GlobalHelper::sendEmail($user->email, 'Welcome To High5 Daycare | Here are your steps to start with us', 'emails.welcome_parent', $validatedData);


        // Send Notification
        $type = 'NewParent';
        // Daycare
        $recipients = DaycareProvider::where('id', $provider_id)->pluck('user_id')->toArray();
        // Daycare
        if (isset($recipients) && !empty($recipients) && count($recipients) > 0) {
            GlobalHelper::sendUpdateNotification($recipients, $type);
        }
        // Send Notification

        return redirect()->route($route)->with('success', 'Parent created successfully');
    }


    public function editParent(Parents $parent)
    {
        $providers = DaycareProvider::where('status', 1)->get();
        return view('admin.add-parent', compact('parent', 'providers'));
    }

    public function updateParent(Request $request, $id)
    {
        $daycareParent = Parents::findOrFail($id);
        $authUser = User::find($daycareParent->user_id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $authUser->id,
            'address' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'display_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
            'daycare_provider_id' => 'nullable',
            'photo_id_front' => 'nullable',
            'photo_id_back' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if the user has updated each field before updating it
        if ($daycareParent->daycare_provider_id != $request->daycare_provider_id) {
            $daycareParent->daycare_provider_id = $request->daycare_provider_id;

            $kids = $daycareParent->kids;
            foreach ($kids as $kid) {
                $kid->provider_id = $request->daycare_provider_id;
                $kid->save();
            }
        }

        if ($daycareParent->name != $request->name) {
            $daycareParent->name = $request->name;
            $authUser->name = $request->name;
        }

        if ($daycareParent->phone_number != $request->phone_number) {
            $daycareParent->phone_number = $request->phone_number;
        }

        if ($daycareParent->email != $request->email) {
            $daycareParent->email = $request->email;
            $authUser->email = $request->email;
        }

        if ($daycareParent->address != $request->address) {
            $daycareParent->address = $request->address;
        }

        if ($daycareParent->country != $request->country) {
            $daycareParent->country = $request->country;
        }

        if ($daycareParent->city != $request->city) {
            $daycareParent->city = $request->city;
        }

        if ($daycareParent->state != $request->state) {
            $daycareParent->state = $request->state;
        }

        if (!empty($request->password)) {
            $authUser->password = Hash::make($request->password);
        }

        $authUser->save();

        if (!empty($request->display_picture)) {
            $uploadedFiles['display_picture'] = $request->file('display_picture');
            $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/daycare_parents');
            $daycareParent->display_picture = $uploadedFiles['display_picture'];
        }

        if (!empty($request->photo_id_front)) {
            $uploadedFiles['photo_id_front'] = $request->file('photo_id_front');
            $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/daycare_parents');
            $daycareParent->photo_id_front = $uploadedFiles['photo_id_front'];
        }

        if (!empty($request->photo_id_back)) {
            $uploadedFiles['photo_id_back'] = $request->file('photo_id_back');
            $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/daycare_parents');
            $daycareParent->photo_id_back = $uploadedFiles['photo_id_back'];
        }

        $request['status'] = $request->status ? 1 : 0;
        $daycareParent->status = $request->status;
        $daycareParent->save();

        return redirect()->route('admin.parents')->with('success', 'Daycare parent updated successfully');
    }


    public function parents(Request $request)
    {
        $user = User::find(Auth::id());
        $route = '';
        if ($user->hasRole('Admin')) {
            $route = 'admin';
        } else {
            $route = 'provider';
        }


        $baseQuery = Parents::query();

        // Search Parents based on coming text
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

        if (isset($request->provider_name) && !empty($request->provider_name)) {
            $providerName = strtolower($request->input('provider_name'));
            $baseQuery->orWhereHas('provider', function ($query) use ($providerName) {
                $query->where('name', 'LIKE', "%$providerName%");
            });
        }
        // Search parents based on coming text

        $parents = $baseQuery->latest()->paginate(10);

        return view($route . '.parents', compact('parents'));
    }

    // &&&&&&&&&&& PARENTS CRUD FUNCTIONS &&&&&&&&&&&



    public function kids(Request $request)
    {
        $baseQuery = Kid::query()->with('provider', 'parent');

        if (isset($request->search_text) && !empty($request->search_text)) {
            $searchText = strtolower($request->input('search_text'));
            $baseQuery->where(function ($query) use ($searchText) {
                $query->where('full_name', 'LIKE', "%$searchText%")
                    ->orWhere('contact_number', 'LIKE', "%$searchText%")
                    ->orWhere('code', 'LIKE', "%$searchText%")->orWhere('code', 'LIKE', "%$searchText%")
                    ->orWhereHas('parent', function ($subQuery) use ($searchText) {
                        $subQuery->where('name', 'LIKE', "%$searchText%");
                    });
            });
        }

        if (isset($request->provider_name) && !empty($request->provider_name)) {
            $baseQuery->whereHas('provider', function ($query) use ($request) {
                $query->where('code', 'LIKE', "%$request->provider_name%");
            });
        }

        $kids = $baseQuery->latest()->paginate(10);

        $providers = DaycareProvider::where('status', 1)->get();
        return view('kids.index', compact('kids', 'providers'));
    }

    public function addKid()
    {
        $authUser = User::find(Auth::id());
        $parents = [];
        if (isset($authUser) && $authUser->hasRole('Admin')) {
            $parents = Parents::latest()->get();
        } elseif (isset($authUser) && $authUser->hasRole('Franchise')) {
            $parents = Parents::where('daycare_provider_id', $authUser->provider->id)->latest()->get();
        }
        return view('kids.edit', compact('parents'));
    }

    public function updateProfile(Request $request)
    {
        // Update the user's profile details based on their role
        $user = User::find(Auth::id());
        $uploadedFiles = [];

        if ($user->hasRole('Franchise')) {
            $path = 'uploads/daycare_providers';

            $fileFields = [
                'logo', 'license', 'police_clearance', 'fire_inspection_certificate', 'health_assessment_certificate',
                'cpr', 'fire_evacuation_program', 'insurance', 'contract', 'food_handler', 'offence_declaration',
                'notice_of_personal_information_collection', 'covid_vaccine', 'sign_of_policies',
                'landlord_approval_letter', 'pet_vaccination', 'additional_certification', 'program_statement_signature', 'behavioral_managements_signature', 'provider_responsibility_signature', 'contract_signature'
            ];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $uploadedFiles[$field] = $request->file($field);
                }
            }

            $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, $path);

            // Update Franchise-specific fields
            $userProviderData = [
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                // 'program_statement_signature' => $request->program_statement_signature,
                // 'behavioral_managements_signature' => $request->behavioral_managements_signature,
                // 'provider_responsibility_signature' => $request->provider_responsibility_signature,
                'thrc_membership_num' => $request->thrc_membership_num,
                'location_link' => $request->location_link,
                'bank_details' => $request->bank_details,
            ];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $userProviderData[$field] = $uploadedFiles[$field];
                }
            }

            if ($request->avatar_remove == "1" || ($request->avatar_remove == 1)) {
                $userProviderData['logo'] = null;
            }


            // Delete and add provider images
            if ($request->has('delete_images') && !empty($request->delete_images) && $request->delete_images != '[]') {
                if (is_string($request->delete_images)) {
                    $ids = json_decode($request->delete_images, true);
                } else {
                    $ids = $request->delete_images;
                }
                foreach ($ids as $id) {
                    ProviderImage::find($id)->delete();
                }
            }

            if (isset($request->provider_images) && !empty($request->provider_images)) {
                $portfolioImages = $request->provider_images;
                $uploadedPortfolioImages = [];
                $uploadedPortfolioImages = GlobalHelper::uploadAndSaveFile($portfolioImages, 'daycare_images');
                if (!empty($uploadedPortfolioImages)) {
                    $user->provider->images()->createMany(array_map(function ($image) {
                        return ['image' => $image];
                    }, $uploadedPortfolioImages));
                }
            }
            // Delete and add provider images


            $user->provider->update($userProviderData);
        } elseif ($user->hasRole('Parent')) {
            $path = 'uploads/daycare_parents';
            if ($request->avatar_remove == "1") {
                $uploadedFiles['display_picture'] = null;
            }

            if (!empty($request->display_picture)) {
                $uploadedFiles['display_picture'] = $request->display_picture;
                // $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, $path);
            }

            if (!empty($request->photo_id_front)) {
                $uploadedFiles['photo_id_front'] = $request->photo_id_front;
                // $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, $path);
            }

            if (!empty($request->contract_signature)) {
                $uploadedFiles['contract_signature'] = $request->contract_signature;
            }

            if (isset($uploadedFiles) && !empty($uploadedFiles) && count($uploadedFiles) > 0) {
                $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, $path);
            }

            $user->parent->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'display_picture' => $uploadedFiles['display_picture'] ?? $user->parent->display_picture,
                'photo_id_front' => $uploadedFiles['photo_id_front'] ?? $user->parent->photo_id_front,
                'photo_id_back' => $uploadedFiles['photo_id_back'] ??  $user->parent->photo_id_back,
                'contract_signature' => $uploadedFiles['contract_signature'] ??  $user->parent->contract_signature,
            ]);
        }

        // Update common fields
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);


        if ($request->current_password && $request->password) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:8',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->password);
            } else {
                return redirect()->back()->with('error', 'Your current password is incorrect');
            }
            $user->save();
        }

        // Redirect back with a success message
        $route = '';
        if ($user->hasRole('Admin')) {
            $route = 'admin.home';

            if (!empty($request->provider_contract)) {
                $uploadedFiles['provider_contract'] = $request->provider_contract;
            }


            if (!empty($request->parent_contract)) {
                $uploadedFiles['parent_contract'] = $request->parent_contract;
            }

            if (!empty($request->parent_guide)) {
                $uploadedFiles['parent_guide'] = $request->parent_guide;
            }

            if (isset($uploadedFiles) && !empty($uploadedFiles) && count($uploadedFiles) > 0) {
                $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/contracts');
            }

            // Add and Update Admin Percentage Settings
            $settings = AdminSetting::first();
            if (isset($settings) && !empty($settings)) {
                $settings->infant = $request->infant;
                $settings->toddler = $request->toddler;
                $settings->pre_school = $request->pre_school;
                $settings->ministry_rate = $request->ministry_rate;
                $settings->spots_allowed_to_provider = $request->spots_allowed_to_provider;
                $settings->thrc_num = $request->thrc_num;
                $settings->ministry_rate_infant = $request->ministry_rate_infant;
                $settings->ministry_rate_toddler = $request->ministry_rate_toddler;
                $settings->ministry_rate_pre_school = $request->ministry_rate_pre_school;
                $settings->infants_allowed_to_provider = $request->infants_allowed_to_provider;
                $settings->toddlers_allowed_to_provider = $request->toddlers_allowed_to_provider;
                $settings->pre_schoolers_allowed_to_provider = $request->pre_schoolers_allowed_to_provider;
                $settings->provider_contract = $uploadedFiles['provider_contract'] ?? $settings->provider_contract;
                $settings->parent_contract = $uploadedFiles['parent_contract'] ?? $settings->parent_contract;
                $settings->parent_guide = $uploadedFiles['parent_guide'] ?? $settings->parent_guide;
                $settings->save();
            } else {
                AdminSetting::create([
                    'infant' => $request->infant,
                    'toddler' => $request->toddler,
                    'pre_school' => $request->pre_school,
                    'ministry_rate' => $request->ministry_rate,
                    'spots_allowed_to_provider' => $request->spots_allowed_to_provider,
                    'thrc_num' => $request->thrc_num,
                    'ministry_rate_infant' => $request->ministry_rate_infant,
                    'ministry_rate_toddler' => $request->ministry_rate_toddler,
                    'ministry_rate_pre_school' => $request->ministry_rate_pre_school,
                    'infants_allowed_to_provider' => $request->infants_allowed_to_provider,
                    'toddlers_allowed_to_provider' => $request->toddlers_allowed_to_provider,
                    'pre_schoolers_allowed_to_provider' => $request->pre_schoolers_allowed_to_provider,
                    'provider_contract' => $uploadedFiles['provider_contract'] ?? null,
                    'parent_contract' => $uploadedFiles['parent_contract'] ?? null,
                    'parent_guide' => $uploadedFiles['parent_guide'] ?? null,
                ]);
            }

            // Add and Update Admin Percentage Settings

        } elseif ($user->hasRole('Franchise')) {
            $route = 'provider.home';
        } else {
            $route = 'parent.home';
        }
        return redirect()->route($route)->with('success', 'Profile updated successfully.');
    }


    public function insertKid(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'age' => 'nullable',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'allergies' => 'nullable|string|max:255',
            'dob' => 'required',
            'contact_number' => 'required',
            'school_start' => 'nullable',
            'contract_start' => 'required',
            'contract_end' => 'nullable',
            'provider_id' => 'nullable',
            'parent_id' => 'nullable',
            'is_subsidized' => 'nullable',
            'subsidized_from' => 'nullable',
            'subsidized_to' => 'nullable',
            'subsidized_percentage' => 'nullable',
            'incident' => 'nullable',
            'is_part_time' => 'nullable',
            'subsidized_certificate' => 'nullable',
            'comments' => 'nullable',
            'registeration_fee' => 'nullable',
            'advance_payment' => 'nullable',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $authUser = User::find(Auth::id());
        $route = '';
        $provider_id = '';

        $parent = Parents::find($request->parent_id);


        //  Logic for checking the spots allowed before adding a new kid
        $adminSettings = AdminSetting::first();

        $countInfant = 0;
        $countToddler = 0;
        $countPreschool = 0;

        $checkDaycareProvider = DaycareProvider::find($parent->daycare_provider_id);
        $kids = $checkDaycareProvider->kids;

        foreach ($kids as $kid) {
            $dob = $kid->dob;
            $ageInDecimal = GlobalHelper::calculateAgeFromDOB($dob);
            // Categorize kids into different age groups
            if ($ageInDecimal < 2) {
                $countInfant++;
            } elseif ($ageInDecimal < 3) {
                $countToddler++;
            } else {
                $countPreschool++;
            }
        }

        $totalKidsInProvider = $countInfant + $countToddler + $countPreschool;

        if (!empty($adminSettings->spots_allowed_to_provider) && $totalKidsInProvider >= $adminSettings->spots_allowed_to_provider) {
            return redirect()->back()->with('error', 'Adding a new kid would exceed the maximum spots allowed')->withInput();
        }

        if (!empty($adminSettings->infants_allowed_to_provider) && $countInfant >= $adminSettings->infants_allowed_to_provider) {
            return redirect()->back()->with('error', 'Adding a new kid would exceed the maximum spots allowed for infants')->withInput();
        }

        if (!empty($adminSettings->toddlers_allowed_to_provider) && $countToddler >= $adminSettings->toddlers_allowed_to_provider) {
            return redirect()->back()->with('error', 'Adding a new kid would exceed the maximum spots allowed for toddlers')->withInput();
        }

        if (!empty($adminSettings->pre_schoolers_allowed_to_provider) && $countPreschool >= $adminSettings->pre_schoolers_allowed_to_provider) {
            return redirect()->back()->with('error', 'Adding a new kid would exceed the maximum spots allowed for pre schoolers')->withInput();
        }
        //  Logic for checking the spots allowed before adding a new kid 


        if ($authUser->hasRole('Admin')) {
            $route = 'admin';
            $provider_id = $parent->daycare_provider_id;
        } elseif ($authUser->hasRole('Franchise')) {
            $route = 'provider';
            $provider_id = $parent->daycare_provider_id;
        } else {
            $route = 'parent';
            $provider_id = $parent->daycare_provider_id;
        }

        $validatedData['provider_id'] = $provider_id;
        $validatedData['parent_id'] = $parent->id;
        $validatedData['code'] = GlobalHelper::generateKidCode($parent->code);

        $uploadedFiles = [];

        if ($request->hasFile('profile_picture')) {
            $uploadedFiles['profile_picture'] = $request->file('profile_picture');
        }

        // if ($request->hasFile('subsidized_certificate')) {
        //     $uploadedFiles['subsidized_certificate'] = $request->file('subsidized_certificate');
        // }

        if (!empty($request->subsidized_certificates)) {
            $subsidizedCertificatePaths = GlobalHelper::uploadAndSaveFile($request->subsidized_certificates, 'uploads/subsidized_certificates');
            foreach ($subsidizedCertificatePaths as $path) {
                $kid->subsidizedCertificates()->create([
                    'certificate_file_path' => $path,
                ]);
            }
        }

        $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/daycare_kids');

        $validatedData['profile_picture'] = $uploadedFiles['profile_picture'] ?? null;
        $validatedData['subsidized_certificate'] = $uploadedFiles['subsidized_certificate'] ?? null;
        $validatedData['subsidy_eligibility'] = $request->subsidy_eligibility ? 1 : 0;
        $validatedData['photo_permission'] = $request->photo_permission ? 1 : 0;
        $validatedData['status'] = $request->status ? 1 : 0;
        $validatedData['is_subsidized'] = $request->is_subsidized ? 1 : 0;
        $validatedData['incident'] = $request->incident ? 1 : 0;
        $validatedData['is_part_time'] = $request->is_part_time ? 1 : 0;

        if (isset($validatedData['is_part_time']) && $validatedData['is_part_time'] == 1) {
            $validatedData['selected_days'] = json_encode($request->input('days', []));
        } else {
            $validatedData['selected_days'] = null;
        }

        // $validatedData['code'] = GlobalHelper::generateProviderCode();
        Kid::create($validatedData);

        $providerEmail = DaycareProvider::where('id', $provider_id)->value('email');
        GlobalHelper::sendEmail($providerEmail, 'Congratulations! | New Kid Registered', 'emails.new_kid', $validatedData);

        // Send Notification
        $type = 'NewKid';
        // Daycare, Admin, Parent
        $recipients = [];
        $daycare = DaycareProvider::where('id', $provider_id)->pluck('user_id')->toArray();
        if ($authUser->hasRole('Admin')) {
            $recipients = array_merge($daycare, [$parent->user_id]);
        } else {
            $adminUserIds = User::whereHas('roles', function ($query) {
                $query->where('name', 'Admin');
            })->pluck('id')->toArray();
            $recipients = array_merge($daycare, $adminUserIds);
        }
        // Daycare, Admin, Parent
        if (isset($recipients) && !empty($recipients) && count($recipients) > 0) {
            GlobalHelper::sendUpdateNotification($recipients, $type);
        }
        // Send Notification

        return redirect()->route($route . '.kids')->with('success', 'Kid created successfully');
    }

    public function editKid(Kid $kid)
    {
        $authUser = User::find(Auth::id());
        $parents = [];
        if (isset($authUser) && $authUser->hasRole('Admin')) {
            $parents = Parents::latest()->get();
        } elseif (isset($authUser) && $authUser->hasRole('Franchise')) {
            $parents = Parents::where('daycare_provider_id', $authUser->provider->id)->latest()->get();
        }
        return view('kids.edit', compact('parents', 'kid'));
    }

    public function updateKid(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'age' => 'nullable',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'allergies' => 'nullable|string|max:255',
            'dob' => 'required',
            'contact_number' => 'required',
            'school_start' => 'nullable',
            'contract_start' => 'required',
            'contract_end' => 'nullable',
            'provider_id' => 'nullable',
            'parent_id' => 'nullable',
            'is_subsidized' => 'nullable',
            'subsidized_from' => 'nullable',
            'subsidized_to' => 'nullable',
            'subsidized_percentage' => 'nullable|numeric|min:1',
            'incident' => 'nullable',
            'subsidized_certificate' => 'nullable',
            'registeration_fee' => 'nullable',
            'advance_payment' => 'nullable',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $startDate = '';
        $endDate = '';

        if (!empty($request->contract_start)) {
            $startDate = Carbon::parse($request->contract_start);
        }

        if (!empty($request->contract_end)) {
            $endDate = Carbon::parse($request->contract_end);
        }

        $attendance = Attendance::where('kid_id', $id)->when(!empty($startDate), function ($query) use ($startDate) {
            $query->whereDate('date', '<', $startDate);
        })->when(!empty($endDate), function ($query) use ($endDate) {
            $query->whereDate('date', '>', $endDate);
        })->first();

        if ($attendance) {

            return redirect()->back()->with('success', 'You need to remove attendance first before Contract start date');
        }

        $daycareKid = Kid::find($id);

        $parent = Parents::find($request->parent_id);

        $uploadedFiles = [];

        if (!empty($request->profile_picture)) {
            $uploadedFiles['profile_picture'] = $request->profile_picture;
            $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/daycare_kids');
            $daycareKid->profile_picture = $uploadedFiles['profile_picture'] ?? null;
        }

        // if (!empty($request->subsidized_certificate)) {
        //     $uploadedFiles['subsidized_certificate'] = $request->subsidized_certificate;
        //     $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/daycare_kids');
        //     $daycareKid->subsidized_certificate = $uploadedFiles['subsidized_certificate'] ?? null;
        // }

        if (!empty($request->subsidized_certificates)) {
            $subsidizedCertificatePaths = GlobalHelper::uploadAndSaveFile($request->subsidized_certificates, 'uploads/subsidized_certificates');
            foreach ($subsidizedCertificatePaths as $path) {
                $daycareKid->subsidizedCertificates()->create([
                    'certificate_file_path' => $path,
                ]);
            }
        }

        if ($daycareKid->full_name != $request->full_name) {
            $daycareKid->full_name = $request->full_name;
        }

        if ($daycareKid->age != $request->age) {
            $daycareKid->age = $request->age;
        }

        if ($daycareKid->allergies != $request->allergies) {
            $daycareKid->allergies = $request->allergies;
        }

        if ($daycareKid->dob != $request->dob) {
            $daycareKid->dob = $request->dob;
        }

        if ($daycareKid->contact_number != $request->contact_number) {
            $daycareKid->contact_number = $request->contact_number;
        }

        if ($daycareKid->school_start != $request->school_start) {
            $daycareKid->school_start = $request->school_start;
        }

        if ($daycareKid->contract_start != $request->contract_start) {
            $daycareKid->contract_start = $request->contract_start;
        }

        if ($daycareKid->contract_end != $request->contract_end) {
            $daycareKid->contract_end = $request->contract_end;
        }

        if ($daycareKid->father_name != $request->father_name) {
            $daycareKid->father_name = $request->father_name;
        }

        if ($daycareKid->mother_name != $request->mother_name) {
            $daycareKid->mother_name = $request->mother_name;
        }

        $request['subsidy_eligibility'] = $request->subsidy_eligibility ? 1 : 0;
        $request['photo_permission'] = $request->photo_permission ? 1 : 0;
        $request['status'] = $request->status ? 1 : 0;
        $request['is_subsidized'] = $request->is_subsidized ? 1 : 0;
        $request['incident'] = $request->incident ? 1 : 0;
        $request['is_part_time'] = $request->is_part_time ? 1 : 0;
        $request['subsidized_from'] = $request->subsidized_from;
        $request['subsidized_to'] = $request->subsidized_to;
        $request['subsidized_percentage'] = $request->subsidized_percentage;

        if (isset($request['is_part_time']) && $request['is_part_time'] == 1) {
            $request['selected_days'] = json_encode($request->input('days', []));
        } else {
            $request['selected_days'] = null;
        }

        $daycareKid->subsidy_eligibility = $request->subsidy_eligibility;
        $daycareKid->photo_permission = $request->photo_permission;
        $daycareKid->incident = $request->incident;
        $daycareKid->status = $request->status;
        $daycareKid->is_subsidized = $request->is_subsidized;
        $daycareKid->subsidized_from = $request->subsidized_from;
        $daycareKid->subsidized_to = $request->subsidized_to;
        $daycareKid->subsidized_percentage = $request->subsidized_percentage;
        $daycareKid->is_part_time = $request->is_part_time;
        $daycareKid->selected_days = $request->selected_days;
        $daycareKid->comments = $request->comments;
        $daycareKid->registeration_fee = $request->registeration_fee;
        $daycareKid->advance_payment = $request->advance_payment;

        $daycareKid->save();

        return redirect()->back()->with('success', 'Kid updated successfully');
    }

    public function download(Request $request, $id)
    {
        if (!empty($request->type) && $request->type === 'activity') {
            $sheet = ActivitySuggesstion::find($id);
        } else {
            $sheet = Attendance::find($id);
        }

        if (!$sheet) {
            return redirect()->back()->with('error', 'Sheet not found');
        }

        $filePath = public_path($sheet->file);
        $today = today();
        // Check if the file exists.
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        abort(404, 'File not found');
    }


    public function meals(Request $request)
    {
        $meals = [];

        $search = $request->input('search_text');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (Auth::check()) {
            $baseQuery = KidMeal::query();

            $user = User::find(Auth::id());

            if (isset($user) && $user->hasRole('Franchise')) {

                $baseQuery->where('provider_id', $user->provider->id);
            } elseif (isset($user) && $user->hasRole('Parent')) {

                $baseQuery->where('provider_id', $user->parent->provider->id);
            }

            if (isset($search) && !empty($search)) {
                $baseQuery->whereHas('provider', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
            }

            if (isset($startDate) && !empty($startDate)) {
                $baseQuery->whereDate('date', '>=', $startDate);
            }

            if (isset($endDate) && !empty($endDate)) {
                $baseQuery->whereDate('end_date', '<=', $endDate);
            }

            $meals = $baseQuery->with(['provider'])->latest()->paginate(10);
        }
        return view('kids.meal', compact('meals'));
    }

    public function kidMeals($id)
    {
        $baseQuery = KidMeal::query();

        $baseQuery->whereHas('kid', function ($kidQuery) use ($id) {
            $kidQuery->where('id', $id);
        });

        $meals = $baseQuery->with(['kid.provider'])->latest()->paginate(10);
        return view('kids.meal', compact('meals'));
    }

    public function attendance(Request $request)
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
        return view('admin.attendance', compact('providers'));
    }


    public function kidAttendanceRecord(Request $request)
    {

        $user = User::find(Auth::id());

        $baseQuery = Attendance::query();

        if (isset($user) && $user->hasRole('Franchise')) {
            $baseQuery->whereHas('provider', function ($query) use ($user) {
                $query->where('provider_id', $user->provider->id);
            });
        } elseif (isset($user) && $user->hasRole('Parent')) {
            $baseQuery->whereHas('kid', function ($query) use ($user) {
                $query->where('parent_id', $user->parent->id);
            });
        }

        $attendance = $baseQuery->when(!empty($request->month), function ($query) use ($request) {
            return $query->whereRaw('MONTH(date) = ?', [$request->month]);
        })->select(DB::raw('YEAR(date) as year'), DB::raw('MONTH(date) as month'), 'kid_id', 'provider_id')
            ->selectRaw('COUNT(*) as record_count')->groupBy('year', 'month', 'provider_id', 'kid_id')->with('kid', 'provider')->get();

        // return $attendance;       
        return $attendance->sum('record_count');
    }

    public function activitySuggesstions(Request $request)
    {
        $sheets = [];
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (Auth::check()) {
            $baseQuery = ActivitySuggesstion::query();

            if (isset($startDate) && !empty($startDate)) {
                $baseQuery->whereDate('date', '>=', $startDate);
            }

            if (isset($endDate) && !empty($endDate)) {
                $baseQuery->whereDate('date', '<=', $endDate);
            }

            $sheets = $baseQuery->latest()->paginate(10);
        }
        return view('activity-suggesstions', compact('sheets'));
    }

    public function addActivitySuggeesstion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'file' => 'required|mimes:csv,xls,xlsx,pdf,txt,text,doc,docx,jpg,jpeg',
        ], [
            'file.mimes' => 'The file must be a CSV, XLS, PDF, TXT, DOCX, JPG or XLSX file.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $uploadedFiles = [];

        $uploadedFile = $request->file('file');

        if ($uploadedFile) {
            $uploadedFiles['file'] = $uploadedFile;
            $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'uploads/activity_suggesstions');
            $activitySheet = new ActivitySuggesstion();
            $activitySheet->date = $request->input('date');
            $activitySheet->file = $uploadedFiles['file'];
            $activitySheet->save();
        }
        return redirect()->route('activity.suggesstions')->with('success', 'Activity suggesstion added successfully');
    }

    public function deleteActivitySuggeesstion($id)
    {
        $activitySheet = ActivitySuggesstion::find($id);
        if (!$activitySheet) {
            return redirect()->back()->with('error', 'Activity suggesstion not found');
        }

        $filePath = public_path($activitySheet->file);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $activitySheet->delete();
        return redirect()->back()->with('success', 'Activity suggesstion deleted successfully');
    }

    public function saveStickyNote(Request $request)
    {
        $noteContent = $request->input('content');
        $color = $request->input('color');
        $stickyNote = new StickyNote(['content' => $noteContent, 'color' => $color, 'created_at' => now(), 'updated_at' => now()]);
        $stickyNote->save();
        return response()->json(['success' => true, 'id' => $stickyNote->id]);
    }

    public function getPreviousNotes()
    {
        $notes = StickyNote::all();
        return response()->json(['notes' => $notes]);
    }

    public function deleteStickyNote($id)
    {
        StickyNote::destroy($id);

        return response()->json(['success' => true]);
    }

    public function updateStickyNote(Request $request, $id)
    {
        $note = StickyNote::find($id);

        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }

        if (isset($request->content) && !empty($request->content)) {
            $note->content = $request->input('content');
        }
        if (isset($request->color) && !empty($request->color)) {
            $note->color = $request->input('color');
        }
        $note->save();

        return response()->json(['success' => true]);
    }

    public function closeMonth(Request $request)
    {
        // try {
        $selectedYear = $request->input('selected-year');
        $selectedMonth = $request->input('selected-month');

        if (empty($selectedMonth) && empty($selectedYear)) {
            $selectedYear = date('Y', strtotime(now()));
            $selectedMonth = date('n', strtotime(now()));
        }

        $existingRecord = ClosedMonth::where('year', $selectedYear)
            ->where('month', $selectedMonth)
            ->first();

        if ($existingRecord) {
            // If the record already exists, delete it
            $existingRecord->delete();

            return redirect()->back()->with('error', 'Month unclosed Successfully');
        } else {
            // If the record doesn't exist, create a new record
            ClosedMonth::create([
                'year' => $selectedYear,
                'month' => $selectedMonth,
            ]);
            return redirect()->back()->with('success', 'Month closed successfully');
        }

        //     // Find the last attendance date
        //     $lastAttendanceDate = Attendance::max('date');

        //     // Check if there are attendance records
        //     if ($lastAttendanceDate) {
        //         // Extract the year and month from the last attendance date
        //         $year = date('Y', strtotime($lastAttendanceDate));
        //         $month = date('n', strtotime($lastAttendanceDate));

        //         $checkExisting = ClosedMonth::where('year', $year)->where('month', $month)->first();

        //         if ($checkExisting) {
        //             return redirect()->back()->with('error', 'Month Already Closed');
        //         }
        //         // Create a record for the closed month
        //         ClosedMonth::create([
        //             'year' => $year,
        //             'month' => $month,
        //         ]);

        //         return redirect()->back()->with('success', 'Month Closed Successfully');
        //     } else {

        //         return redirect()->back()->with('error', 'No attendance records found');
        //     }
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', $e->getMessage());
        // }
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Generate a new random password
            $newPassword = Str::random(12);
            // Hash the new password securely
            $hashedPassword = Hash::make($newPassword);
            // Update the user's password in the database
            $user->update(['password' => $hashedPassword]);

            $validatedData['name'] = $user->name;
            $validatedData['email'] = $user->email;
            $validatedData['password'] = $newPassword;

            GlobalHelper::sendEmail($user->email, 'Password Reset Request', 'emails.forgot-password', $validatedData);
            return redirect()->route('login')->with('success', "Your password reset request was successful! Check your email for further instructions. If you don't see the email in your inbox, please also check your spam folder.");
        } else {
            return redirect()->back()->with('error', 'Account Not Found');
        }
    }

    public function destroyKidSubsidizedCertificate($certificateId)
    {
        // Find and delete the certificate
        $certificate = SubsidizedCertificate::findOrFail($certificateId);
        $certificate->delete();
        // Return a response indicating success or failure
        return response()->json(['message' => 'Certificate deleted successfully']);
    }
}
