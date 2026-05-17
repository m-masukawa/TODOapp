<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * データの型変換ルールを定義
     */
    protected function casts(): array
    {
        return [
            // メール確認日時を日時型として扱う
            'email_verified_at' => 'datetime',
            // パスワードを自動的にハッシュ化して保存
            'password' => 'hashed',
        ];
    }

    /**
     * Todoモデルとの1対多のリレーションを定義
     */
    public function todos()
    {
        // 1人のユーザーに対して複数のTodoが紐付く関係
        return $this->hasMany(Todo::class);
    }
}