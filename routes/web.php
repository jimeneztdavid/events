<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect()->route('login');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

 Route::view('event', 'event')
    ->middleware(['auth', 'verified'])
    ->name('event'); 

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
