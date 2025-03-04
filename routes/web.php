<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SchoolController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\SchoolAdminController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\SubjectController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\ParentController;
use App\Http\Controllers\Backend\UserController;

// Route untuk halaman utama dan autentikasi
Route::get('/', [AuthController::class, 'login']);
Route::post('/', [AuthController::class, 'auth_login']);
Route::get('forgot', [AuthController::class, 'forgot']);
Route::post('logout', [AuthController::class, 'logout']);

// Route group untuk pengguna umum (common middleware)
Route::group(['middleware' => 'common'], function () {
    Route::get('panel/change-password', [UserController::class, 'change_password']);
    Route::post('panel/change-password', [UserController::class, 'update_password']);

    Route::get('panel/my-account', [UserController::class, 'my_account']);
    Route::post('panel/my-account', [UserController::class, 'update_account']);
    
    Route::get('panel/dashboard', [DashboardController::class, 'dashboard']);
});

// Route group untuk admin (admin middleware)
Route::group(['middleware' => 'admin',], function () {
    Route::get('panel/admin', [AdminController::class, 'admin_list']);
    Route::get('panel/admin/create', [AdminController::class, 'create_admin']); 
    Route::post('panel/admin/create', [AdminController::class, 'insert_admin']);
    Route::get('panel/admin/edit/{id}', [AdminController::class, 'edit_admin']);
    Route::post('panel/admin/update/{id}', [AdminController::class, 'update_admin']);
    Route::get('panel/admin/delete/{id}', [AdminController::class, 'delete_admin']);

    Route::get('panel/school', [SchoolController::class, 'school_list']);
    Route::get('panel/school/create', [SchoolController::class, 'create_school']);
    Route::post('panel/school/create', [SchoolController::class, 'insert_school']);
    Route::get('panel/school/edit/{id}', [SchoolController::class, 'edit_school']);
    Route::post('panel/school/update/{id}', [SchoolController::class, 'update_school']);
    Route::get('panel/school/delete/{id}', [SchoolController::class, 'delete_school']);
});

// Route group untuk school (school middleware)
Route::group(['middleware' => 'school',], function () {

    Route::get('panel/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('panel/teacher', [TeacherController::class, 'teacher_list']);
    Route::get('panel/teacher/create', action: [TeacherController::class, 'create_teacher']);
    Route::post('panel/teacher/create', [TeacherController::class, 'insert_teacher']);
    Route::get('panel/teacher/edit/{id}', [TeacherController::class, 'edit_teacher']);
    Route::post('panel/teacher/update/{id}', [TeacherController::class, 'update_teacher']);
    Route::get('panel/teacher/delete/{id}', [TeacherController::class, 'delete_teacher']);

    Route::get('panel/student', [StudentController::class, 'student_list']);
    Route::get('panel/student/create', action: [StudentController::class, 'create_student']);
    Route::post('panel/student/create', [StudentController::class, 'insert_student']);
    Route::get('panel/student/edit/{id}', [StudentController::class, 'edit_student']);
    Route::post('panel/student/update/{id}', [StudentController::class, 'update_student']);
    Route::get('panel/student/delete/{id}', [StudentController::class, 'delete_student']);
    Route::post('panel/student/getclass', [StudentController::class, 'getclass']);

    Route::get('panel/parent', [ParentController::class, 'parent_list']);
    Route::get('panel/parent/create', action: [ParentController::class, 'create_parent']);
    Route::post('panel/parent/create', [ParentController::class, 'insert_parent']);
    Route::get('panel/parent/edit/{id}', [ParentController::class, 'edit_parent']);
    Route::post('panel/parent/update/{id}', [ParentController::class, 'update_parent']);
    Route::get('panel/parent/delete/{id}', [ParentController::class, 'delete_parent']);
    Route::get('panel/parent/my-student/{id}', [ParentController::class, 'my_student']);
    Route::get('panel/parent/add-student/{student_id}/{parent_id}', [ParentController::class, 'add_student']);
    Route::get('panel/parent/my-student-delete/{student_id}', [ParentController::class, 'my_student_delete']);

    Route::get('panel/school_admin', [SchoolAdminController::class, 'school_admin_list']);
    Route::get('panel/school_admin', [SchoolAdminController::class, 'school_admin_list']);
    Route::get('panel/school_admin/create', [SchoolAdminController::class, 'create_school_admin']); 
    Route::post('panel/school_admin/create', [SchoolAdminController::class, 'insert_school_admin']);
    Route::get('panel/school_admin/edit/{id}', [SchoolAdminController::class, 'edit_school_admin']);
    Route::post('panel/school_admin/update/{id}', [SchoolAdminController::class, 'update_school_admin']);
    Route::get('panel/school_admin/delete/{id}', [SchoolAdminController::class, 'delete_school_admin']);

    Route::get('panel/class', [ClassController::class, 'class_list']);
    Route::get('panel/class/create', [ClassController::class, 'create_class']); 
    Route::post('panel/class/create', [ClassController::class, 'insert_class']);
    Route::get('panel/class/edit/{id}', [ClassController::class, 'edit_class']);
    Route::post('panel/class/update/{id}', [ClassController::class, 'update_class']);
    Route::get('panel/class/delete/{id}', [ClassController::class, 'delete_class']);
    
    Route::get('panel/subject', [SubjectController::class, 'subject_list']);
    Route::get('panel/subject/create', [SubjectController::class, 'create_subject']); 
    Route::post('panel/subject/create', [SubjectController::class, 'insert_subject']);
    Route::get('panel/subject/edit/{id}', [SubjectController::class, 'edit_subject']);
    Route::post('panel/subject/update/{id}', [SubjectController::class, 'update_subject']);
    Route::get('panel/subject/delete/{id}', [SubjectController::class, 'delete_subject']);

    Route::get('panel/assign-subject', [SubjectController::class, 'assign_subject_list']);
    Route::get('panel/assign-subject/create', [SubjectController::class, 'create_assign_subject']);
    Route::post('panel/assign-subject/create', [SubjectController::class, 'insert_assign_subject']);
    Route::get('panel/assign-subject/edit/{id}', [SubjectController::class, 'edit_assign_subject']);
    Route::post('panel/assign-subject/update/{id}', [SubjectController::class, 'update_assign_subject']);
    Route::get('panel/assign-subject/delete/{id}', [SubjectController::class, 'delete_assign_subject']);


    Route::get('panel/assign-subject/edit-single/{id}', [SubjectController::class, 'edit_single_assign_subject']);
    Route::post('panel/assign-subject/edit-single/{id}', [SubjectController::class, 'update_single_assign_subject']);
   

    
    Route::get('panel/class-timetable', [SubjectController::class, 'class_timetable']);
    Route::post('panel/class-timetable', [SubjectController::class, 'submit_class_timetable']);
    Route::post('panel/get_assign_subject_class', [SubjectController::class, 'get_assign_subject_class']);

    Route::get('panel/assign-class-teacher', [ClassController::class, 'assign_class_teacher_list']);
    Route::get('panel/assign-class-teacher/create', [ClassController::class, 'create_assign_class_teacher']);
    Route::post('panel/assign-class-teacher/create', [ClassController::class, 'insert_assign_class_teacher']);
    Route::get('panel/assign-class-teacher/edit/{id}', [ClassController::class, 'edit_assign_class_teacher']);
    Route::post('panel/assign-class-teacher/update/{id}', [ClassController::class, 'update_assign_class_teacher']);
    Route::get('panel/assign-class-teacher/delete/{id}', [ClassController::class, 'delete_assign_class_teacher']);


    Route::get('panel/assign-class-teacher/edit-single/{id}', [ClassController::class, 'edit_single_assign_class_teacher']);
    Route::post('panel/assign-class-teacher/update-single/{id}', [ClassController::class, 'update_single_assign_class_teacher']);
});

Route::group(['middleware' => 'teacher',], function () {
        
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teacher/my-class-subject', [ClassController::class, 'TeacherClassSubject']);
    Route::get('teacher/my-class-subject/timetable/{class_id}/{subject_id}', [ClassController::class, 'TeacherTimeTable']);
    
});

Route::group(['middleware' => 'student',], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

});

Route::group(['middleware' => 'parent',], function () {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);

});

