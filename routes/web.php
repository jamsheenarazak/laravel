<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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


Auth::routes();
    Route::get('/', function () {
    return view('clinic_welcome');
});

Route::group(['middleware' => ['auth','Admin']], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });


});
Route::get('/token',function (Request $request){
    $token=$request->session()->token();
    $token=csrf_token();

});
Route::get('new',function(){
    return view('new');

});




Route::get('update/cancel', [App\Http\Controllers\HomeController::class, 'updateCancel'])->name('update-cancel');


Route::resource('doctor',\App\Http\Controllers\DoctorController::class)->name('*','doctor')->middleware('isAdmin');
Route::get('/home', [App\Http\Controllers\DoctorController::class, 'home'])->name('home');

Route::get('department/add',[\App\Http\Controllers\DoctorController::class,'add_department'])->name('add_department')->middleware('isAdmin');
//Route::get('/',[\App\Http\Controllers\DoctorController::class,'index'])->name('index');
Route::post('department/store',[\App\Http\Controllers\DoctorController::class,'store_department'])->name('store_department')->middleware('isAdmin');
Route::get('department/show',[\App\Http\Controllers\DoctorController::class,'show_department'])->name('show_department')->middleware('isAdmin');
Route::get('department/edit/{department_id}',[\App\Http\Controllers\DoctorController::class,'edit_department'])->name('edit_department')->middleware('isAdmin');
Route::post('department/update',[\App\Http\Controllers\DoctorController::class,'update_department'])->name('update_department')->middleware('isAdmin');
Route::get('department/delete/{department_id}',[\App\Http\Controllers\DoctorController::class,'delete_department'])->name('delete_department')->middleware('isAdmin');
Route::post('store_doctors',[\App\Http\Controllers\DoctorController::class,'store_doctors'])->name('store_doctors')->middleware('isAdmin');
Route::get('consultation/add',[\App\Http\Controllers\DoctorController::class,'add_consultation'])->name('add_consultation')->middleware('isAdmin');
Route::post('consultation/store',[\App\Http\Controllers\DoctorController::class,'storeConsultation'])->name('store-consultation')->middleware('isAdmin');
Route::get('consultation/show',[\App\Http\Controllers\DoctorController::class,'show_consultation'])->name('show_consultation')->middleware('isAdmin');
Route::get('doctor/slot/{doctor_id}',[\App\Http\Controllers\DoctorController::class,'time_slot'])->name('time_slot')->middleware('isAdmin');
Route::post('consultation/details',[\App\Http\Controllers\DoctorController::class,'details_consultation'])->name('details_consultation');
Route::post('consultation/delete',[\App\Http\Controllers\DoctorController::class,'consultation_delete'])->name('consultation_delete');
Route::post('date/slot',[\App\Http\Controllers\DoctorController::class,'date_slot'])->name('date_slot');


Route::get('clinic_welcome',[\App\Http\Controllers\HomeController::class,'index'])->name('clinic');
Route::get('clinic_welcome/doctors',[\App\Http\Controllers\HomeController::class,'display_doctors'])->name('display_doctors');
Route::get('clinic_welcome/department',[\App\Http\Controllers\HomeController::class,'display_department'])->name('display_department');
Route::get('appointment',[\App\Http\Controllers\HomeController::class,'make_appointment'])->name('make_appointment');
Route::post('appointment/make',[\App\Http\Controllers\HomeController::class,'doctor_list'])->name('doctor_list');
Route::post('appointment/slot',[\App\Http\Controllers\HomeController::class,'slot'])->name('slot');
Route::post('appointment/book_slot',[\App\Http\Controllers\HomeController::class,'book_slot'])->name('book_slot');
Route::post('patient/history',[\App\Http\Controllers\HomeController::class,'patient_history'])->name('patient_history');
Route::post('appointment/cancel',[\App\Http\Controllers\HomeController::class,'appointment_cancel'])->name('appointment_cancel');
Route::post('department/doctor',[\App\Http\Controllers\HomeController::class,'departmentDoctor'])->name('department-doctor');
Route::post('appointment/delete',[\App\Http\Controllers\HomeController::class,'deleteAppointment'])->name('appointment-delete');


Route::get('excel-csv-file',[\App\Http\Controllers\ExcelCSVController::class, 'index'])->name('ExcelCSV')->middleware('isAdmin');;
//Route::post('import-excel-csv-file',[\App\Http\Controllers\ExcelCSVController::class,'importExcelCSV']);
Route::get('export-excel-csv-file',[\App\Http\Controllers\ExcelCSVController::class, 'export'])->name('export');
Route::get('export-excel-csv-file/{doctorId}',[\App\Http\Controllers\ExcelCSVController::class, 'exportTimeslot'])->name('export-timeslot');

//end
