<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voids
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
                $table->increments('id')->primary();//ID
                $table->tinyInteger('status');//状態
                $table->string('title',100);//タイトル
                $table->datetime('due_date')->nullable();//期日
                $table->string('assignee',20);//担当者
                $table->timestamp('created_at')->useCurrent();//作成日
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
