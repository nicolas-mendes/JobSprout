<?php

use App\Http\Controllers\Auth\PasswordValidationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/',[JobController::class,'index']);
Route::get('/search', SearchController::class);

Route::get('/tags/{tag:title}', TagController::class);

Route::get('/company/{employer}', [CompanyController::class,'show']);
Route::get('/companies', [CompanyController::class,'index']);

Route::get('/salaries', [SalariesController::class,'index']);

Route::get('/jobs/create',[JobController::class,'create'])
    ->middleware('auth')
    ->name('jobs.create');

Route::post('/jobs',[JobController::class,'store'])->middleware('auth');

Route::get('/jobs/{job}',[JobController::class, 'show']);

Route::get('/jobs/{job}/edit',[JobController::class, 'edit'])
    ->middleware('auth')
    ->name('jobs.edit');

Route::patch('/jobs/{job}',[JobController::class, 'update'])
    ->name('jobs.update');

Route::delete('/jobs/{job}',[JobController::class, 'destroy'])
    ->name('jobs.destroy');

Route::post('/validate-password', [PasswordValidationController::class, 'validatePassword']);

Route::middleware('guest')->group(function(){
    Route::get('/register',[RegisteredUserController::class,'create']);
    Route::post('/register',[RegisteredUserController::class,'store']);

    Route::get('/login',[SessionController::class,'create']);
    Route::post('/login',[SessionController::class,'store']);
});


Route::delete('/logout',[SessionController::class,'destroy'])->middleware('auth');