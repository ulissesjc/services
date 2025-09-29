<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Imports\SchoolsImport;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['admin'])->group(function() {
        Route::get('/users', [UserController::class, 'index'])->name('user-index');
        Route::get('users/create', [UserController::class, 'create'])->name('user-create');
        Route::post('users/store', [UserController::class, 'store'])->name('user-store');
        Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('user-destroy');
        Route::get('/import', function () {
            return view('import');
        });
        Route::post('/import-schools', function () {
            Excel::import(new SchoolsImport, request()->file('file'));
            return redirect()->back()->with('success', 'Escolas importadas com sucesso!');
        });
    });

    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('user-edit');
    Route::put('/users/update/{user}', [UserController::class, 'update'])->name('user-update');

    Route::get('/schools', [SchoolController::class, 'index'])->name('school-index');
    Route::get('/schools/pending', [SchoolController::class, 'getPendingSchools'])->name('schools-pending');
    Route::get('/schools/create', [SchoolController::class, 'create'])->name('school-create');
    Route::post('/schools/store', [SchoolController::class, 'store'])->name('school-store');
    Route::get('/schools/show/{school}', [SchoolController:: class, 'show'])->name('school-show');
    Route::get('/schools/edit/{school}', [SchoolController::class, 'edit'])->name('school-edit');
    Route::put('/schools/update/{school}', [SchoolController::class, 'update'])->name('school-update');
    Route::delete('/schools/destroy/{school}', [SchoolController::class, 'destroy'])->name('school-destroy');

    Route::get('/services', [ServiceController::class, 'index'])->name('service-index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('service-create');
    Route::post('/services/store', [ServiceController::class, 'store'])->name('service-store');
    Route::get('/services/edit/{service}', [ServiceController::class, 'edit'])->name('service-edit');
    Route::put('/services/update/{service}', [ServiceController::class, 'update'])->name('service-update');
    Route::delete('/services/destroy/{service}', [ServiceController::class, 'destroy'])->name('service-destroy');

});





