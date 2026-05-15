<?php

use App\Http\Controllers\MangaController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::livewire('/mangas', 'pages::index-manga')->name('mangas.index');
    Route::livewire('/mangas/create', 'pages::create-manga')->name('mangas.create');
    Route::livewire('/mangas/{id}', 'pages::show-manga')->name('mangas.show');
    Route::livewire('/mangas/{id}/edit', 'pages::edit-manga')->name('mangas.edit');
});
Route::get('/locale/{lang}', [MangaController::class, 'setLocale'])->name('locale.switch');

require __DIR__ . '/settings.php';
