<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApparelImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('apparel_images',function(Blueprint $table){
        $table->increments('id');
        $table->string('images')->nullable();
        $table->string('apparel_id')->nullable();
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
        Schema::dropIfExists('apparel_images');
    }
}
