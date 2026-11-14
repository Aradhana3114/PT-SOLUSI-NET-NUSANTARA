<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

Route::get('/', [SiteController::class, 'home'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/profil-saya', [SiteController::class, 'userProfile'])->name('user.profile');
    Route::put('/profil-saya', [SiteController::class, 'updateProfile'])->name('user.profile.update');
});
Route::get('/profile-perusahaan', [SiteController::class, 'profile'])->name('profile');
Route::get('/jasa', [SiteController::class, 'services'])->name('services');
Route::middleware('auth')->group(function () {
    Route::get('/jasa/{service}/pesan', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/jasa/{service}/pesan', [OrderController::class, 'store'])->name('orders.store');
});
Route::get('/gallery', [SiteController::class, 'gallery'])->name('gallery');
Route::get('/artikel', [SiteController::class, 'articles'])->name('articles');
Route::get('/artikel/{slug}', [SiteController::class, 'article'])->name('article');
Route::get('/kontak-kami', [SiteController::class, 'contact'])->name('contact');

Route::get('/storage/{path}', function (string $path) {
    abort_if(str_contains($path, '..'), 404);
    abort_unless(Storage::disk('public')->exists($path), 404);

    return response()->file(Storage::disk('public')->path($path));
})->where('path', '.*')->name('storage.fallback');

Route::get('/cek-upload', function () {
    abort_unless(app()->environment('local'), 404);

    $link = public_path('storage');
    $privateTmp = storage_path('app/private/livewire-tmp');

    return response()->json([
        'php_version' => PHP_VERSION,
        'php_ini_dipakai' => php_ini_loaded_file(),
        'server_api' => PHP_SAPI,
        'file_uploads' => ini_get('file_uploads'),
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'post_max_size' => ini_get('post_max_size'),
        'upload_tmp_dir' => ini_get('upload_tmp_dir') ?: sys_get_temp_dir(),
        'upload_tmp_dir_writable' => is_writable(ini_get('upload_tmp_dir') ?: sys_get_temp_dir()),
        'ext_fileinfo' => extension_loaded('fileinfo'),
        'ext_gd' => extension_loaded('gd'),
        'ext_pdo_mysql' => extension_loaded('pdo_mysql'),
        'public_storage_link_ada' => file_exists($link),
        'public_storage_is_link' => is_link($link),
        'storage_app_public_writable' => is_writable(storage_path('app/public')),
        'storage_app_private_writable' => is_writable(storage_path('app/private')),
        'livewire_tmp_ada' => is_dir($privateTmp),
        'livewire_disk' => config('livewire.temporary_file_upload.disk'),
        'app_url' => config('app.url'),
        'request_root' => request()->root(),
        'kolom_latitude_ada' => Schema::hasColumn('site_settings', 'latitude'),
    ], 200, [], JSON_PRETTY_PRINT);
});
