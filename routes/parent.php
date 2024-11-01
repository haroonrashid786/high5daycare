<?php

use App\Http\Controllers\ParentController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;





// **********  Parent Protected Routes  ********



Route::group(['middleware' => ['auth', 'role:Parent'], 'prefix' => 'parent'], function () {



   Route::get('/home', [ParentController::class, 'index'])->name('parent.home');

   Route::get('/kids', [ParentController::class, 'kids'])->name('parent.kids');

   Route::get('/provider_detail', [ParentController::class, 'providerDetails'])->name('parent.provider');
});


Route::group(['middleware' => ['auth']], function () {

   Route::get('parent-contract/{parent}', [ParentController::class, 'parentContract'])->name('parent.contract');
   Route::post('parent-contract/{parent}', [ParentController::class, 'updateParentContract'])->name('add.parent.contract');

   Route::get('/kids/documents/{id}', [ParentController::class, 'kidDocuments'])->name('kid.documents');

   Route::post('emergency/{kid}', [ParentController::class, 'addUpdateKidEmergency'])->name('add.kid.emergency');
   Route::post('supervision/{kid}', [ParentController::class, 'storeOrUpdateSupervision'])->name('add.kid.supervision');
   Route::post('release/{kid}', [ParentController::class, 'storeOrUpdateRelease'])->name('add.kid.release');
   Route::post('photo-permission/{kid}', [ParentController::class, 'storeOrUpdatePhotoPermission'])->name('add.kid.photo.permission');
   Route::post('alternate-sleeping/{kid}', [ParentController::class, 'storeOrUpdateAlternateSleeping'])->name('add.kid.alternate.sleeping');
   Route::post('drug/{kid}', [ParentController::class, 'storeOrUpdateKidDrug'])->name('add.kid.drugs');
   Route::post('medication-consent/{kid}', [ParentController::class, 'storeOrUpdateKidMedication'])->name('add.kid.medication');
   Route::post('anaphylactic-emergency/{kid}', [ParentController::class, 'storeOrUpdateAnaphylacticEmergency'])->name('add.kid.anaphylactic');
   Route::post('individual-action/{kid}', [ParentController::class, 'storeOrUpdateIndividualAction'])->name('add.kid.individual.action');
   Route::post('contract/{kid}', [ParentController::class, 'storeOrUpdateContract'])->name('add.kid.contract');
   Route::post('immunization/{kid}', [ParentController::class, 'storeOrUpdateImmunization'])->name('add.kid.immunization');
   Route::post('enrollement-form/{kid}', [ParentController::class, 'storeOrUpdateKidEnrollementForm'])->name('add.kid.enrollement.form');
});

        // **********  Parent Protected Routes  ********
