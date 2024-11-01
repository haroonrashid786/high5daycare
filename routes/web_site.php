<?php

use App\Http\Controllers\ParentController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;








Route::get('/',[WebsiteController::class, 'index'])->name('website');
Route::get('about',[WebsiteController::class, 'aboutPage'])->name('about');
Route::get('parents',[WebsiteController::class, 'parentsPage'])->name('parents');
Route::get('providers',[WebsiteController::class, 'providersPage'])->name('providers');
Route::get('blogs',[WebsiteController::class, 'blogsPage'])->name('blogs');
Route::get('single-blog/{slug}',[WebsiteController::class, 'blogSingle'])->name('sigle.blog');
Route::post('form-submit',[WebsiteController::class, 'contactForm'])->name('form.submit');




















?>