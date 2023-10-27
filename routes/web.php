<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DepartmentController;

/* These are the routes accessible to all users despite any position */
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'registration'])->name('registration');

Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile/{id}', [AuthController::class, 'profile'])->name('profile');
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password.post');
});

/* For the route group below, a middleware CheckPosition is created and added to the Kernel.php in app/http/ location */
Route::middleware(['auth', 'check.position:manager,staff'])->group(function () {
    Route::get('/expense', [ExpenseController::class, 'showExpenseForm'])->name('expense');
    Route::post('/expense', [ExpenseController::class, 'storeExpenseData'])->name('expense.store');
});

/* Allow access for manager, hod, and staff */
Route::middleware(['auth', 'check.position:manager,staff,hod'])->group(function () {
    Route::get('/expense_details', [ExpenseController::class, 'showExpenseDetails'])->name('expense.details');
});

/* Allow access for manager, hod, and system_manager */
Route::middleware(['auth', 'check.position:manager,hod,system_manager'])->group(function () {
    Route::get('/detail/{id}', [ExpenseController::class, 'details'])->name('expense.details.id');
    Route::post('/approve', [ExpenseController::class, 'approve'])->name('expense.approve');
    Route::post('/reject', [ExpenseController::class, 'reject'])->name('expense.reject');
});

/* Allow access for system_manager and hod */
Route::middleware(['auth', 'check.position:system_manager,hod'])->group(function () {
    Route::get('/user-management', [UserManagementController::class, 'userManagement'])->name('user-management');
});

/* Allow access for system_manager */
Route::middleware(['auth', 'check.position:system_manager'])->group(function () {
    Route::get('/department', [DepartmentController::class, 'index'])->name('department');
    Route::post('/department', [DepartmentController::class, 'addDepartment'])->name('department.add');
    Route::get('/department/remove/{id}', [DepartmentController::class, 'remove'])->name('department.remove');

    Route::get('/promote-hod/{id}', [UserManagementController::class, 'promoteHOD'])->name('promote-hod');
    Route::get('/demote-manager/{id}', [UserManagementController::class, 'showDemoteForm'])->name('demote-manager');
    Route::post('/demote-manager/{id}', [UserManagementController::class, 'demoteHOD'])->name('demote-manager.post');

    Route::get('/master-expense', [ExpenseController::class, 'masterExpense'])->name('master-expense');
    Route::get('/delete-expense/{id}', [ExpenseController::class, 'deleteExpense'])->name('delete-expense');
    Route::get('/reject-expense/{id}', [ExpenseController::class, 'rejectExpense'])->name('reject-expense');
});

/* Allow access for hod */
Route::middleware(['auth', 'check.position:hod'])->group(function () {
    Route::get('/promote-manager/{id}', [UserManagementController::class, 'promoteManager'])->name('promote-manager');
    Route::get('/assign-manager/{id}', [UserManagementController::class, 'showAssignForm'])->name('assign-manager');
    Route::post('/assign-manager/{id}', [UserManagementController::class, 'assignManager'])->name('assign-manager.post');
    Route::post('/demote', [UserManagementController::class, 'demote'])->name('demote');
});

Route::put('/update-expense/{id}', [ExpenseController::class, 'updateExpense'])->name('update-expense.put');

Route::middleware(['auth'])->group(function () {
    Route::get('/edit/{id}', [ExpenseController::class, 'editExpense'])->name('edit-expense');
    Route::get('/promote/{id}', [UserManagementController::class, 'promote'])->name('promote');
    Route::post('/assign-hod', [UserManagementController::class, 'assign'])->name('assign-hod');
});
