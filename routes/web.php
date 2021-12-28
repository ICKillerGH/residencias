<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommitmentLetterController;
use App\Http\Controllers\PresentationLetterController;
use App\Http\Controllers\ResidencyProcessController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
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
        Route::delete('/{admin}', [AdminsController::class, 'destroy'])->name('destroy')->can('destroy', 'admin');
        Route::get('/{admin}/edit', [AdminsController::class, 'edit'])->name('edit');
        Route::put('/{admin}', [AdminsController::class, 'update'])->name('update');
        Route::put('/{admin}/password', [AdminsController::class, 'updatePassword'])->name('updatePassword');
    });

    Route::prefix('/teachers')->name('teachers.')->group(function() {
        Route::get('/', [TeachersController::class, 'index'])->name('index')->can('index', Teacher::class);
        Route::get('/create', [TeachersController::class, 'create'])->name('create')->can('create', Teacher::class);
        Route::post('/', [TeachersController::class, 'store'])->name('store')->can('create', Teacher::class);
        Route::delete('/{teacher}', [TeachersController::class, 'destroy'])->name('destroy')->can('destroy', 'teacher');
        Route::get('/{teacher}/edit', [TeachersController::class, 'edit'])->name('edit');
        Route::put('/{teacher}', [TeachersController::class, 'update'])->name('update');
    });

    Route::prefix('/students')->name('students.')->group(function() {
        Route::get('/', [StudentsController::class, 'index'])->name('index')->can('index', Student::class);
        Route::get('/create', [StudentsController::class, 'create'])->name('create')->can('create', Student::class);
        Route::post('/', [StudentsController::class, 'store'])->name('store')->can('create', Student::class);
        Route::get('/{student}', [StudentsController::class, 'show'])->name('show')->where('student', '[0-9]+')->can('show', 'student');
        Route::get('/personal-info', [StudentsController::class, 'personalInfo'])->name('personalInfo')->can('view-personal-info');
        Route::put('/personal-info', [StudentsController::class, 'updatePersonalInfo'])->name('updatePersonalInfo');
        Route::get('/company-info', [StudentsController::class,'companyInfo'])->name('companyInfo')->can('view-company-info');
        Route::put('/company-info', [StudentsController::class,'updateCompanyInfo'])->name('updateCompanyInfo');
        Route::get('/project-info', [StudentsController::class,'projectInfo'])->name('projectInfo')->can('view-project-info');
        Route::put('/project-info', [StudentsController::class, 'updateProjectInfo'])->name('updateProjectInfo');
        Route::get('/residency-process', [ResidencyProcessController::class, 'residencyProcess'])->name('residencyProcess')->can('view-residency-info');
        Route::post('/residency-process/residency-request', [ResidencyProcessController::class, 'residencyRequest'])->name('residencyRequest');
        Route::put('/residency-process/residency-request/corrections/mark-as-solved', [ResidencyProcessController::class, 'residencyRequestMarkCorrectionsAsSolved'])->name('residencyRequestMarkCorrectionsAsSolved');
        Route::post('/{student}/residency-request/corrections', [ResidencyProcessController::class, 'residencyRequestCorrections'])->name('residencyRequestCorrections');
        Route::put('/{student}/residency-request/mark-as-approved', [ResidencyProcessController::class, 'residencyRequestMarkAsApproved'])->name('residencyRequestMarkAsApproved');
        Route::put('/{student}/residency-request/signed-document', [ResidencyProcessController::class, 'residencyRequestUploadSignedDoc'])->name('residencyRequestUploadSignedDoc');
        Route::get('/{student}/residency-request/signed-document', [ResidencyProcessController::class, 'residencyRequestDownloadSignedDoc'])->name('residencyRequestDownloadSignedDoc');
        Route::post('/residency-process/presentation-letter', [PresentationLetterController::class, 'presentationLetter'])->name('presentationLetter');
        Route::post('/{student}/presentation-letter/corrections', [PresentationLetterController::class, 'presentatioLetterCorrections'])->name('presentatioLetterCorrections');
        Route::put('/residency-process/presentation-letter/corrections/mark-as-solved', [PresentationLetterController::class, 'presentationLetterMarkCorrectionsAsSolved'])->name('presentationLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/presentation-letter/mark-as-approved', [PresentationLetterController::class, 'presentationLetterMarkAsApproved'])->name('presentationLetterMarkAsApproved');
        Route::post('/residency-process/commitment letter', [CommitmentLetterController::class, 'commitmentLetter'])->name('commitmentLetter');
        Route::post('/{student}/commitment-letter/corrections', [CommitmentLetterController::class, 'commitmentLetterCorrections'])->name('commitmentLetterCorrections');
        Route::put('/residency-process/commitment-letter/corrections/mark-as-solved', [CommitmentLetterController::class, 'commitmentLetterMarkCorrectionsAsSolved'])->name('commitmentLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/commitment-letter/mark-as-approved', [CommitmentLetterController::class, 'commitmentLetterMarkAsApproved'])->name('commitmentLetterMarkAsApproved');
        Route::put('/{student}/presentation-letter/signed-document', [PresentationLetterController::class, 'presentationLetterUploadSignedDoc'])->name('presentationLetterUploadSignedDoc');
        Route::get('/{student}/presentation-letter/signed-document', [PresentationLetterController::class, 'presentationLetterDownloadSignedDoc'])->name('presentationLetterDownloadSignedDoc');
        Route::put('/{student}/commitment-letter/signed-document', [CommitmentLetterController::class, 'commitmentLetterUploadSignedDoc'])->name('commitmentLetterUploadSignedDoc');
        Route::get('/{student}/commitment-letter/signed-document', [CommitmentLetterController::class, 'commitmentLetterDownloadSignedDoc'])->name('commitmentLetterDownloadSignedDoc');
        Route::delete('/{student}', [StudentsController::class, 'destroy'])->name('destroy');
        Route::get('/{student}/edit', [StudentsController::class, 'edit'])->name('edit');
        Route::put('/{student}', [StudentsController::class, 'update'])->name('update');

    });
});
