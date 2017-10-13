<?php

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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    //Student Module
    Route::resource('/students', 'StudentsController');
    Route::get('students/ajax/listing', 'StudentsController@getIndexPaginated')->name('ajax_students');
    Route::post('students/ajax/imageUpload', 'StudentsController@imageUpload')->name('ajax_studImageUpload');
    Route::post('students/ajax/imageDelete', 'StudentsController@imageDelete')->name('ajax_studImageDelete');
    Route::post('students/ajax/getBatch', 'StudentsController@getBatch')->name('ajax_yearBatch');
    Route::post('students/ajax/getSection', 'StudentsController@getSection')->name('ajax_batchSection');

    //Batch Module
    Route::resource('/batches', 'BatchController');
    Route::get('batches/ajax/listing', 'BatchController@getIndexPaginated')->name('ajax_batches');
    Route::post('batches/ajax/imageUpload', 'BatchController@imageUpload')->name('ajax_batchImageUpload');
    Route::post('batches/ajax/imageDelete', 'BatchController@imageDelete')->name('ajax_batchImageDelete');

    //Academic Year Module
    Route::group(['prefix' => 'academic-year'], function () {
        Route::get('destroy/{academic_year_id?}', 'AcademicYearController@destroy')->name('academicYear_delete');
        Route::get('ajax/listing', 'AcademicYearController@getIndexPaginated')->name('ajax_academicYear');
    });
    Route::resource('/academic-year', 'AcademicYearController');

    //Courses Module
    Route::group(['prefix' => 'courses'], function () {
        Route::get('destroy/{course_id?}', 'CourseController@destroy')->name('course_delete');
        Route::get('ajax/listing', 'CourseController@getIndexPaginated')->name('ajax_courses');
    });
    Route::group(['middleware'=>'check-permission:Super Admin|Admin'], function(){
        Route::resource('/courses', 'CourseController');
    });


    //Subject Module
    Route::resource('/subjects', 'SubjectController');
    Route::get('subjects/ajax/listing', 'SubjectController@getIndexPaginated')->name('ajax_subjects');

    //Section Module
    Route::resource('/sections', 'SectionController');
    Route::get('sections/ajax/listing', 'SectionController@getIndexPaginated')->name('ajax_sections');
    Route::post('sections/ajax/getBatch', 'SectionController@getBatch')->name('ajax_sectionsBatch');

    //Profile Section
    Route::resource('/profile', 'ProfileController');
    Route::post('profile/ajax/imageUpload', 'ProfileController@imageUpload')->name('ajax_profileImageUpload');
    Route::post('profile/ajax/imageDelete', 'ProfileController@imageDelete')->name('ajax_profileImageDelete');

    // Human Resource > Employee Management > Department Module
    Route::group(['prefix' => 'department'], function () {
        Route::get('destroy/{department_id?}', 'DepartmentController@destroy')->name('department_delete');
        Route::get('ajax/listing', 'DepartmentController@getIndexPaginated')->name('ajax_departments');
    });
    Route::resource('department', 'DepartmentController');

    // Human Resource > Employee Management > Designation Module
    Route::group(['prefix' => 'designation'], function () {
        Route::get('destroy/{designation_id?}', 'DesignationController@destroy')->name('designation_delete');
        Route::get('ajax/listing', 'DesignationController@getIndexPaginated')->name('ajax_designations');
    });
    Route::resource('designation', 'DesignationController');


    //Employee Section
    Route::group(['prefix' => 'employees'], function () {
        Route::get('destroy/{designation_id?}', 'UserController@destroy')->name('employee_delete');
        Route::get('ajax/listing', 'UserController@getIndexPaginated')->name('ajax_employees');
    });
    Route::resource('employees', 'UserController');

    //Shift Section
    Route::group(['prefix' => 'shifts'], function () {
        Route::get('destroy/{shift_id?}', 'ShiftController@destroy')->name('shift_delete');
        Route::get('ajax/listing', 'ShiftController@getIndexPaginated')->name('ajax_shifts');
    });
    Route::resource('shifts', 'ShiftController');

    //Shift Allocation Section
    Route::group(['prefix' => 'shift-allocations'], function () {
        Route::post('search', 'ShiftAllocationController@index')->name('emp_search');
        Route::get('ajax/listing', 'ShiftAllocationController@getIndexPaginated')->name('ajax_shiftAllocations');
    });
    Route::resource('shift-allocations', 'ShiftAllocationController');

    //Question category section
    Route::group(['prefix' => 'question-category'], function () {
        Route::get('destroy/{questionCat_id?}', 'QuestionCategoryController@destroy')->name('questionCat_delete');
        Route::get('ajax/listing', 'QuestionCategoryController@getIndexPaginated')->name('ajax_questionCategory');
    });
    Route::resource('question-category', 'QuestionCategoryController');


});