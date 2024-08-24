<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Teacher;
use App\Models\Student;
use App\Http\Controllers\Teachers\dashboard\StudentController;
use App\Http\Controllers\Teachers\dashboard\ExameController;
use App\Http\Controllers\Teachers\dashboard\QuestioneController;
use App\Http\Controllers\Teachers\dashboard\OflineZoomClassesController;
use App\Http\Controllers\Teachers\dashboard\ProfileController;

/*
|--------------------------------------------------------------------------
| teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {
        $ids = Teacher::findorfail(auth()->user()->id)->sections()->pluck('section_id');
        $data['count_sections']=$ids->count();
        $data['count_students']= Student::whereIn('section_id',$ids)->count();
        return view('pages.Teachers.dashboard.dashboard',$data);
    });

    Route::group(['namespace' => 'Teachers\dashboard'], function () {
        //==============================students============================
    // Route::get('Students',[StudentController::class,'index'])->name('Students.index');
     Route::get('sections',[StudentController::class,'sections'])->name('sections');
     Route::post('attendance',[StudentController::class,'attendance'])->name('attendance');
     Route::get('attendance_report',[StudentController::class,'attendanceReport'])->name('attendance.report');
     Route::post('attendance_report',[StudentController::class,'attendanceSearch'])->name('attendance.search');
     Route::resource('Exams', ExameController::class);
    Route::get('/Get_classroom/{id}', [ExameController::class, 'Get_classroom']);
     Route::get('/Get_Section/{id}', [ExameController::class, 'Get_Section']);
     Route::resource('Questions', QuestioneController::class);
     Route::resource('online_zoom_classes', OflineZoomClassesController::class);
     Route::get('profile',[ProfileController::class,'index'])->name('profile.show');
     Route::post('profile/{id}',[ProfileController::class,'update'])->name('profile.update');
     Route::get('student_quizze/{id}',[ExameController::class,'student_quizze'])->name('student.quizze');
     Route::post('repeat_quizze',[ExameController::class,'repeat_quizze'])->name('repeat.quizze');


    });

});
