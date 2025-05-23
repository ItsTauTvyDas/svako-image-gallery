<?php

use App\Http\Controllers\PDFController;
use App\Livewire\Dashboard\AccountDataReport;
use App\Livewire\Pages\Gallery;
use App\Livewire\Pages\GalleryPost;
use App\Livewire\Pages\UploadRules;
use App\Livewire\Pages\UserProfile;
use App\Livewire\Pages\Users;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::middleware(['verified'])->group(function () {
    Route::get('/', Gallery::class)->name('home');
    Route::get('/upload-rules', UploadRules::class)->name('upload-rules');
    Route::get('/users', Users::class)->name('users-list');
    Route::get('/users/{id}', UserProfile::class)->name('profile');
    Route::get('/gallery/posts/{id}', GalleryPost::class)->name('gallery-post');

    Route::prefix('dashboard/data-report/pdf')->group(function () {
        Route::get('html-preview', [PDFController::class, 'HTMLPreview'])->name('pdf.preview.html');
        Route::get('file-preview', [PDFController::class, 'preview'])->name('pdf.preview.file');
        Route::get('download', [PDFController::class, 'download'])->name('pdf.download');
    });
});

Route::prefix('dashboard')->group(function () {
    Route::view('/', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::redirect('settings', 'dashboard/settings/profile');

        Route::get('data-report', AccountDataReport::class)->name('dashboard.data-report');

        Route::get('settings/profile', Profile::class)->name('settings.profile');
        Route::get('settings/password', Password::class)->name('settings.password');
        Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    });
});

require __DIR__.'/auth.php';
