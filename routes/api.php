<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\StudentController;
use App\Http\Controllers\api\SubjectCourseSemester;
use App\Http\Controllers\api\CommonController;
use App\Http\Controllers\api\AssignmentManagement;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/auth/login',[AuthController::class, 'login']);
Route::get('/auth/login2',[AuthController::class, 'login2']);
Route::get('/student/{id}',[StudentController::class,'getStuentDetail']);
Route::get('/semester/{batch_id}',[SubjectCourseSemester::class,'getSemester']);
Route::get('/subject/{batch_id}/{semester_id}',[SubjectCourseSemester::class,'getSubject']);
Route::get('/material/{batch_id}/{subject_id}',[SubjectCourseSemester::class,'getMaterial']);
Route::get('/programs/{batch_id}/{subject_id}',[SubjectCourseSemester::class,'getProgram']);
Route::get('/slider',[CommonController::class,'slider']);
Route::get('/assignment/{batch_id}/{subject_id}',[AssignmentManagement::class,'getAssignment']);
Route::post('/upload_assignment',[AssignmentManagement::class,'uploadAssignment']);
Route::get('/student_upload_assignment/{assignment_id}/{student_id}',[AssignmentManagement::class,'getAssignmentStudent']);
Route::post('/update_assignment',[AssignmentManagement::class,'assignmentUpdate']);
