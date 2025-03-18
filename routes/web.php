<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Tamu\TamuController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryBlogController;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('tamu.index');
});

Route::controller(TamuController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/reservation', 'reservation')->name('reservation');
    Route::get('/register', 'register')->name('register');
    Route::get('/login', 'login')->name('login');
    Route::get('/room', 'room')->name('room');
    Route::get('/blog/{id}', 'detail_blog')->name('blog.detail');
    Route::get('/search', 'search')->name('blog.search');
    Route::post('/contact/send-email', 'sendEmail')->name('send.email');
});

Route::controller(App\Http\Controllers\Tamu\AuthController::class)->group(function () {
    Route::post('/registerTamu', 'register')->name('registerTamu');
    Route::post('/loginTamu', 'login')->name('loginTamu');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(App\Http\Controllers\Admin\AuthController::class)->group(function () {
    Route::get('/welcome', 'halamanLogin')->name('halamanLogin');
    Route::post('/loginAdmin', 'login')->name('loginAdmin');
    Route::post('/logoutAdmin', 'logout')->name('logout_admin');
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard-admin/', [AdminController::class, 'index'])->name('dashboard.admin');

    Route::get('/dashboard-admin/configuration', [ConfigurationController::class, 'index'])->name('configuration.index');
    Route::post('/dashboard-admin/configuration', [ConfigurationController::class, 'createOrUpdate'])->name('configuration.store');

    Route::get('/dashboard-admin/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('/dashboard-admin/about', [AboutController::class, 'createOrUpdate'])->name('about.store');

    Route::resource('/dashboard-admin/slider', SliderController::class);

    Route::resource('/dashboard-admin/gallery', GalleryController::class);

    Route::resource('dashboard-admin/category_blog', CategoryBlogController::class);

    Route::resource('dashboard-admin/blog', BlogController::class);

    Route::resource('/dashboard-admin/history', HistoryController::class);
});
