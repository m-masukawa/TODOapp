<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ユーザー新規登録画面の表示用ルート
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// ユーザー新規登録のデータ送信先ルート
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// 認証済みユーザーのTodo一覧表示
Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
// 新規Todoデータの保存処理
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');

// ログイン画面の表示用ルート
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// ログイン認証の実行ルート
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
// セッション終了（ログアウト）処理
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 指定したTodoデータの削除処理
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
// 特定のTodoを編集するための入力画面表示
Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');
// 既存Todoデータの更新実行処理
Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');