<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Users
Route::post('/registration', 'App\Http\Controllers\Auth\RegisterController@register');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@auth');
Route::post('/loginEmail', 'App\Http\Controllers\Auth\LoginController@loginEmail');
Route::post('/confirm', 'App\Http\Controllers\Auth\LoginController@confirm');
Route::patch('/user/{id}', 'App\Http\Controllers\UserController@update');



// Patient
Route::get('/patient/{id}', 'App\Http\Controllers\PatientController@index');
Route::get('/patients/', 'App\Http\Controllers\PatientController@list');
Route::put('/patient', 'App\Http\Controllers\PatientController@create');
Route::patch('/patient/{id}', 'App\Http\Controllers\PatientController@update');
Route::delete('/patient/{id}', 'App\Http\Controllers\PatientController@delete');

// Setting
Route::get('/setting', 'App\Http\Controllers\SettingController@index');
Route::put('/setting', 'App\Http\Controllers\SettingController@changePrice');

// Device
Route::get('/device/', 'App\Http\Controllers\DateRegisterController@list');
Route::get('/device/{device_id}', 'App\Http\Controllers\DateRegisterController@single');
Route::post('/device', 'App\Http\Controllers\DateRegisterController@create');

// Medical
Route::get('/medical/{patient_id}', 'App\Http\Controllers\MedicalController@index');
Route::put('/medical', 'App\Http\Controllers\MedicalController@create');
Route::delete('/medical/{id}', 'App\Http\Controllers\MedicalController@delete');

// Event
Route::get('/events/{patient_id}', 'App\Http\Controllers\EventsController@index');
Route::put('/events', 'App\Http\Controllers\EventsController@create');
Route::delete('/events/{id}', 'App\Http\Controllers\EventsController@delete');

// MedicalLog
Route::get('/medicallog/{patient_id}', 'App\Http\Controllers\MedicalLogController@index');
Route::put('/medicallog', 'App\Http\Controllers\MedicalLogController@create');
Route::delete('/medicallog/{id}', 'App\Http\Controllers\MedicalLogController@delete');


// Comments
Route::put('/comment', 'App\Http\Controllers\CommentsController@create');
Route::delete('/comment/{id}', 'App\Http\Controllers\CommentsController@delete');


// Indicator
Route::get('/indicator/{patient_id}', 'App\Http\Controllers\IndicatorController@index');
Route::put('/indicator', 'App\Http\Controllers\IndicatorController@create');

// Accelerometer
Route::get('/accelerometer/{patient_id}', 'App\Http\Controllers\AccelerometerController@index');
Route::put('/accelerometer/{patient_id}', 'App\Http\Controllers\AccelerometerController@create');


// Calibration
Route::get('/calibration/{patient_id}', 'App\Http\Controllers\CalibrationController@index');
Route::put('/calibration', 'App\Http\Controllers\CalibrationController@create');

// Alarm
Route::get('/alarm/{id}', 'App\Http\Controllers\AlarmController@index');
Route::put('/alarm', 'App\Http\Controllers\AlarmController@create');
Route::patch('/alarm/{id}', 'App\Http\Controllers\AlarmController@update');
Route::delete('/alarm/{id}', 'App\Http\Controllers\AlarmController@delete');