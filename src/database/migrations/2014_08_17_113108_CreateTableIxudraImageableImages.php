<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIxudraImageableImages extends Migration {

    public function up()
    {
        Schema::create('images', function(Blueprint $table) {
            $table->increments('id');
            $table->string('file_name', 32)->nullable()->default(null);
            $table->string('title', 128)->nullable()->default(null);
            $table->string('alt', 256)->nullable()->default(null);
            $table->integer('imageable_id')->nullable()->default(null);
            $table->string('imageable_type', 32)->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }

}
