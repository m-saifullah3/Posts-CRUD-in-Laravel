<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\DB;
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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('show_posts');
Route::get('/post/create', [PostController::class, 'create'])->name('create_post');
Route::post('/post/create', [PostController::class, 'store']);

Route::get('/post/{post}/show', [PostController::class, 'show'])->name('single_post');

Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('edit_post');
Route::post('/post/{post}/edit', [PostController::class, 'update']);

Route::post('/post/{post}/delete', [PostController::class, 'destroy'])->name('delete_post');
