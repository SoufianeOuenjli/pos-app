<?php

use App\Models\Commande;
use Illuminate\Support\Facades\Route;
use Livewire\WithPagination;

Route::get('/', function () {
    return view('welcome');
})->name('home');
// Route::get('/commandes', function () {
//     return view('commandes');
// })->name('commandes');

Route::get('/commandes', function () {

    return view('commandes');
})->name('commandes');
