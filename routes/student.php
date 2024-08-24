<?php
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Students\dashboard\ExamsController;
use App\Http\Controllers\Students\dashboard\ProfileController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ], function () {

    //==============================dashboard============================
    Route::get('/student/dashboard', function () {
        return view('pages.Students.dashboard');
    })->name('dashboard.Students');

   // ==============================Student Exams========================

   Route::group(['namespace'=>'Students\dashboard'],function(){
    Route::resource('student_exams', ExamsController::class);
    Route::resource('profile-student', ProfileController::class);

});



});






















// Route::group(
//     [
//         'prefix' => LaravelLocalization::setLocale(),
//         'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
//     ], function () {

//     //==============================dashboard============================
//     Route::get('/student/dashboard', function () {
//         return view('pages.Students.dashboard');
//     });

//     Route::group(['namespace'=>'Students\dashboard'],function(){
//         Route::resource('student_exams', ExamsController::class);

//     });


// });






