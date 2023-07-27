<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
Route::middleware("auth")->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/changePassword','App\Http\Controllers\HomeController@showChangePasswordForm');
    Route::post('/changePassword','App\Http\Controllers\HomeController@changePassword')->name('changePassword');

    Route::resource("patients","\App\Http\Controllers\PatientsController");
    Route::resource("patientVisits","\App\Http\Controllers\PatientVisitsController");
    Route::prefix("patients/DialysisDocumentation/{patient_id}")->group(
        function(){
            Route::get("/", "\App\Http\Controllers\DialysisDocumentationController@show");
            Route::post("/", "\App\Http\Controllers\DialysisDocumentationController@store");
        }
    );
    Route::get("patientVisits/{id}/invoice","\App\Http\Controllers\PatientVisitsController@invoice");
    Route::get("quaterly_report","\App\Http\Controllers\ReportController@quaterly");
    Route::post("quaterly_report","\App\Http\Controllers\ReportController@quaterly");

    Route::get("generate_report","\App\Http\Controllers\ReportController@generate");
    Route::post("generate_report","\App\Http\Controllers\ReportController@generate");

    Route::get("quaterly_each/{id}","\App\Http\Controllers\ReportController@quaterly_each");
    Route::post("update_quaterly_report","\App\Http\Controllers\ReportController@update_quaterly_report");
    
    

    Route::resource("employees","\App\Http\Controllers\EmployeeController");
    
});
