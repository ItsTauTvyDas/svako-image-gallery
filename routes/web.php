<?php

use App\Livewire\Dashboard\AccountDataReport;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.main');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'dashboard/settings/profile');

    Route::get('dashboard/data-report', AccountDataReport::class)->name('dashboard.data-report');

    Route::get('dashboard/settings/profile', Profile::class)->name('settings.profile');
    Route::get('dashboard/settings/password', Password::class)->name('settings.password');
    Route::get('dashboard/settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
