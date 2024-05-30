<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController; // ตรวจสอบว่ามีการ import LoginController อย่างถูกต้อง
use App\Http\Controllers\PersonnelController;
use App\Models\User;

// use Illuminate\Support\Facades\Auth; // import Auth facade
// use Illuminate\Http\Request;
    

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

// Route::post('/action', 'LoginController@login')->name('action'); // เพิ่มเส้นทางสำหรับการทำงานเมื่อกดปุ่ม Login
Route::post('/action', [LoginController::class, 'login'])->name('action'); // เพิ่มเส้นทางสำหรับการทำงานเมื่อกดปุ่ม Login
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
});

Route::get('/managePersonel', function () {
    $users = User::paginate(10);
    return view('managePersonel',compact('users'));
})->name('managePersonel');

Route::controller(PersonnelController::class)->group(function () {
    Route::get('/addPersonnel', 'create')->name("personnel.create");
    Route::post('/storePersonnel', 'store')->name("personnel.store");
    Route::get('/editPersonnel/{id}', 'edit')->name("personnel.edit");
    Route::put('/updatePersonnel/{id}', 'update')->name("personnel.update");
    Route::delete('/destroyPersonnel/{id}', 'destroy')->name("personnel.destroy");

});