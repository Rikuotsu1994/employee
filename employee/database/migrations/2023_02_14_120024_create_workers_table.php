<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password');
            $table->string('name');
            $table->string('sex');
            $table->integer('age');
            $table->string('address');
            $table->string('department');
            $table->string('division');
            $table->date('hire_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('workers');
    }
};
