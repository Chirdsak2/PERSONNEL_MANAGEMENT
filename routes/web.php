<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonnelController;
use App\Models\User;
use Illuminate\Contracts\View\View;

Route::get('/', fn (): View => view('welcome'));
Route::get('/login', fn (): View => view('login'));
Route::get('/home', fn (): View => view('home'));

Route::post('/action', [LoginController::class, 'login'])->name('action');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/managePersonel', function (): View {
    $users = User::paginate(10);
    return view('managePersonel', compact('users'));
})->name('managePersonel');

Route::controller(PersonnelController::class)->group(function () {
    Route::get('/addPersonnel', 'create')->name("personnel.create");
    Route::post('/storePersonnel', 'store')->name("personnel.store");
    Route::get('/editPersonnel/{id}', 'edit')->name("personnel.edit");
    Route::put('/updatePersonnel/{id}', 'update')->name("personnel.update");
    Route::delete('/destroyPersonnel/{id}', 'destroy')->name("personnel.destroy");
});

