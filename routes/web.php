<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Psr7\Request;

//login
Route::get('/', [UserController::class, 'loginscreen'])->name('loginscreen');
Route::get('/loginuser', [UserController::class, 'loginuser'])->name('loginuser');
Route::get('/logoutuser', [UserController::class, 'logoutuser'])->name('logoutuser');
Route::get('/createuser', [UserController::class, 'createuser'])->name('createuser');
Route::get('/createuserpost', [UserController::class, 'createuserpost'])->name('createuserpost');

// ortak
Route::get('/erisimyasak', [UserController::class, 'erisimyasak'])->name('erisimyasak');

// user auth middleware
Route::middleware('useraccess')->group(function () {
    // users
    Route::get('/updateuser', [UserController::class, 'updateuser'])->name('updateuser');
    Route::get('/updateuserpost', [UserController::class, 'updateuserpost'])->name('updateuserpost');
    // student
    Route::get('/updateuserajax', '\App\Http\Controllers\UserController@updateuserajax')->name('updateuserajax');
    Route::get('/createstudentajax', '\App\Http\Controllers\StudentController@createstudentajax')->name('createstudentajax');
    Route::get('/updatestudentajax', '\App\Http\Controllers\StudentController@updatestudentajax')->name('updatestudentajax');
    Route::get('/deletestudentajax', '\App\Http\Controllers\StudentController@deletestudentajax')->name('deletestudentajax');
    Route::get('/deneme', '\App\Http\Controllers\UserController@deneme')->name('deneme');

    
    Route::get('/studentlist', [StudentController::class, 'studentlist'])->name('studentlist');

    Route::get('/studentlist/pagination', 'App\Http\Controllers\StudentController@fetch_data')->name('fetch_data');
});
