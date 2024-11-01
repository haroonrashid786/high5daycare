<?php

use App\Helper\GlobalHelper;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NapController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProviderController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('delete-certificate/{certificateId}', [AdminController::class, 'destroyKidSubsidizedCertificate'])->name('delete.certificate');
Route::post('mark-attendance',[ProviderController::class,'markAttendance'])->name('mark-attendance');
Route::post('mark-pickup-time',[ProviderController::class,'updatePickupTime'])->name('mark-pickup-time');
Route::post('mark-timing',[NapController::class,'markTiming'])->name('mark-timing');
Route::post('add-note',[NapController::class,'addNote'])->name('add-note');
Route::post('/update-kid-status' , [ProviderController::class, 'updateKidStatus']);

Route::post('/update-unread-count', function(Request $request)
{
        $user = User::find($request->user_id);
        $user->update(['unread_count' => 0]);
        return response()->json(['success' => true]);
});

Route::post('/save-note', [AdminController::class, 'saveStickyNote'])->name('save.sticky.note');
Route::get('/get-previous-notes', [AdminController::class, 'getPreviousNotes'])->name('get.previous.notes');
Route::delete('/delete-note/{id}', [AdminController::class, 'deleteStickyNote'])->name('delete.sticky.note');
Route::put('/update-note/{id}', [AdminController::class, 'updateStickyNote'])->name('update.sticky.note');



Route::post('/invoice/add-fund/{invoiceNumber}', [PaymentController::class, 'addMinistryFund'])->name('api.add-ministry-fund');
Route::post('/update-invoice/{invoiceNumber}', [PaymentController::class, 'updateInvoice'])->name('api.update-invoice');

Route::post('/update-payment/{paymentNumber}', [PaymentController::class, 'updatePayment'])->name('api.update-payment');
Route::post('/payment/add-fund/{paymentNumber}', [PaymentController::class, 'addMinistryFundInPayment'])->name('api.add-paymnet-fund');


















Route::post('upload-file',function(Request $request){

      $files = $request->file('files');
    $destinationDirectory = 'documents';

    $uploadedUrls = GlobalHelper::uploadAndSaveFile($files, $destinationDirectory); // also can add file name optionally
    // Save the file URLs to the database
    // foreach ($uploadedUrls as $url) {
    //     $file = new File();
    //     $file->name = pathinfo($url, PATHINFO_FILENAME); // Store the file name
    //     $file->url = $url; // Store the file URL
    //     $file->save();
    // }

    return [
     'paths' => $uploadedUrls
    ];

    // in blade
    // url($file->path);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
