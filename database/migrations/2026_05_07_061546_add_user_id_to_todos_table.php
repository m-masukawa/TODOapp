<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            // 1. usersテーブルのidと紐付くuser_idカラムを追加
            // constrained() をつけることで、存在しないユーザーIDが登録されないよう制限をかけます
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            // ロールバック（元に戻す）した時にカラムを削除するように設定
            $table->dropForeign(['user_id']); // 外部キー制約の解除
            $table->dropColumn('user_id');    // カラムの削除
        });
    }
};