<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidencyProcessController;
use App\Http\Controllers\StudentsController;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function() {
    Route::prefix('/admins')->name('admins.')->group(function() {
        Route::get('/', [AdminsController::class, 'index'])->name('index')->can('index', Admin::class);
        Route::get('/create', [AdminsController::class, 'create'])->name('create')->can('create', Admin::class);
        Route::post('/', [AdminsController::class, 'store'])->name('store')->can('create', Admin::class);
    });

    Route::prefix('/students')->name('students.')->group(function() {
        Route::get('/', [StudentsController::class, 'index'])->name('index')->can('index', Student::class);
        Route::get('/create', [StudentsController::class, 'create'])->name('create')->can('create', Student::class);
        Route::post('/', [StudentsController::class, 'store'])->name('store')->can('create', Student::class);
        Route::get('/{student}', [StudentsController::class, 'show'])->name('show')->where('student', '[0-9]+')->can('show', 'student');
        Route::get('/personal-info', [StudentsController::class, 'personalInfo'])->name('personalInfo');
        Route::put('/personal-info', [StudentsController::class, 'updatePersonalInfo'])->name('updatePersonalInfo');
        Route::get('/company-info', [StudentsController::class,'companyInfo'])->name('companyInfo');
        Route::put('/company-info', [StudentsController::class,'updateCompanyInfo'])->name('updateCompanyInfo');
        Route::get('/project-info', [StudentsController::class,'projectInfo'])->name('projectInfo');
        Route::put('/project-info', [StudentsController::class, 'updateProjectInfo'])->name('updateProjectInfo');
        Route::get('/residency-process', [ResidencyProcessController::class, 'residencyProcess'])->name('residencyProcess');
        Route::post('/residency-process/residency-request', [ResidencyProcessController::class, 'residencyRequest'])->name('residencyRequest');
        Route::put('/residency-process/residency-request/corrections/mark-as-solved', [ResidencyProcessController::class, 'residencyRequestMarkCorrectionsAsSolved'])->name('residencyRequestMarkCorrectionsAsSolved');
        Route::post('/{student}/residency-request/corrections', [ResidencyProcessController::class, 'residencyRequestCorrections'])->name('residencyRequestCorrections');
        Route::put('/{student}/residency-request/mark-as-approved', [ResidencyProcessController::class, 'residencyRequestMarkAsApproved'])->name('residencyRequestMarkAsApproved');
    });
});
