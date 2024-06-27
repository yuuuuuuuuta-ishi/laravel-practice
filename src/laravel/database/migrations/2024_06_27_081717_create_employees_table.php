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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id')->primary()->comment('id');
            $table->char('employee_code', 4)->nullable()->unique()->comment('社員コード');
            $table->string('password', 50)->nullable()->comment('パスワード');
            $table->string('name', 56)->nullable()->comment('社員名');
            $table->timestamp('created_at', 6)->nullable()->comment('作成日時');
            $table->timestamp('updated_at', 6)->nullable()->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
