<?php
include __DIR__ . '/provider.php';
include __DIR__ . '/parent.php';
include __DIR__ . '/web_site.php';

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\MinistryFundingController;
use App\Http\Controllers\NapController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\WebsiteController;
use App\Models\ActivitySheet;
use App\Models\AdminSetting;
use App\Models\Attendance;
use App\Models\ClosedMonth;
use App\Models\DailyUpdates;
use App\Models\DailyUpdatesMedia;
use App\Models\DayCarePayment;
use App\Models\DaycareProvider;
use App\Models\Drug;
use App\Models\Invoice;
use App\Models\InvoiceReceivedPayment;
use App\Models\Kid;
use App\Models\NapTime;
use App\Models\Notification;
use App\Models\PaidPayment;
use App\Models\Parents;
use App\Models\ParentSurvey;
use App\Models\TicketReason;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use NunoMaduro\Collision\Provider;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('survey/parent', function () {
    return view('survey.parent');
});

Route::get('kid/attendence',[ProviderController::class, 'allAttendancePD'])->name('all.attendance.pd');
Route::get('/nap_time',[NapController::class, 'index'])->name('all.nap.pd');
Route::get('admin/nap/timings', [NapController::class, 'adminNapTimings'])->name('admin.nap.time');


Route::get('survey/provider', function () {
    return view('survey.provider');
});

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('login', function () {
    if (Auth::check()) {
        $authUser = User::find(Auth::id());
        if ($authUser->hasRole('Admin')) {
            return redirect()->route('admin.home')->with('success', 'Welcome back to Admin dashboard!');
        } elseif ($authUser->hasRole('Franchise')) {
            return redirect()->route('provider.home')->with('success', 'Welcome back to daycare providers dashboard!');
        } else {
            return redirect()->route('parent.home')->with('success', 'Welcome back to parents dashboard!');
        }
    }
    return view('auth.login');
})->name('auth.login');


Route::get('/forgot-password', [AdminController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [AdminController::class, 'sendResetLinkEmail'])->name('password.email');


Route::group(['middleware' => ['auth', 'role:Admin'], 'prefix' => 'ledgers'], function () {

    Route::get('/', [LedgerController::class, 'index'])->name('ledger.index');
    Route::get('gross-profit-ledger', [LedgerController::class, 'gpLedger'])->name('gp.ledger');
    Route::get('bank-details-ledger', [LedgerController::class, 'bankLedger'])->name('bank.ledger');
    Route::get('security-deposit-ledger', [LedgerController::class, 'securityLedger'])->name('security.ledger');
    Route::get('registraion-fee-ledger', [LedgerController::class, 'registrationLedger'])->name('registration.ledger');
    Route::get('general-ledger', [LedgerController::class, 'generalLedger'])->name('general.ledger');
    Route::get('hceg', [LedgerController::class, 'hcegLedger'])->name('hceg.ledger');
    Route::get('gog', [LedgerController::class, 'gogLedger'])->name('gog.ledger');
    Route::get('subsidary', [LedgerController::class, 'subsidaryLedger'])->name('subsidary.ledger');
    Route::get('ministry-ledger', [LedgerController::class, 'ministryLedger'])->name('ministry.ledger');
    Route::get('kid-payment', [LedgerController::class, 'kidPayments'])->name('kid.payment');
    Route::get('provider-payments', [LedgerController::class, 'providerPayments'])->name('ledger.provider.payments');
});


// **********  Super Admin Protected  Routes  ********
Route::group(['middleware' => ['auth', 'role:Admin'], 'prefix' => 'admin'], function () {


    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/providers', [AdminController::class, 'providers'])->name('admin.providers');
    Route::get('/parents', [AdminController::class, 'parents'])->name('admin.parents');
    Route::get('/kids', [AdminController::class, 'kids'])->name('admin.kids');

    Route::get('/attendance', [AdminController::class, 'attendance'])->name('admin.attendance');


    Route::get('/add-provider', [AdminController::class, 'addProvider'])->name('admin.add.provider');
    Route::post('/add-provider', [AdminController::class, 'insertProvider'])->name('admin.insert.provider');

    Route::get('/edit-provider/{provider}', [AdminController::class, 'editProvider'])->name('admin.edit.provider');
    Route::post('/update-provider/{id}', [AdminController::class, 'updateProvider'])->name('admin.update.provider');


    //  ************** Payments Module *********************
    Route::get('get/providers', [PaymentController::class, 'getProviders'])->name('get.providers');
    Route::post('generate/invoice/{code}', [PaymentController::class, 'generateInvoice'])->name('invoice.generate');
    Route::post('pay/invoice', [PaymentController::class, 'payInvoice'])->name('pay.invoice');
    Route::post('add_security_deposit_to_invoice/{invoiceNumber}', [PaymentController::class, 'addSecurityDeposit'])->name('add.security.deposit');

    Route::get('get/parents', [PaymentController::class, 'getParents'])->name('get.parents');
    Route::post('generate/pay/{code}', [TestController::class, 'generatePayment'])->name('pay.generate');
    Route::post('pay/payment', [PaymentController::class, 'payPayment'])->name('pay.payment');
    //  ************** Payments Module *********************

    Route::post('activity_suggesstions', [AdminController::class, 'addActivitySuggeesstion'])->name('add.activity.suggesstions');
    Route::post('delete/activity/{id}', [AdminController::class, 'deleteActivitySuggeesstion'])->name('delete.activity.suggesstions');

    Route::post('close/month', [AdminController::class, 'closeMonth'])->name('close-month');


    Route::get('fundings', [MinistryFundingController::class, 'fundings'])->name('fundings');
    Route::get('add/funding', [MinistryFundingController::class, 'addFunding'])->name('add.funding');
    Route::post('add/funding', [MinistryFundingController::class, 'insertFunding'])->name('insert.funding');
    Route::get('update/funding/{id}', [MinistryFundingController::class, 'editFunding'])->name('edit.funding');
    Route::post('update/funding/{id}', [MinistryFundingController::class, 'updateFunding'])->name('update.funding');
    Route::post('delete/funding/{id}', [MinistryFundingController::class, 'deletefunding'])->name('delete.funding');

    Route::get('funding/categories', [MinistryFundingController::class, 'fundingCategories'])->name('funding.categories');
    Route::post('add/funding/category', [MinistryFundingController::class, 'insertFundingCategory'])->name('add.funding.category');
    Route::get('update/funding/category/{id}', [MinistryFundingController::class, 'editFundingCategory'])->name('edit.funding.category');
    Route::post('update/funding/category/{id}', [MinistryFundingController::class, 'updateFundingCategory'])->name('update.funding.category');
    Route::post('delete/funding/category/{id}', [MinistryFundingController::class, 'deletefundingCategory'])->name('delete.funding.category');
});
// **********  Super Admin Protected Routes  ********

Route::get('/add-parent', [AdminController::class, 'addParent'])->name('admin.add.parent');
Route::post('/add-parent', [AdminController::class, 'insertParent'])->name('admin.insert.parent');

Route::get('/edit-parent/{parent}', [AdminController::class, 'editParent'])->name('admin.edit.parent');
Route::post('/update-parent/{id}', [AdminController::class, 'updateParent'])->name('admin.update.parent');

Route::post('/update-profile', [AdminController::class, 'updateProfile'])->name('update.profile');

Route::get('/add-kid', [AdminController::class, 'addKid'])->name('admin.add.kid');
Route::post('/add-kid', [AdminController::class, 'insertKid'])->name('admin.insert.kid');

Route::get('/edit-kid/{kid}', [AdminController::class, 'editKid'])->name('admin.edit.kid');
Route::post('/update-kid/{id}', [AdminController::class, 'updateKid'])->name('admin.update.kid');


Route::get('/activity-sheets', function (Request $request) {
    $sheets = [];

    $search = $request->input('search_text');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    if (Auth::check()) {
        $baseQuery = ActivitySheet::query();

        $user = User::find(Auth::id());

        if (isset($user) && $user->hasRole('Franchise')) {
            $baseQuery->where('provider_id', $user->provider->id);
        } elseif (isset($user) && $user->hasRole('Parent')) {
            $baseQuery->where('provider_id', $user->parent->provider->id);
        }

        if (isset($search) && !empty($search)) {
            $baseQuery->whereHas('provider', function ($kidQuery) use ($search) {
                $kidQuery->where('name', 'like', "%$search%");
            });
        }

        if (isset($startDate) && !empty($startDate)) {
            $baseQuery->whereDate('created_at', '>=', $startDate);
        }

        if (isset($endDate) && !empty($endDate)) {
            $baseQuery->whereDate('created_at', '<=', $endDate);
        }

        $sheets = $baseQuery->with(['provider'])->latest()->paginate(10);
    }
    return view('activity-sheets', compact('sheets'));
})->name('activity-sheets');

Route::get('meals', [AdminController::class, 'meals'])->name('meals.index');
Route::get('kid-meals/{id}', [AdminController::class, 'kidMeals'])->name('kid.meals');




Route::get('download/{id}', [AdminController::class, 'download'])->name('download.file');

Route::post('/update-blog-status', [WebsiteController::class, 'updateStatus'])->name('update-blog-status');
Route::post('/blog-store/{id?}', [WebsiteController::class, 'blogStore'])->name('blog.store');
Route::get('/all-blogs', [WebsiteController::class, 'blogsIndex'])->name('all.blogs');
Route::get('/create-blog', [WebsiteController::class, 'createBlog'])->name('create.blog');
Route::get('/edit-blog/{slug}', [WebsiteController::class, 'editBlog'])->name('edit.blog');
Route::get('/create-ticket', [CommunicationController::class, 'createTicket'])->name('create.ticket');
Route::post('/create-ticket', [CommunicationController::class, 'initializeChat'])->name('start.ticket');
Route::get('/communication', [CommunicationController::class, 'messageIndex'])->name('communication');
Route::get('/communication-detail/{ticket}', [CommunicationController::class, 'messageShow'])->name('communication-detail');
Route::post('/send-message', [CommunicationController::class, 'storeMessage'])->name('send-message');
Route::post('/end-communication/{ticket}', [CommunicationController::class, 'endCommunication'])->name('end-communication');
Route::post('tickets/add-feedback/{ticket}', [CommunicationController::class, 'updateFeedback'])->name('tickets.updateFeedback');


Route::get('/portal', function () {
    if (Auth::check()) {
        $authUser = User::find(Auth::id());
        if ($authUser->hasRole('Admin')) {
            return redirect()->route('admin.home')->with('success', 'Welcome back to Admin dashboard!');
        } elseif ($authUser->hasRole('Franchise')) {
            return redirect()->route('provider.home')->with('success', 'Welcome back to daycare providers dashboard!');
        } else {
            return redirect()->route('parent.home')->with('success', 'Welcome back to parents dashboard!');
        }
    }
    return view('auth.login');
})->name('base');


Route::group(['middleware' => ['auth']], function () {

    Route::get('activity_suggesstions', [AdminController::class, 'activitySuggesstions'])->name('activity.suggesstions');


    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('vacations', [ProviderController::class, 'vacations'])->name('vacations');

    Route::get('view_invoice/{invoiceId}', [ParentController::class, 'viewInvoice'])->name('view.invoice');
    Route::get('view_payment/{paymentId}', [ProviderController::class, 'viewPayment'])->name('view.payment');

    Route::post('send_payment_as_email', [PaymentController::class, 'sendPaymentAsEmail'])->name('send.payment.email');



    Route::get('kid_attendance_record', [AdminController::class, 'kidAttendanceRecord'])->name('kid.attendance.record');

    Route::get('/settings', function () {
        $settings = AdminSetting::first();
        $user = User::find(Auth::id());
        $guide = '';
        if ($user && $user->hasRole('Parent')) {
            $guide = AdminSetting::first()->value('parent_guide') ?? '';
        }
        return view('settings', compact('settings', 'guide'));
    })->name('settings');

    Route::get('/attendance', [ProviderController::class, 'attendance'])->name('attendance');
    Route::get('/view-attendance/{id}', [ProviderController::class, 'viewAttendance'])->name('view.attendance');
    Route::get('/all-attendance', [ProviderController::class, 'allAttendance'])->name('all.attendance');

    Route::get('/kids', function () {
        return view('kids.index');
    })->name('kids');



    Route::get('/anaphylactic-emergency/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.anaphylactic-emergency', compact('kid'));
    })->name('anaphylactic-emergency');

    Route::get('/individual-action/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.individual-action', compact('kid'));
    })->name('individual-action');

    Route::get('/contract-infant/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.contract-infant', compact('kid'));
    })->name('contract-infant');

    Route::get('/contract-toddler/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.contract-toddler', compact('kid'));
    })->name('contract-toddler');

    Route::get('/parent-guide', function () {
        return view('newUI.parent-guide');
    })->name('parent-guide');

    Route::get('/child-enrolment-form/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.child-enrolment-form', compact('kid'));
    })->name('child-enrolment-form');

    Route::get('payments', [PaymentController::class, 'payments'])->name('payments');
    Route::get('pay_stubs', [PaymentController::class, 'payStubs'])->name('pay.stubs');

    Route::get('/invoices', [PaymentController::class, 'invoices'])->name('invoices');

    Route::get('/daily-updates', function (Request $request) {

        $search = $request->input('search_text');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $user = User::find(Auth::id());
        $baseQuery = DailyUpdates::query();

        if (isset($user) && $user->hasRole('Franchise')) {
            $baseQuery->where('provider_id', $user->provider->id);
        } elseif (isset($user) && $user->hasRole('Parent')) {
            $baseQuery->where('provider_id', $user->parent->provider->id);
        }

        if (isset($search) && !empty($search)) {
            $baseQuery->whereHas('provider', function ($kidQuery) use ($search) {
                $kidQuery->where('name', 'like', "%$search%");
            });
        }

        if (isset($startDate) && !empty($startDate)) {
            $baseQuery->whereDate('date', '>=', $startDate);
        }

        if (isset($endDate) && !empty($endDate)) {
            $baseQuery->whereDate('date', '<=', $endDate);
        }

        $updates = $baseQuery->with('media', 'provider')->latest()->paginate(10);

        return view('daily-updates', compact('updates'));
    })->name('daily-updates');

    Route::get('/single-update/{id}', function ($id) {
        $media = DailyUpdatesMedia::where('daily_updates_id', $id)->get();
        return view('single-update', compact('media'));
    })->name('single-update');


    // NEW UIII

    Route::get('/emergency/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.emergency', compact('kid'));
    })->name('emergency');


    Route::get('/drug/{kid}', function ($id) {
        $kid = Kid::Find($id);
        $eDrugs = '';
        if ($kid->drugInformation) {
            $eDrugs = $kid->drugInformation;
        }
        $drugs = Drug::where('status', 1)->get();
        return view('newUI.drug', compact('kid', 'drugs', 'eDrugs'));
    })->name('drug');

    Route::get('/outdoor-supervision/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.outdoor-supervision', compact('kid'));
    })->name('outdoor-supervision');

    Route::get('/photo-permission/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.photo-permission', compact('kid'));
    })->name('photo-permission');

    Route::get('/medication-consent/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.medication-consent', compact('kid'));
    })->name('medication-consent');

    Route::get('/release/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.release', compact('kid'));
    })->name('release');

    Route::get('/alternate-sleeping/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.alternate-sleeping', compact('kid'));
    })->name('alternate-sleeping');

    Route::get('/immunization/{kid}', function ($id) {
        $kid = Kid::Find($id);
        return view('newUI.immunization', compact('kid'));
    })->name('immunization');


    Route::post('update_survey_toogle', [SurveyController::class, 'updateSurveyToogle'])->name('survey.update.toogle');
    Route::get('survey', [SurveyController::class, 'index'])->name('survey.index');
    Route::get('parents/survey', [SurveyController::class, 'parentsSurveys'])->name('survey.parents');
    Route::get('provider/survey', [SurveyController::class, 'providerSurveys'])->name('survey.providers');
    Route::get('survey', [SurveyController::class, 'index'])->name('survey.index');


    Route::get('survey/parent', function () {
        return view('survey.parent');
    })->name('view.survey.parent');

    Route::get('survey/provider', function () {
        return view('survey.provider');
    })->name('view.survey.provider');

    Route::post('survey/parent', [SurveyController::class, 'addParentSurvey'])->name('add.parent.survey');
    Route::post('update/survey/parent/{id}', [SurveyController::class, 'updateParentSurvey'])->name('update.parent.survey');
    Route::post('survey/provider', [SurveyController::class, 'addProviderSurvey'])->name('add.provider.survey');
    Route::post('update/survey/provider/{id}', [SurveyController::class, 'updateProviderSurvey'])->name('update.provider.survey');
    Route::get('survey/view/{id}', [SurveyController::class, 'view_survey'])->name('view.survey');


    Route::get('/notification/{notification}', function (Notification $notification) {
        $notification->update(['read_at' => now()]);

        // if kid notification redirect conditionally
        if ($notification->type == 'new_kid_alert') {
            $authUser = User::find(Auth::id());
            $kidRoute = '';
            if ($authUser->hasRole('Admin')) {
                $kidRoute = 'admin.kids';
            } elseif ($authUser->hasRole('Franchise')) {
                $kidRoute = 'provider.kids';
            } else {
                $kidRoute = 'parent.kids';
            }
            return redirect()->route($kidRoute);
        }
        // if kid notification redirect conditionally
        return redirect($notification->url);
    })->name('notifications.read');
});

// Auth::routes();

Route::get('/delete-invoices', function () {
    $invoice =  Invoice::where('invoice_number','0124200003')->first();
    
    if($invoice)
    {
        InvoiceReceivedPayment::where('kid_id',$invoice->kid_id)->delete();
        $invoice->delete();
        return 'deleted';
    }
    // foreach ($invoice as $i) {
    // }
    return 'All invoices have been deleted.';
});

// Route::get('test', function (Request $request) {
//     // $months = ClosedMonth::all();
//     // foreach($months as $m)
//     // {
//     //     $m->delete();
//     // }

//     $record = new ClosedMonth();
//     $record->year = $request->year;
//     $record->month = $request->month;
//     $record->save();
//     return 'success';
// });


// Route::get('change_parent_code',function(Request $request){

//     $p = Parents::where('code',$request->code)->first();
//     if($p)
//     {
//         $p->code = $request->new_code;
//         $p->save();

//         return 'code changed';
//     }
//     return 'provider not found';

// });

Route::get('delete_parent',function(Request $request){
    $parent = Parents::where('code',$request->code)->first();
    if($parent)
    {
       $user = $parent->user_id;
       $parent->delete();
       User::where('id',$user)->delete();
       return 'deleted';
    }

    return 'parent not found';
});

Route::get('delete_user',function(Request $request){
    $parent = User::where('email',$request->code)->first();
    if($parent)
    {
       $parent->delete();
    }

    $user = Parents::where('email', $request->code)->first();

    if($user)
    {
       $user->delete();
    }

    return 'deleted';
    return 'parent not found';
});

Route::get('change_parent_code',function(){

    $parents = Parents::all();

    $code = 300000;

    foreach($parents as $p)
    {
        $p->code = $code++;
        $p->save();
    }

    return 'parent updated';
});

// Route::get('update_invoice',function()
// {
//    $invoices = Invoice::with('kid')->get();

//    foreach($invoices as $invoice)
//    {
//       $date = Carbon::parse($invoice->created_at);
//       $datePart = $date->format('my');
//       $number = $datePart . optional($invoice->kid)->code;
//       $invoice->invoice_number = $number;
//       $invoice->save();
//    }

//    return 'invoices updated';
// });

Route::get('update_pay_stub',function(){

    $payment = DayCarePayment::where('payment_number','0124100016')->first();
    $payment->balance = 0;
    $payment->previous_balance = 0;
    $payment->modified_description = null;
    $payment->modified_amount = 0;
    $payment->save();
    return 'updated';

});

// Route::get('test',function(){

//     $user = User::where('email','ainnazfar@gmail.com')->first();
//     if($user)
//     {
//         $user->assignRole('Franchise');
//     }
//     return 'assigned';
// });