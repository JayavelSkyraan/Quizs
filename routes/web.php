<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ApiController;

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
    return view('auth/login');
});

    

Auth::routes();


Route::group(['middleware' => ['auth']], function () { 

Route::get('/home', [HomeController::class, 'index'])->name('home');


// profile update
Route::get('update-profile', function(){
    return view('update-profile');
    });

Route::post('update-profile/edit/{id}', [AdminController::class,'Passwordupdate'])->name('update-profile.update');


//add new app..
Route::get("add-new-app", function(){
    return view("add-new-app");
    });
    
Route::get('add-new-app',  [AdminController::class,'NewAppselectnames']);


//app list insert 
Route::post('add-new-app', [AdminController::class,'NewAppinsert'])->name('new-app.insert');

//new app update
Route::get('app-list/edit/{id}',[AdminController::class, 'AppSelect']);
Route::post('app-list/update/{id}', [AdminController::class, 'Appupdate'])->name('app-list.update');
    
//app select
 Route::get('app-list', [AdminController::class, 'applistselect'])->name("applist.paginate");


//app list delete..
Route::get('app-list/delete/{id}', [AdminController::class, 'deleteApplist']);
Route::post('ApplistAction', [AdminController::class,'ApplistAction']);
Route::post("app-list/update-status/{id}", [AdminController::class, 'appupdatestatus']);



//add new category..
Route::get("add-new-category", function(){
    return view("add-new-category");
    });

Route::get('add-new-category', [AdminController::class, 'categoryselect']);
Route::post('add-new-category', [AdminController::class, 'categoryinsert'])->name('add-category.insert');


//category list
Route::get("category-list", [AdminController::class, 'categorylistselect'])->name("categorylist.paginate");

Route::get("category-list/edit/{id}", [AdminController::class, 'categoryedit']);    

Route::post("category-list/update/{id}", [AdminController::class, 'categoryupdate'])->name('add-category.update');
Route::get("category-list/delete/{id}", [AdminController::class, 'categorydelete']);
Route::delete('CategorylistDeleteAll', [AdminController::class,'categorylistdeleteAll']);
Route::post('CategoryAction', [AdminController::class,'CategoryAction']);
Route::post("category-list/update-status/{id}", [AdminController::class, 'categoryupdatestatus']);


//quiz


Route::get('add-new-quiz', [AdminController::class, 'quizcategorylist']);
Route::post('add-new-quiz', [AdminController::class, 'quizinsert'])->name('quiz.insert');

//quiz list
Route::get("quiz-list", [AdminController::class, 'quizlistselect'])->name("quizlist.paginate");
Route::post('QuizAction', [AdminController::class,'QuizAction']);
Route::get("quiz-list/edit/{id}", [AdminController::class, 'quizedit']);
Route::get("quiz-list/delete/{id}", [AdminController::class, 'quizdelete']);
Route::post("quiz-list/update/{id}", [AdminController::class, 'quizupdate'])->name('quiz-list.update');
Route::post("quiz-list/update-status/{id}", [AdminController::class, 'quizupdatestatus']);


//ascending, descending orders
//quizs list

Route::get("quiz-list/quiz/id/asc", [AdminController::class, 'descendingorder']);
Route::get("quiz-list/quiz/id/desc", [AdminController::class, 'descendingorder']);
Route::get("quiz-list/quiz/question/asc", [AdminController::class, 'descendingorder']);
Route::get("quiz-list/quiz/question/desc", [AdminController::class, 'descendingorder']);
Route::get("quiz-list/quiz/created_at/asc", [AdminController::class, 'descendingorder']);
Route::get("quiz-list/quiz/created_at/desc", [AdminController::class, 'descendingorder']);
Route::get("quiz-list/quiz/category_name/asc", [AdminController::class, 'descendingorder']);
Route::get("quiz-list/quiz/category_name/desc", [AdminController::class, 'descendingorder']);


//category_list
Route::get("category-list/category/category_id/asc", [AdminController::class, 'descendingorder']);
Route::get("category-list/category/category_id/desc", [AdminController::class, 'descendingorder']);
Route::get("category-list/category/category_name/asc", [AdminController::class, 'descendingorder']);
Route::get("category-list/category/category_name/desc", [AdminController::class, 'descendingorder']);
Route::get("category-list/category/created_at/asc", [AdminController::class, 'descendingorder']);
Route::get("category-list/category/created_at/desc", [AdminController::class, 'descendingorder']);
Route::get("category-list/category/language_name/asc", [AdminController::class, 'descendingorder']);
Route::get("category-list/category/language_name/desc", [AdminController::class, 'descendingorder']);

//app list
Route::get("app-list/app/id/asc", [AdminController::class, 'descendingorder']);
Route::get("app-list/app/id/desc", [AdminController::class, 'descendingorder']);
Route::get("app-list/app/app_name/asc", [AdminController::class, 'descendingorder']);
Route::get("app-list/app/app_name/desc", [AdminController::class, 'descendingorder']);
Route::get("app-list/app/category_id/asc", [AdminController::class, 'descendingorder']);
Route::get("app-list/app/category_id/desc", [AdminController::class, 'descendingorder']);
Route::get("app-list/app/created_at/asc", [AdminController::class, 'descendingorder']);
Route::get("app-list/app/created_at/desc", [AdminController::class, 'descendingorder']);

//api 
Route::get('api', function () {
    return view('api');
});

//image upload

Route::post('image-upload',[UploadController::class, 'uploadimage'])->name('upload.image');

Route::get('app-list-api', [ApiController::class, 'appapi'])->name('app.api');
Route::get('category-list-api', [ApiController::class, 'categoryapi'])->name('category.api');
Route::get('quiz-list-api', [ApiController::class, 'quizapi'])->name('quiz.api');


//logout..
Route::get('logout', [AdminController::class,'logout']);




});