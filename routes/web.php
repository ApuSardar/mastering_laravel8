<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';


// Admin all Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/edit/profile', 'edit')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');
});

//-------Employee   Controller--------// 
Route::controller(\App\Http\Controllers\EmployeeController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        //
        Route::get('/add-new-employee',         'add')->name('add.employee');
        Route::post('/new-employee',            'create')->name('employee.store');

        Route::get('/manage-employee',          'manage')->name('employee.manage');
        Route::get('/employee-status/{id}',     'updateStatus')->name('employee.update-status');

        Route::get('/employee-detail/{id}',     'detail')->name('employee.detail');
        Route::get('/employee-edit/{id}',       'edit')->name('employee.edit');

        Route::post('/employee-update/{id}',    'update')->name('employee.update');
        Route::post('/employee-delete/{id}',    'delete')->name('employee.destroy');
    });
});
