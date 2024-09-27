<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\FormulaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Rotas para Materiais
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index'); // Lista os materiais
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create'); // Formulário para criar material
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store'); // Salva o material
    Route::get('/materials/{material}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/materials/{material}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');

// Rotas para Fórmulas
    Route::get('/formulas', [FormulaController::class, 'index'])->name('formulas.index'); // Lista as fórmulas
    Route::get('/formulas/create', [FormulaController::class, 'create'])->name('formulas.create'); // Formulário para criar fórmula
    Route::post('/formulas', [FormulaController::class, 'store'])->name('formulas.store'); // Salva a fórmula
    Route::get('/formulas/{id}/edit', [FormulaController::class, 'edit'])->name('formulas.edit'); // Editar fórmula
    Route::put('/formulas/{id}', [FormulaController::class, 'update'])->name('formulas.update'); // Atualizar fórmula
    Route::delete('/formulas/{id}', [FormulaController::class, 'destroy'])->name('formulas.destroy'); // Deletar fórmula
});




require __DIR__.'/auth.php';
