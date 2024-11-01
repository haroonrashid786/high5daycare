<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;




  // **********  Franchise Protected Routes  ********

  Route::group(['middleware' => ['auth', 'role:Franchise'], 'prefix' => 'provider'], function() {







    Route::get('/home', [ProviderController::class, 'index'])->name('provider.home');
    Route::get('/parents', [ProviderController::class, 'parents'])->name('provider.parents');
    Route::get('/kids', [ProviderController::class, 'kids'])->name('provider.kids');

    Route::post('/attendance',[ProviderController::class, 'addAttendance'])->name('provider.add.attendance');
    Route::post('/daily_update',[ProviderController::class, 'addDailyUpdates'])->name('provider.add.updates');
    Route::post('/delete-daily-update/{id}',[ProviderController::class, 'deleteDailyUpdate'])->name('provider.delete.update');

    Route::post('/activity-sheets',[ProviderController::class, 'addActivitySheet'])->name('provider.add.activity');
    Route::post('/update-activity/{id}',[ProviderController::class, 'updateActivitySheet'])->name('provider.update.activity');

    Route::post('/delete-activity-sheet/{id}',[ProviderController::class, 'deleteActivitySheet'])->name('provider.delete.activity');

    Route::post('add-meal',[ProviderController::class, 'addMeal'])->name('meal.add');
    Route::post('update-meal/{id}',[ProviderController::class, 'updateMeal'])->name('meal.update');
    Route::post('delete-meal/{id}',[ProviderController::class, 'deleteMeal'])->name('meal.delete');

    Route::post('apply-vacation',[ProviderController::class, 'applyVacation'])->name('apply.vacation');

    Route::post('about-me',[ProviderController::class, 'saveOrUpdateAboutMe'])->name('provider.aboutMe.add');









 });


  Route::group(['middleware' => ['auth']], function() {

    Route::get('about-me/{providerId?}',[ProviderController::class, 'aboutMe'])->name('provider.aboutMe');

    Route::get('view-meal/{id}',[ProviderController::class, 'viewMeal'])->name('meal.view');
    Route::get('/activity/{id}', [ProviderController::class, 'showActivity'])->name('activity-sheet.show');
    Route::get('/incidents', [ProviderController::class, 'incidents'])->name('incidents');
    Route::get('/add-incident', [ProviderController::class, 'addIncident'])->name('add.incident.show');
    Route::post('/add-incident/{reportId?}', [ProviderController::class, 'addOrUpdateincident'])->name('add.update.incident');
    Route::get('/view-incident/{id}', [ProviderController::class, 'viewIncident'])->name('view.incident');

    Route::get('/provider-guide/{provider}',[ProviderController::class, 'providerContract'])->name('provider-guide');
    Route::post('/provider-guide/{provider}',[ProviderController::class, 'updateProviderContract'])->name('add.provider.guide');
  });
     // **********  Franchise Protected Routes  ********










