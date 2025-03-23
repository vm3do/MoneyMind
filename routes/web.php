<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatisticController;
use App\Mail\Email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Catch_;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('user.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/dashboard/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/dashboard/category/destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

Route::middleware(['auth', 'is_user'])->group(function () {
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::put('/expenses/update/{expense}', [ExpenseController::class, 'update']);
    Route::delete('/expenses/delete/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

    Route::post('/expenses/alert', [AlertController::class, 'store'])->name('alert.store');
    Route::put('/expenses/alert/{id}', [AlertController::class, 'update'])->name('alert.update');

    Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');
    Route::put('/statistics/update/{id}', [StatisticController::class, 'update']);

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
