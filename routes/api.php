<?php

use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\MedicalRecord\MedicalRecordController;
use App\Http\Controllers\Patients\PatientsController;
use App\Http\Controllers\Vital\VitalController;
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

Route::match(['post', 'get'], '/login', [AuthController::class, 'login'])->name('login');
Route::match(['post', 'get'], '/logout', [AuthController::class, 'logout'])->middleware(['auth:api'])->name('logout');
Route::get('/me', [AuthController::class, 'me'])->middleware(['auth:api'])->name('me');
Route::get('/refresh-token', [AuthController::class, 'refresh'])->middleware(['auth:api'])->name('refresh');


Route::apiResource('/patients', PatientsController::class)->middleware(['auth:api']);
Route::apiResource('/vital', VitalController::class)->middleware(['auth:api']);
Route::apiResource('/medical-record', MedicalRecordController::class)->middleware(['auth:api']);
Route::apiResource('/doctor', DoctorController::class)->middleware(['auth:api']);
Route::apiResource('/appointment', AppointmentController::class)->middleware(['auth:api']);
Route::get('/patient/select', [PatientsController::class, 'select'])->middleware(['auth:api'])->name('patient.select');
Route::get('/patient/vitals/{id}', [PatientsController::class, 'patientVital'])->middleware(['auth:api'])->name('patient.vital');
