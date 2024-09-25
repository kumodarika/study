<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAssigneesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('assignees', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name'); // 担当者の名前
        });

        DB::table('assignees')->insert([
            ['name' => '忠田'],
            ['name' => '坂本'],
            ['name' => '佐藤'],
            ['name' => '口分田'],
            ['name' => '北村'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('assignees');
    }
};
