<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes pour la gestion des produits
Route::resource('products', ProductController::class)->except(['show']);

// Redirection de l'ancienne URL vers la nouvelle page d'accueil
Route::get('/welcome', function () {
    return redirect('/');
});
