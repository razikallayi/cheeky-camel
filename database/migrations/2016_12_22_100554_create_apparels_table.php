<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApparelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apparels',function(Blueprint $table){
           $table->increments('id');
           $table->string('category_id')->nullable();
           $table->string('title')->nullable();
           $table->string('description',2000)->nullable();
         
           
           $table->integer('price')->nullable();
           $table->integer('discount')->nullable();
           $table->integer('quantity')->nullable();
           $table->string('new_product')->nullable();
            //$table->string('publish_in_menu');
            //$table->string('publish_in_shop');
           $table->string('slug',300);

            $table->string('theme',500)->nullable();
            $table->string('mechanic',1000)->nullable();
            $table->string('minimum_age',10)->nullable();
            $table->string('minimum_players',10)->nullable();
            $table->string('playing_time',50)->nullable();
            $table->string('publisher',500)->nullable();
            
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
        Schema::dropIfExists('apparels');
    }
}
