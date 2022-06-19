<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\AuthController as AuthUserController;
use App\Http\Controllers\Admin\Auth\AuthController as AuthAdminController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\ConfigController;

Route::redirect('/', '/login');

Route::get('{locale}/locale', [ConfigController::class, 'changeLocale'])->name('locale');
Route::get('/test', [ConfigController::class, 'test']);


Route::group([
    'middleware' => 'set_locale'
], function () {
    // User login
    Route::get('/login', [AuthUserController::class, 'login_form'])->name('login');
    Route::post('/login', [AuthUserController::class, 'login'])->name('auth.login');
    Route::get('/login_check/{id}', [AuthUserController::class, 'login_check_form'])->name('auth.login_check');
    Route::post('/login_check', [AuthUserController::class, 'login_check'])->name('auth.login_check_post');
    Route::post('/logout', [AuthUserController::class, 'logout'])->name('auth.logout')->middleware('auth');


    // Admin login
    Route::get('/login/admin', [AuthAdminController::class, 'login_form'])->name('admin.auth.login_form');
    Route::post('/login/admin', [AuthAdminController::class, 'login'])->name('admin.auth.login');


    Route::group(['middleware' => 'auth:user', 'prefix' => 'user'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('user.index');
        Route::post('/', [HomeController::class, 'store'])->name('user.store');
        Route::get("/app_complete", [HomeController::class, 'appComplete'])->name('user.app_complete');
        Route::post('/app_complete', [HomeController::class, 'appCompleteStore'])->name('user.app_complete_store');
    });

    Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
        Route::get('/', [MainController::class, 'index'])->name('admin.index');
        Route::get('/profile', [MainController::class, 'profileEdit'])->name('admin.profile_edit');
        Route::post('/profile', [MainController::class, 'profileUpdate'])->name('admin.profile_update');
        Route::get('/create_admin', [MainController::class, 'createAdmin'])->name('admin.create_admin');
        Route::post('/create_admin', [MainController::class, 'storeAdmin'])->name('admin.store_admin');
        Route::get('/apps', [MainController::class, 'apps'])->name('admin.apps');
        Route::post('/app_search', [MainController::class, 'appSearch'])->name('admin.app_search');
        Route::get('/app/{id}', [MainController::class, 'appShow'])->name('admin.app_show');
        Route::post('/app/close', [MainController::class, 'appClose'])->name('admin.close');
        Route::post('/app/cancel', [MainController::class, 'appCancel'])->name('admin.cancel');
    });
});

