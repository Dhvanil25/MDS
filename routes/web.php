<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AdminAuth\AuthController;
use  App\Http\Controllers\Admin\DepartmentController;
use  App\Http\Controllers\Admin\BatchController;
use  App\Http\Controllers\Admin\BatchSemesterController;
use  App\Http\Controllers\AjaxController;
use  App\Http\Controllers\Admin\StudentController;
use  App\Http\Controllers\Admin\SemesterController;
use  App\Http\Controllers\Admin\FacultyController;
use  App\Http\Controllers\Admin\SubjectController;
use  App\Http\Controllers\Admin\FacultySubjectController;
use  App\Http\Controllers\Faculty\FacultyAuthController;
use  App\Http\Controllers\Faculty\FacultyUploadMaterial;
use  App\Http\Controllers\Faculty\FacultySubjectMaterialsData;
use App\Http\Controllers\Faculty\FacultyUploadProgram;
use App\Http\Controllers\Faculty\ManageUploadAssignment;
use App\Http\Controllers\Faculty\ProgramController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Faculty\AssignmentCheck;
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

Route::get("admin/login",[AuthController::class,'login'])->middleware('admin_already_login');
Route::post("/admin_check",[AuthController::class,'check']);

Route::middleware(['admin_login_check'])->group(function () {
    //
    Route::get('admin/logout',[AuthController::class,'logout']);
    Route::get('admin/index', function () {
        return view('admin/index');
    });
    
    Route::resource('admin/add_department',DepartmentController::class);
    Route::resource('admin/add_batch',BatchController::class);
    Route::resource('admin/add_batch_semester',BatchSemesterController::class);
    Route::resource('admin/add_student', StudentController::class);
    Route::resource('admin/add_faculty', FacultyController::class);
    Route::resource('admin/add_subject', SubjectController::class);
    Route::resource('admin/add_subject_faculty', FacultySubjectController::class);
    Route::resource('admin/add_semester', SemesterController::class);
    Route::resource('admin/add_slider', SliderController::class);
    Route::resource('admin/add_feedback', FeedbackController::class);
    Route::get('get-batch', [AjaxController::class, 'getBatch'])->name('getBatch');
    Route::get('get-semester', [AjaxController::class, 'getSemster'])->name('getSemster');
    Route::get('get-subject', [AjaxController::class, 'getSubject'])->name('getSubject');
    
    Route::get('checkSubjectCode', [AjaxController::class, 'checkSubjectCode'])->name('checkSubjectCode');
    //getBatchSubject
    Route::get('getBatchSubject', [AjaxController::class, 'getBatchSubject'])->name('getBatchSubject');
    //getBatchDepartmentSubject
    Route::get('getBatchDepartmentSubject', [AjaxController::class, 'getBatchDepartmentSubject'])->name('getBatchDepartmentSubject');

});
//Faculty Web Control
Route::get("faculty/login",[FacultyAuthController::class,'login']);
Route::post("/check",[FacultyAuthController::class,'check']);
Route::middleware(['faculty_login_check'])->group(function () {
    //
    Route::get('faculty/index', function () {
        return view('faculty/index');
    }); 
    Route::get('faculty/logout',[FacultyAuthController::class,'logout']);
    //upload Materail By Faculty material_upload
    Route::get('faculty/material_upload', [FacultyUploadMaterial::class,'getBatchDetails']);
    // faculty_materil_subject/
    Route::get('faculty/faculty_materil_semester/{batch_id}', [FacultyUploadMaterial::class,'faculty_materil_subject']);
    //faculty_material_subject
    Route::get('faculty/faculty_material_subject/{semester_id}/{department_id}/{batch_id}', [FacultyUploadMaterial::class,'faculty_materil_semester']);
    //faculty_material.blade.php
    Route::get('faculty/faculty_material/{semester_id}/{department_id}/{batch_id}/{subject_id}', [FacultyUploadMaterial::class,'faculty_material']);
    //faculty_subject_materials
    Route::resource('faculty/faculty_subject_materials', FacultySubjectMaterialsData::class);
    //upload Materail By Faculty material_upload
    Route::get('faculty/program_upload', [FacultyUploadProgram::class,'getBatchDetails']);
    Route::get('faculty/faculty_program_semester/{batch_id}', [FacultyUploadProgram::class,'faculty_program_subject']);
//faculty_material_subject
Route::get('faculty/faculty_program_subject/{semester_id}/{department_id}/{batch_id}', [FacultyUploadProgram::class,'faculty_program_semester']);
Route::get('faculty/faculty_program/{semester_id}/{department_id}/{batch_id}/{subject_id}', [FacultyUploadProgram::class,'faculty_program']);
Route::resource('faculty/program',ProgramController::class);
Route::get('faculty/faculty_assignment/{semester_id}/{department_id}/{batch_id}/{subject_id}', [ManageUploadAssignment::class,'faculty_assignment']);
Route::resource('faculty/assignment',ManageUploadAssignment::class);
Route::get('faculty/faculty_assignment_check/{assignment_id}', [AssignmentCheck::class,'AssignmentCheck'])->name('assignmentCheck');
Route::PATCH('faculty/faculty_assignment_check/{student_assignment_id}/edit', [AssignmentCheck::class,'AssignmentCheckUpdate'])->name('response.update');
});
?>