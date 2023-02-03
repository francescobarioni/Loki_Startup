<?php

use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Why section
Route::get('/why', function () {
    return view('why/why');
})->name('why');

// Marketplace
Route::resource('marketplace', MarketplaceController::class);
Route::get('marketplace/payment', [\App\Http\Controllers\MarketplaceController::class, 'payment'])->name('marketplace/payment');
Route::post('marketplace/payment', [\App\Http\Controllers\MarketplaceController::class, 'payment'])->name('marketplace/payment');
Route::get('marketplace/payment-success', [\App\Http\Controllers\MarketplaceController::class, 'storePayment'])->name('marketplace/payment-success');
Route::post('marketplace/payment-success', [\App\Http\Controllers\MarketplaceController::class, 'storePayment'])->name('marketplace/payment-success');

// Subscription
Route::resource('subscription', SubscriptionController::class);
Route::get('subscription/payment', [\App\Http\Controllers\SubscriptionController::class, 'payment'])->name('subscription/payment');
Route::post('subscription/payment', [\App\Http\Controllers\SubscriptionController::class, 'payment'])->name('subscription/payment');

// Rating
Route::resource('rating', RatingController::class);

Route::get('/rating/delete/{id}', [\App\Http\Controllers\RatingController::class, 'destroy'])->name('rating.destroy');

/*Route::get('/login',function(){
    return view('login/login');
});*/

// XR & VR
Route::get('/xr_vr', function () {
    return view('xr_vr/xr_vr');
})->name('xr_vr');


// Pricing
Route::get('/subscriptions', function () {
    return view('subscriptions/subscriptions');
})->name('subscriptions');

// Rating
Route::get('/create-review', [\App\Http\Controllers\RatingController::class, 'store']);
Route::post('/create-review', [\App\Http\Controllers\RatingController::class, 'store']);

// Ajax new review
Route::get('/ajaxReview', function() {
    return view('marketplace/parts/_ajaxUserReview');
});

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

// Loki VR Plot
Route::get('/vr-plot', function () {
    return redirect('https://dev.reticulum.io/9KfNTZp?hub_invite_id=Nj8JXN2');
})->name('vr-plot')->middleware(['auth', 'can:vr_plot_access']);

// Send mail
Route::post('/sentmail',[\App\Http\Controllers\SendMailController::class,'sendmail'])->name('sendmail');


require __DIR__.'/auth.php';
