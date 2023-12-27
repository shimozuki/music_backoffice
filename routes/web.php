<?php

use App\Http\Controllers\AbourController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SejarahumumCOntroller;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });


Route::get('/about', function() {
    return view('about', [
        'name' => 'John Doe',
        'email' => 'example@email.com',
        'img' => 'prog.jpg'
    ]);
});

// All posts page
Route::get('/posts', [PostController::class, 'index']);

// Single Post Page
Route::get('/posts/{post:slug}', [PostController::class, 'show']);


// All Categories
Route::get('/categories', function(Category $category) {
    return view('categories', [
        'categories' => $category->all(),
    ]);
});

// Login
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// Check slug with fetch URI
// Route::get('/dashboard/post/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::post('/dashboard/post/create',[DashboardPostController::class, 'store'])->middleware('auth');
// Dashboard (for authenticate users)
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

// Admin category
Route::resource('/dashboard/categories', AdminCategoryController::class)
->parameters(['categories' => 'category:slug'])->except('show')->middleware('IsAdmin');

Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('auth');


// sejarah umum
Route::get('/dashboard/sejarah_umum/index', [SejarahumumCOntroller::class, 'index'])->name('sejarah_umum.index');
Route::get('/dashboard/sejarah_umum/edit/{id}', [SejarahumumCOntroller::class, 'edit']);
Route::patch('/dashboard/sejarah_umum/update/{id}', [SejarahumumController::class, 'update'])->name('sejarah_umum.update');
// about
Route::get('/dashboard/about/index', [AbourController::class, 'index'])->name('about.index');
Route::get('/dashboard/about/edit/{id}', [AbourController::class, 'edit']);
Route::patch('/dashboard/about/update/{id}', [AbourController::class, 'update'])->name('about.update');
Route::post('/dashboard/update-status/{id}', [DashboardPostController::class, 'updateStatus']);

