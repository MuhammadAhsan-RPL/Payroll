<?php

use App\Http\Controllers\auth\AuthController;
use App\Livewire\User\Attendance;
use Illuminate\Support\Facades\Route;
use App\Livewire\Profile;
use App\Livewire\Admin\Index;
use App\Livewire\Admin\AttendanceManagement;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/action-login', [AuthController::class, 'actionLogin'])->name('action.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Routing admin 
Route::middleware(['auth', 'role:admin'])->group(function(){

Route::get('/profile', Profile::class)->name('profile');

Route::get('/admin', Index::class);

Route::get('/position', function () {
    return view('admin.position');
});
Route::get('/employee', function () {
    return view('admin.pegawai');
});
Route::get('/user', function () {
    return view('admin.pengguna');
});
Route::get('/payroll',function(){
    return view('admin.payroll');
});

Route::get('/attendance-admin', 
AttendanceManagement::class)->name('attendance.admin');
});

//END ROUTING ADMIN
Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get("/Attendance", function(){
        return view('user.kehadiran');
    }) ->name('attendance');
});
