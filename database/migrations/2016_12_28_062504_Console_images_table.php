<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConsoleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('Console_images',function(Blueprint $table){
        $table->increments('id');
        $table->string('images')->nullable();
        $table->string('console_id')->nullable();
        $table->string('name')->nullable();
        $table->string('slug',2000)->nullable();
        $table->timestamps();
    });
 }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Console_images');
    }
}
