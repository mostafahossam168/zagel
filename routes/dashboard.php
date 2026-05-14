<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\FaqController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\PartnerController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\ProjectSubmissionController;
use App\Http\Controllers\Dashboard\ProviderListingController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\TestimonialController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;




Route::middleware('guest_admin')->group(function () {
    Route::view('login', 'dashboard.login')->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login-request');
});
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::group(['middleware' => 'check_admin'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::group(['controller' => SettingController::class], function () {
        Route::get('settings', 'index')->name('settings');
        Route::post('update-settings', 'update')->name('update-settings');
    });

    Route::resource('roles', RoleController::class);

    Route::resource('admins', AdminController::class);
    Route::get('admins-export', [AdminController::class, 'export'])->name('admins.export');
    Route::post('admins/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admins.toggle-status');

    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);

    Route::resource('categories', CategoryController::class);

    Route::resource('partners', PartnerController::class);

    Route::resource('users', UserController::class);
    Route::post('users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    Route::resource('faqs', FaqController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::get('pages/about-us', [PageController::class, 'aboutUs'])->name('pages.about-us');
    Route::put('pages/about-us', [PageController::class, 'updateAboutUs'])->name('pages.about-us.update');
    Route::post('pages/upload-image', [PageController::class, 'uploadImage'])->name('pages.upload-image');

    Route::resource('services', ServiceController::class);

    Route::resource('testimonials', TestimonialController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('project-submissions', ProjectSubmissionController::class)->only(['index', 'show', 'destroy']);
    Route::post('project-submissions/{id}/update-status', [ProjectSubmissionController::class, 'updateStatus'])->name('project-submissions.update-status');

    Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.mark-all-read');
    Route::get('notifications/inbox', [NotificationController::class, 'inbox'])->name('notifications.inbox');
    Route::resource('notifications', NotificationController::class)->only(['index', 'create', 'store', 'destroy']);

    Route::resource('provider-listings', ProviderListingController::class)->only(['index', 'show', 'destroy']);
    Route::post('provider-listings/{id}/update-status', [ProviderListingController::class, 'updateStatus'])->name('provider-listings.update-status');
});
