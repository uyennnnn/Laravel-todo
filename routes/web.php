<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\SocialController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::put('/updateTodo', [App\Http\Controllers\HomeController::class, 'updateTodo'])->name('todos.update');
Route::delete('/todos/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('todos.destroy');
Route::get('/todos/create', [App\Http\Controllers\HomeController::class, 'create'])->name('todos.create');
Route::post('/todos', [App\Http\Controllers\HomeController::class, 'store'])->name('todos.store');


Route::get('admin', [AdminController::class, 'index'])->middleware(['auth','role:admin']);
Route::get('admin/user',[AdminController::class, 'user'])->name('admin.users')->middleware(['auth','role:admin']);
Route::get('admin/user/edits/{id}',[AdminController::class, 'userEdit'])->name('admin.users.edit')->middleware(['auth','role:admin']);
Route::put('/admin/users/{id}', [AdminController::class, 'userUpdate'])->name('admin.users.update')->middleware(['auth','role:admin']);
Route::get('/admin/users/{id}', [AdminController::class, 'userShow'])->name('admin.users.show');


Route::delete('admin/user/destroy/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy')->middleware(['auth','role:admin']);

Route::get('/redirect-google', [SocialController::class, 'redirectGoogle'])->name('redirectGoogle');
Route::get('/google_callback', [SocialController::class, 'processGoogleLogin']);
