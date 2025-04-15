<?php

use App\Models\Commande;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
// Route::get('/commandes', function () {
//     return view('commandes');
// })->name('commandes');
Route::get('/commandes', function () {
    $commandes = Commande::with(['client', 'modeReglement', 'details.article'])
                ->latest()
                ->paginate(5);

    return view('commandes', compact('commandes'));
})->name('commandes');
