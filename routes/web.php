<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PersonalInformationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[FrontController::class , 'index'])->name('index');
Route::get('/blog',[FrontController::class , 'blog'])->name('blog');
Route::get('/portfolio',[FrontController::class , 'portfolio'])->name('portfolio');
Route::get('/resume',[FrontController::class , 'resume'])->name('resume');
Route::get('/contact',[FrontController::class , 'contact'])->name('contact');

Route::prefix('admin')->middleware('auth')->group(function (){

    Route::get('/',[AdminController::class , 'index'])->name('admin.index');

    //Eğitim Bilgileri Route
    Route::prefix('education')->group(function (){

        Route::get('/list',[EducationController::class , 'educationList'])->name('admin.education.list');
        Route::post('/change-status',[EducationController::class , 'changeStatus'])->name('admin.education.changeStatus');
        Route::post('/delete',[EducationController::class , 'delete'])->name('admin.education.delete');
        Route::get('/add',[EducationController::class , 'addShow'])->name('admin.education.add');
        Route::post('/add',[EducationController::class , 'add']);
    });

    //Deneyim Bilgileri
    Route::prefix('experience')->group(function (){
        Route::get('/-list',[ExperienceController::class , 'list'])->name('admin.experience.list');
        Route::get('/-add',[ExperienceController::class , 'addShow'])->name('admin.experience.add');
        Route::post('/-add',[ExperienceController::class , 'add']);
        Route::post('/-change-status',[ExperienceController::class , 'changeStatus'])->name('admin.experience.changeStatus');
        Route::post('/-change-active',[ExperienceController::class , 'activeStatus'])->name('admin.experience.activeStatus');
        Route::post('/-delete',[ExperienceController::class , 'delete'])->name('admin.experience.delete');
    });

    //İletişim Bilgileri
    Route::get('/personal-information',[PersonalInformationController::class , 'index'])->name('personalInformation.index');
    Route::post('/personal-information',[PersonalInformationController::class , 'update']);



});


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');



