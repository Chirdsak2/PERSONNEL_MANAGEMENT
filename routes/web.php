<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController; // ตรวจสอบว่ามีการ import LoginController อย่างถูกต้อง
use App\Models\User;

// use Illuminate\Support\Facades\Auth; // import Auth facade
// use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/managePersonel', function () {
    $users = User::paginate(10);
    return view('managePersonel',compact('users'));
});

Route::get('/login', function () {
    return view('login');
});

// Route::post('/action', 'LoginController@login')->name('action'); // เพิ่มเส้นทางสำหรับการทำงานเมื่อกดปุ่ม Login
Route::post('/action', [LoginController::class, 'login'])->name('action'); // เพิ่มเส้นทางสำหรับการทำงานเมื่อกดปุ่ม Login

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
