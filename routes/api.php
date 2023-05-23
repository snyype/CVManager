<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use App\Models\Cv;
use App\Http\Controllers\CVController;
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

/**
 * @OA\Info(
 *     title="API Title",
 *     version="1.0.0",
 *     description="API description"
 * )
 */




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // Your protected API routes here
    Route::get('test', [CVController::class, 'test']);
});


Route::get('cvlists', [CVController::class, 'apiCvLists']);
Route::get('intlists', [CVController::class, 'apiIntLists']);
Route::get('cvlists/{id}', [CVController::class, 'apiIndCvLists']);

Route::post('search', [CVController::class, 'apiSearchQuery']);
Route::get('v1/endpoints', [CVController::class, 'apiv1Endpoints']);
Route::post('addInterviewer', [CVController::class, 'apiAddInterviewer']);

Route::post('login', [CVController::class, 'login']);
Route::post('signup', [CVController::class, 'sign_up']);
Route::get('users', [CVController::class, 'apiUserLists']);
Route::post('store/cv', [CVController::class, 'apiStoreCv']); 
Route::post('update/cv/{id}', [CVController::class, 'apiUpdateCv']); 
Route::post('delete/cv/{id}', [CVController::class, 'apiDeleteCv']); 
Route::post('change/status/{id}', [CVController::class, 'apiStatusChange']); 
Route::post('assign/task/{id}', [CVController::class, 'apiAssignTask']); 
Route::get('cv/hired', [CVController::class, 'apiHiredCVLists']); 




