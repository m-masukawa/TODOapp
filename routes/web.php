<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// 新規登録画面の表示
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// 新規登録処理
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');

// ログイン画面の表示
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// ログイン処理
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
// ログアウト処理
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Todoを削除するルート
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
// 編集画面を表示
Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');
// 更新を実行
Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');