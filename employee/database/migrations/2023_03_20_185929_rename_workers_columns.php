<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('workers', function ($table) {
            $table->renameColumn('id', 'worker_id');
            $table->renameColumn('name', 'worker_name');
        });
    }

    public function down()
    {
        Schema::table('workers', function ($table) {
            $table->renameColumn('worker_id', 'id');
            $table->renameColumn('worker_name', 'name');
        });
    }
};
