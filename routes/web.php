<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang', [PageController::class, 'about'])->name('tentang');
Route::get('/edukasi', [PageController::class, 'education'])->name('edukasi');
Route::get('/peta-sebaran', [PageController::class, 'villages'])->name('peta-sebaran');
Route::get('/peta-sebaran.geojson', [PageController::class, 'villageMapData'])->name('peta-sebaran.geojson');
Route::view('/kontak', 'pages.contact')->name('kontak');

Route::get('/dokumentasi', [ActivityController::class, 'index'])->name('dokumentasi');
Route::get('/dokumentasi/{activity}', [ActivityController::class, 'show'])->name('dokumentasi.show');

Route::get('/berita', [ArticleController::class, 'index'])->name('berita.index');
Route::get('/berita/{article}', [ArticleController::class, 'show'])->name('berita.show');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
