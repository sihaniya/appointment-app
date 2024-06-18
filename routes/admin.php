<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;








Route::prefix('/admin')->group(function () {

    // Route::middleware(['admin.guest'])->group(function () {
    //     Route::get('/login', [AuthController::class, 'index'])->name('admin.login');
    //     Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('admin.authenticate');


    // });



    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/markdown', [DashboardController::class, 'markdown'])->name('admin.markdown');

    // users
    Route::get('/users', [UserController::class, 'index'])->name('admin.user');
    Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::post('/user/fetch', [UserController::class, 'userFetch'])->name('admin.user.fetch');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('/user/{id}/update', [UserController::class, 'update'])->name('admin.user.update');
    Route::get('/user/{id}/destroy', [UserController::class, 'destroy'])->name('admin.user.delete');

    // Appointment
    Route::get('/appointment', [AppointmentController::class, 'index'])->name('admin.appointment');
    Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('admin.appointment.create');
    Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('admin.appointment.store');
    Route::post('/appointment/fetch', [AppointmentController::class, 'appointmentFetch'])->name('admin.appointment.fetch');
    Route::get('/appointment/{id}/edit', [AppointmentController::class, 'edit'])->name('admin.appointment.edit');
    Route::post('/appointment/{id}/update', [AppointmentController::class, 'update'])->name('admin.appointment.update');
    Route::get('/appointment/{id}/destroy', [AppointmentController::class, 'destroy'])->name('admin.appointment.delete');


    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile/change-password', [ProfileController::class, 'change_password'])->name('admin.profile.changePassword');
    Route::post('/profile/update-profile-image', [ProfileController::class, 'update_profile_image'])->name('admin.profile.updateProfileImage');


    // articles
    // Route::get('/articles', [ArticleController::class, 'index'])->name('admin.article');
    // Route::get('/articles/create', [ArticleController::class, 'create'])->name('admin.article.create');
    // Route::post('/articles', [ArticleController::class, 'store'])->name('admin.article.store');
    // Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('admin.article.edit');
    // Route::post('/articles/{id}/update', [ArticleController::class, 'update'])->name('admin.article.update');
    // Route::get('/articles/{id}/destroy', [ArticleController::class, 'destroy'])->name('admin.article.delete');
    // Route::post('/articles/fetch', [ArticleController::class, 'fetch'])->name('admin.article.fetch');
    Route::middleware(['admin.auth'])->group(function () {
    });
});