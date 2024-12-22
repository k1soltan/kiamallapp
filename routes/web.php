<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\UserBalanceController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\EventTicketController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\TaskController;

// Main landing page
Route::get('/', function () {
    return view('welcome');
});

// Redirect authenticated users to the dynamic dashboard
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Admin-specific routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // User management
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/general-data', [UserController::class, 'generalUserData'])
        ->middleware('permission:general user data')
        ->name('users.generalUserData');

    // Role management
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::get('roles/{role}/permissions', [RoleController::class, 'viewPermissions'])->name('roles.viewPermissions');
    Route::post('roles/{role}/permissions/assign', [RoleController::class, 'handleAssignPermissions'])->name('roles.assignPermissions');
    Route::post('roles/{role}/permissions/remove', [RoleController::class, 'removePermissionFromRole'])->name('roles.removePermission');

    // Logs
    Route::get('/logs', [LogsController::class, 'logs'])
        ->middleware('permission:view logs')
        ->name('logs.index');
    Route::get('/logs/export', [LogsController::class, 'exportLogs'])
        ->middleware('permission:view logs')
        ->name('logs.export');

// Admin-specific Balance Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('balances', [UserBalanceController::class, 'index'])->name('balances.index'); // Admin index
    Route::get('balances/create', [UserBalanceController::class, 'create'])->name('balances.create'); // Create balance
    Route::post('balances', [UserBalanceController::class, 'store'])->name('balances.store'); // Store balance
    Route::get('balances/{balance}/edit', [UserBalanceController::class, 'edit'])->name('balances.edit'); // Edit balance
    Route::put('balances/{balance}', [UserBalanceController::class, 'update'])->name('balances.update'); // Update balance
    Route::delete('balances/{balance}', [UserBalanceController::class, 'destroy'])->name('balances.destroy'); // Delete balance
});

    // Event management
    Route::get('/events', [CalendarController::class, 'showEvents'])->name('events.index');
    Route::get('/events/create', [CalendarController::class, 'create'])->name('events.create');
    Route::post('/events', [CalendarController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [EventTicketController::class, 'show'])->name('events.show');

    // Tickets
    Route::get('/tickets/reserved', [EventTicketController::class, 'reservedTickets'])->name('tickets.reserved');
    Route::delete('/tickets/{ticket}', [EventTicketController::class, 'deleteTicket'])->name('tickets.delete');
});

// User-specific routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/balances/create', [UserBalanceController::class, 'create'])->name('balances.create');
    Route::post('/balances', [UserBalanceController::class, 'store'])->name('balances.store');
});


// User-specific Balance and Transaction Routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('transactions', [UserBalanceController::class, 'showTransactions'])->name('transactions.index'); // User's transaction history
    Route::post('balances/add/{id}', [UserBalanceController::class, 'add'])->name('balances.add');
    Route::post('balances/reduce/{id}', [UserBalanceController::class, 'reduce'])->name('balances.reduce');
});
// Tasks
Route::middleware(['auth'])->resource('tasks', TaskController::class)->except(['show']);

// Fallback route
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
