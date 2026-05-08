<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // 一括でのデータ保存を許可するカラムの定義
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'completed',
        'body',
    ];
}