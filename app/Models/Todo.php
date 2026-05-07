<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // ここを追記：保存していいカラムをホワイトリスト形式で指定します
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'completed', // マイグレーションで決めた名前（is_doneなど）に合わせてください
    ];
}