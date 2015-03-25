<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIxudraImageableImages extends Migration {

    public function up()
    {
        Schema::create('images', function(Blueprint $table) {
            $table->increments('id');
            $table->string('file_name', 32);
            $table->string('title', 128);
            $table->string('alt', 256);
            $table->integer('imageable_id');
            $table->string('imageable_type', 32);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }

}
