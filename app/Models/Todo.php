<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // ここを追記：保存していいカラムをホワイトリスト形式で指定
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'completed', // マイグレーションで決めた名
        'body',
    ];
}