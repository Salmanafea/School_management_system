<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\livewire\AddParent;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Students\FeesInvoicesController;
use App\Http\Controllers\Students\ReceiptStudentsController;
use App\Http\Controllers\Students\ProcessingFeeController;
use App\Http\Controllers\Students\PaymentController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\Quizzes\QuizzController;
use App\Http\Controllers\Questions\QuestionController;
use App\Http\Controllers\Students\OnlineClasseController;
use App\Http\Controllers\Students\LibraryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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


// Auth::routes();
// Route::group(['middleware'=>['guest']],function(){
//     Route::get('/', function () {
//         return view('auth.login');
//     });



// });




Route::get('/', [HomeController::class, 'index'])->name('selection');

Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}', [LoginController::class, 'loginForm'])->middleware('guest')->name('login.show');

    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/logout/{type}',[LoginController::class,'logout'])->name('logout');
});

// \Livewire\Livewire::setUpdateRoute(function ($handle) {
//     return Route::post('/livewire/update', $handle);
// });


Route::group(['prefix'=>LaravelLocalization::setLocale()],function(){
    \Livewire\Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });


});



 //==============================Translate all pages============================

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){


Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


Route::group(['namespace'=>'Grades'],function(){
    Route::resource('Grades', GradeController::class);
});
    //==============================Classrooms============================

Route::group(['namespace'=>'Classrooms'],function(){
    Route::resource('Classrooms', ClassroomController::class);


    Route::post('delete_all', [ClassroomController::class,'delete_all'])->name('delete_all');

    Route::post('Filter_Classes', [ClassroomController::class,'Filter_Classes'])->name('Filter_Classes');



    });

    //==============================Sections============================

    Route::group(['namespace'=>'Sections'],function(){

       Route::resource('Sections', SectionController::class);
       Route::get('/classes/{id}',[ SectionController::class,'getclasses']);




    });




    Route::view('add_parent', 'livewire.Show_Form')->name('add_parent');

    Route::group(['namespace' => 'Teachers'], function () {
        Route::resource('Teachers', 'TeacherController');
    });


Route::group(['namespace' => 'Students'], function () {
    Route::resource('Students', StudentController::class);
    Route::resource('Promotion',PromotionController::class);
    Route::resource('Graduated', GraduatedController::class);
    Route::resource('Fees', FeesController::class);
    Route::get('download_file/{filename}',[LibraryController::class,'downloadAttachment'])->name('downloadAttachment');
    Route::resource('library', LibraryController::class);
    Route::resource('online_classes', OnlineClasseController::class);
    Route::resource('Fees_Invoices', FeesInvoicesController::class);
    Route::resource('receipt_students',ReceiptStudentsController::class);
    Route::resource('Attendance', AttendanceController::class);
    Route::resource('ProcessingFee', ProcessingFeeController::class);
    Route::resource('Payment_students', PaymentController::class);
    Route::get('/Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);
    Route::get('/Get_Sections/{id}', [StudentController::class, 'Get_Sections']);
    Route::post('Upload_attachement', [StudentController::class,'Upload_attachement'])->name('Upload_attachement');
    Route::get('Download_attachment/{studentsname}/{filename}', [StudentController::class,'Download_attachment'])->name('Download_attachment');
    Route::post('Delete_attachment',[StudentController::class,'Delete_attachment'])->name('Delete_attachment');

 });

 Route::group(['namespace' => 'Subjects'], function () {
    Route::resource('subjects', 'SubjectController');
});

 Route::group(['namespace' => 'Quizzes'], function () {
    Route::resource('quizzes', 'QuizzController');
});
 Route::group(['namespace' => 'Questions'], function () {
    Route::resource('questions', 'QuestionController');
});

Route::resource('settings', SettingController::class);



});





