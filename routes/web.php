<?php

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
Route::get('/token',function (Request $request){
    $token=$request->session()->token();
    $token=csrf_token();

});
Route::resource('teacher',\App\Http\Controllers\TeacherController::class)->name('*','teacher');
