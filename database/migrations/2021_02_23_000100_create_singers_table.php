<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingersTable extends Migration
{
    public function up()
    {
        Schema::create('singers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('created_by');
            $table->string('updated_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('singers');
    }
}
