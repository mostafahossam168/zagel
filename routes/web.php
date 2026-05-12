<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProjectSubmissionController;
use App\Http\Controllers\Frontend\ProviderListingController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Models\Faq;
use App\Models\Partner;
use App\Models\ProviderListing;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', fn() => view('front.about'))->name('about');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/faqs', function () {
    $faqs = Faq::where('status', 'active')->get();
    return view('front.faqs', compact('faqs'));
})->name('faqs');

Route::get('/testimonials', function () {
    $testimonials = Testimonial::where('status', 'active')->get();
    return view('front.testimonials', compact('testimonials'));
})->name('testimonials');

Route::get('/testimonials/submit', fn() => view('front.testimonial-submit'))->name('testimonials.submit');

Route::post('/testimonials/submit', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'name'     => 'required|string|max:255',
        'position' => 'nullable|string|max:255',
        'company'  => 'nullable|string|max:255',
        'content'  => 'required|string|min:10|max:1000',
        'rating'   => 'required|integer|min:1|max:5',
        'image'    => 'nullable|image|max:2048',
    ]);

    $image = null;
    if ($request->hasFile('image')) {
        $image = store_file($request->file('image'), 'testimonials');
    }

    \App\Models\Testimonial::create([
        'name'     => $request->name,
        'position' => $request->position,
        'company'  => $request->company,
        'content'  => $request->content,
        'rating'   => $request->rating,
        'image'    => $image,
        'status'   => 'inactive',
    ]);

    return redirect()->route('testimonials.submit')
        ->with('success', 'شكراً لمشاركتنا رأيك! ستظهر شهادتك على الموقع بعد المراجعة.');
})->name('testimonials.submit.store');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/add-project', [ProjectSubmissionController::class, 'create'])->name('project.create');
Route::post('/add-project', [ProjectSubmissionController::class, 'store'])->name('project.store');

// ---- Guest-only auth routes ----
Route::middleware('guest_user')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('user.login');
    Route::post('/login',   [AuthController::class, 'login'])->name('user.login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('user.register');
    Route::post('/register',[AuthController::class, 'register'])->name('user.register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');

// ---- Authenticated user routes ----
Route::middleware('check_user')->group(function () {
    Route::get('/profile',          [UserProfileController::class, 'index'])->name('user.profile');
    Route::put('/profile',          [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/my-services',                  [ProviderListingController::class, 'index'])->name('user.listings.index');
    Route::get('/my-services/add',              [ProviderListingController::class, 'create'])->name('user.listings.create');
    Route::post('/my-services',                 [ProviderListingController::class, 'store'])->name('user.listings.store');
    Route::get('/my-services/{listing}/edit',   [ProviderListingController::class, 'edit'])->name('user.listings.edit');
    Route::put('/my-services/{listing}',        [ProviderListingController::class, 'update'])->name('user.listings.update');
    Route::delete('/my-services/{listing}',     [ProviderListingController::class, 'destroy'])->name('user.listings.destroy');
});

// ---- User notifications ----
Route::middleware('check_user')->group(function () {
    Route::get('/my-notifications', function () {
        $notifications = auth()->user()->notifications()->latest()->paginate(20);
        auth()->user()->unreadNotifications->markAsRead();
        return view('front.user.notifications', compact('notifications'));
    })->name('user.notifications.index');

    Route::post('/notifications/mark-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('user.notifications.mark-read');
});

// ---- Provider listings public page ----
Route::get('/providers', function () {
    $listings = ProviderListing::approved()->with(['user', 'category'])->latest()->get();
    return view('front.providers', compact('listings'));
})->name('providers.index');
