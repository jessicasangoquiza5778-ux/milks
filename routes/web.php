<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\AdminController;

// Ruta principal: El mapa
Route::get('/', [MapController::class, 'index'])->name('map');

// Ruta de la ficha de la tienda
Route::get('/tienda/{id}', [EstablishmentController::class, 'show']);

// Rutas protegidas para usuarios logueados
Route::middleware(['auth'])->group(function () {
    
    // Catálogo de productos
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/search', [ProductController::class, 'search'])->name('products.search');

    // Seguimiento de oportunidades
    Route::get('/opportunities', [OpportunityController::class, 'index'])->name('opportunities.index');
    Route::post('/opportunities', [OpportunityController::class, 'store'])->name('opportunities.store');
    Route::put('/opportunities/{opportunity}', [OpportunityController::class, 'update'])->name('opportunities.update');

    // Rutas del Panel de Administrador
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::put('/admin/verificar/{id}', [AdminController::class, 'verificar'])->name('admin.verificar');

    // El Dashboard ahora te manda directo al mapa para no perder tiempo
    Route::get('/dashboard', function () {
        return redirect()->route('map');
    })->name('dashboard');
});

// Rutas de autenticación
require __DIR__.'/auth.php';
