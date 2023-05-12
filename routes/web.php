<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\CVController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/formsubmit', [CVController::class, 'store'])->name('cv.store');
});


//Admin Protected Routes

Route::group(['prefix'=>'admin','middleware'=>['admin','verified']],function (){
    Route::get('/view/{id}', [CVController::class, 'indcv'])->name('cv.indcv');
    Route::get('/cvlists',[CVController::class, 'cvlists'])->name('cv.lists');
    Route::get('/hired',[CVController::class, 'Hiredcvlists'])->name('hiredcv.lists');
    Route::get('/intlists',[CVController::class, 'intlists'])->name('int.intlists');
    Route::get('/addint',[CVController::class, 'addintview'])->name('view.addint');
    Route::get('/cv/change/status/{id}',[CVController::class, 'cvstatuschangeview'])->name('cv.statuschangeview');
    Route::post('/changestatus/{id}',[CVController::class, 'changestatus'])->name('cv.changestatus');
    Route::post('/addinterviewer',[CVController::class, 'addInterviewer'])->name('add.interviewer');



    //HR Protected Routes
  

});






Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notification');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verification');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent to your email!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');



Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');



Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');




Route::get('/auth/google', [AuthenticatedSessionController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthenticatedSessionController::class, 'handleGoogleCallback'])->name('auth.google.callback');





require __DIR__.'/auth.php';
