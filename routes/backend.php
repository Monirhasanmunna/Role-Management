<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;



//'as'=>'app.','prefix'=>'app','middleware'=>'auth'//
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::resource('roles',RoleController::class); 


