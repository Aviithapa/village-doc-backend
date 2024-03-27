<?php

use App\Http\Controllers\Address\AddressController;
use App\Http\Controllers\Alcohol\AlcoholController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Allergies\AllergiesController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BMI\BmiController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Complaint\ComplaintController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Department\DepartmentTestController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\DoctorScheduleController;
use App\Http\Controllers\FollowUp\FollowUpController;
use App\Http\Controllers\LabResult\LabController;
use App\Http\Controllers\MedicalRecord\MedicalRecordComplaintController;
use App\Http\Controllers\MedicalRecord\MedicalRecordController;
use App\Http\Controllers\MedicalRecord\PastMedicalHistoryController;
use App\Http\Controllers\Medication\MedicationController;
use App\Http\Controllers\PackYear\PackYearController;
use App\Http\Controllers\Patients\InformantController;
use App\Http\Controllers\Patients\PatientsController;
use App\Http\Controllers\Roles\RolesController;
use App\Http\Controllers\Vital\VitalController;
use App\Models\Appointment;
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
Route::post('/refresh-token', [AuthController::class, 'refresh'])->middleware(['auth:api'])->name('refresh');


Route::apiResource('/patients', PatientsController::class);
Route::apiResource('/vital', VitalController::class)->middleware(['auth:api']);
Route::post('/medical-record/new', [MedicalRecordController::class, 'newmedicalRecordStore'])->middleware(['auth:api']);
Route::apiResource('/medical-record', MedicalRecordController::class)->middleware(['auth:api']);
Route::apiResource('/doctor', DoctorController::class)->middleware(['auth:api']);
Route::apiResource('/schedule', DoctorScheduleController::class)->middleware(['auth:api']);
Route::apiResource('/appointment', AppointmentController::class)->middleware(['auth:api']);
Route::apiResource('/allergies', AllergiesController::class)->middleware(['auth:api']);

Route::get('/doctors/list', [DoctorController::class, 'doctorList'])->middleware(['auth:api'])->name('doctor.list');
Route::get('/doctors/all', [DoctorController::class, 'all'])->middleware(['auth:api'])->name('doctor.all');


Route::get('/patient/select', [PatientsController::class, 'select'])->middleware(['auth:api'])->name('patient.select');
Route::get('/patient/vitals/{id}', [PatientsController::class, 'patientVital'])->middleware(['auth:api'])->name('patient.vital');
Route::get('/patient/QRScan/{uuid}', [PatientsController::class, 'qrScan'])->name('patient.qrScan');
Route::get('/patient/QRGenerate/{uuid}', [PatientsController::class, 'generateQR'])->name('patient.qr.generate');
Route::post('/lab-result/store', [LabController::class, 'store'])->middleware(['auth:api'])->name('labResult.store');

Route::post('/medication/bulk/store', [MedicationController::class, 'medicationBulkUpload'])->middleware(['auth:api'])->name('medication.bulk.upload');
Route::post('/medication/store', [MedicationController::class, 'store'])->middleware(['auth:api'])->name('medication.store');

Route::apiResource('/department', DepartmentController::class)->middleware(['auth:api']);
Route::apiResource('/departmentTest', DepartmentTestController::class)->middleware(['auth:api']);
Route::apiResource('/complaint', ComplaintController::class)->middleware(['auth:api']);
Route::apiResource('/medical-record-complaint', MedicalRecordComplaintController::class)->middleware(['auth:api']);
Route::apiResource('/category', CategoryController::class)->middleware(['auth:api']);
Route::apiResource('/past-medical-history', PastMedicalHistoryController::class)->middleware(['auth:api']);
Route::apiResource('/informant', InformantController::class)->middleware(['auth:api']);
Route::apiResource('/user', UserController::class)->middleware(['auth:api']);
Route::apiResource('/role', RolesController::class)->middleware(['auth:api']);


Route::get('/family-head/{household_no}', [PatientsController::class, 'showFamilyHead'])->name('patient.family-head');
Route::get('/address', [AddressController::class, 'index'])->name('address.index');

Route::get('patients/familyDetails/{id}', [PatientsController::class, 'getFamilyDetail'])->name('patient.familyhead.detail');
Route::get('patient/validatePatient', [PatientsController::class, 'validatePatient'])->name('patient.validate');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth:api']);

Route::get('/getAppointmentUniqueUser', [AppointmentController::class, 'getAppointmentUniqueUser'])->middleware(['auth:api']);

Route::put('/updateBulkAppointment', [AppointmentController::class, 'updateBulkAppointment'])->middleware(['auth:api']);

Route::apiResource('/alcohol', AlcoholController::class)->middleware(['auth:api']);
Route::apiResource('/pack-year', PackYearController::class)->middleware(['auth:api']);
Route::apiResource('/bmi', BmiController::class)->middleware(['auth:api']);
Route::apiResource('/followup', FollowUpController::class)->middleware(['auth:api']);
