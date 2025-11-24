<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectRoleController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\PdfController as AdminPdfController;

use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\PdfController as GuruPdfController;

use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\PdfController as SiswaPdfController;

use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes (Laravel 12)
|--------------------------------------------------------------------------
*/

Route::middleware('web')->group(function () {

    // auth route (Breeze)
    require __DIR__.'/auth.php';

    // default root redirect
    Route::get('/', fn() => redirect('/login'))->name('home');

    // redirect setelah login berdasarkan role
    Route::get('/redirect', [RedirectRoleController::class, 'index'])
        ->middleware('auth')
        ->name('redirect.role');

    // ---------------- ADMIN ----------------
    Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::resource('kelas', KelasController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('schedules', ScheduleController::class);
        Route::resource('exams', ExamController::class);
        Route::resource('users', AdminUserController::class)->except(['show']);
        Route::get('pdf/jadwal-kelas/{kelas}', [AdminPdfController::class, 'jadwalKelas'])->name('pdf.jadwal.kelas');
        Route::get('pdf/jadwal-ujian', [AdminPdfController::class, 'jadwalUjian'])->name('pdf.jadwal.ujian');
        Route::get('notifications', [AdminNotificationController::class, 'index'])->name('notifications.index');
        Route::post('notifications/broadcast', [AdminNotificationController::class, 'broadcast'])->name('notifications.broadcast');
    });

    // ---------------- GURU ----------------
    Route::middleware(['auth','role:guru'])->prefix('guru')->name('guru.')->group(function () {
        Route::get('/', [GuruDashboard::class, 'index'])->name('dashboard');
        Route::get('pdf/jadwal', [GuruPdfController::class, 'jadwalGuru'])->name('pdf.jadwal');
    });

    // ---------------- SISWA ----------------
    Route::middleware(['auth','role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/', [SiswaDashboard::class, 'index'])->name('dashboard');
        Route::get('pdf/jadwal', [SiswaPdfController::class, 'jadwalSiswa'])->name('pdf.jadwal');
    });

    // ---------------- PROFILE ----------------
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/notifications', [ProfileController::class, 'notifications'])->name('profile.notifications');
        Route::post('/notifications/{id}/read', [ProfileController::class, 'markRead'])->name('profile.notifications.read');
    });

    // Guru: CRUD Tugas
    Route::middleware(['web', 'auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
        Route::resource('assignments', \App\Http\Controllers\Guru\AssignmentController::class);
        Route::get('assignments/{assignment}/submissions', [\App\Http\Controllers\Guru\AssignmentController::class, 'submissions'])
            ->name('assignments.submissions');
    });

    // Siswa: Lihat & Submit Tugas
    Route::middleware(['web', 'auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('assignments', [\App\Http\Controllers\Siswa\AssignmentController::class, 'index'])
            ->name('assignments.index');
        Route::post('assignments/{assignment}/submit', [\App\Http\Controllers\Siswa\AssignmentController::class, 'submit'])
            ->name('assignments.submit');
    });
});
