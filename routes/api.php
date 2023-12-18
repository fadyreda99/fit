<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\AddCustomerController;
use App\Http\Controllers\Customer\AllCustomersController;
use App\Http\Controllers\Customer\CalculateNutritionalInfoController;
use App\Http\Controllers\Customer\DeleteCustomerController;
use App\Http\Controllers\Customer\GetCustomerController;
use App\Http\Controllers\Customer\ProgresInfoController;
use App\Http\Controllers\Customer\ProgressImagesController;
use App\Http\Controllers\Customer\UpdateStatusCustomerController;
use App\Http\Controllers\FollowUps\AddFollowUpController;
use App\Http\Controllers\FollowUps\DeleteFollowUpController;
use App\Http\Controllers\FollowUps\GetAllFollowUpsController;
use App\Http\Controllers\FollowUps\GetToDayFollowUpsController;
use App\Http\Controllers\FollowUps\UpdateFollowUpStatusController;
use App\Http\Controllers\Membership\AddMembershipController;
use App\Http\Controllers\Membership\UpdateMembershipController;
use App\Http\Controllers\Note\AddCustomerNoteController;
use App\Http\Controllers\Note\DeleteCustomerNoteController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('register', [AuthController::class, 'register']);

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});


Route::group([

    'middleware' => 'api',
    'prefix' => 'customer'

], function () {
    Route::post('add-new', [AddCustomerController::class, 'addNew']);
    Route::get('delete/{user_id}', [DeleteCustomerController::class, 'delete']);
    Route::get('all', [AllCustomersController::class, 'all']);
    Route::get('get/{user_id}', [GetCustomerController::class, 'get']);
    Route::post('update-status', [UpdateStatusCustomerController::class, 'updateStatus']);
    Route::post('calculate-nutrition', [CalculateNutritionalInfoController::class, 'calculate']);
    Route::post('add-progressing', [ProgresInfoController::class, 'progressInfo']);
    Route::post('add-images', [ProgressImagesController::class, 'addImages']);
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'membership'

], function () {
    Route::post('add', [AddMembershipController::class, 'add']);
    Route::post('update', [UpdateMembershipController::class, 'update']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'note'
], function () {
    Route::post('add', [AddCustomerNoteController::class, 'addNote']);
    Route::post('delete', [DeleteCustomerNoteController::class, 'delete']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'follow-ups'
], function () {
    Route::post('add', [AddFollowUpController::class, 'add']);
    Route::post('update-status', [UpdateFollowUpStatusController::class, 'updateStatus']);
    Route::post('delete', [DeleteFollowUpController::class, 'delete']);
    Route::get('today-followup', [GetToDayFollowUpsController::class, 'getToDayFollowUps']);
    Route::get('all-followup', [GetAllFollowUpsController::class, 'all']);
});
