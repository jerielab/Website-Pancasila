<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\ReflectionController;
use App\Http\Controllers\Admin\PancasilaAdminController;
use Illuminate\Support\Facades\Route;

// Visitor routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/quiz', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/results/{id}', [ResultsController::class, 'show'])->name('results.show');
Route::post('/reflections', [ReflectionController::class, 'store'])->name('reflections.store');

// Admin routes
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [PancasilaAdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/results', [PancasilaAdminController::class, 'results'])->name('results');
    Route::get('/results/{id}', [PancasilaAdminController::class, 'showResult'])->name('results.show');
    Route::delete('/results/{id}', [PancasilaAdminController::class, 'destroyResult'])->name('results.destroy');
    Route::get('/reflections', [PancasilaAdminController::class, 'reflections'])->name('reflections');
    Route::put('/reflections/{reflection}/approve', [PancasilaAdminController::class, 'approveReflection'])->name('reflections.approve');
    Route::delete('/reflections/{reflection}', [PancasilaAdminController::class, 'deleteReflection'])->name('reflections.delete');
});

require __DIR__.'/auth.php';
