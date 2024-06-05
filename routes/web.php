<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonnelController;
use App\Models\Position;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// จัดระเบียบ Route
// Route::get('/', fn (): View => view('welcome'));
// Route::get('/login', fn (): View => view('login'));
// Route::get('/home', fn (): View => view('home'));

Route::view("/", 'welcome');
Route::view("/login", 'login');
Route::view("/home", 'home');

Route::post('/action', [LoginController::class, 'login'])->name('action');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::controller(PersonnelController::class)->group(function () {
    Route::get('/managePersonel', 'index')->name("managePersonel");
    Route::get('/detailPersonnel/{id}', 'show')->name("personnel.show");
    Route::get('/addPersonnel', 'create')->name("personnel.create");
    Route::get('/validateUsername', 'validateUsername')->name('validate.username');
    Route::post('/storePersonnel', 'store')->name("personnel.store");
    Route::get('/editPersonnel/{id}', 'edit')->name("personnel.edit");
    Route::put('/updatePersonnel/{id}', 'update')->name("personnel.update");
    Route::delete('/destroyPersonnel/{id}', 'destroy')->name("personnel.destroy");
});

