<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('album_id')->nullable();
            $table->unsignedBigInteger('singer_id')->nullable();
            $table->string('title', 100);
            $table->string('play_time', 10);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('created_by');
            $table->string('updated_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
