<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Realizar cambios
        Schema::create('products',function(Blueprint $tabla){
          $tabla->increments('id');
          $tabla->timestamps();
          $tabla->integer('user_id')->unsigned()->index();
          $tabla->string('title');
          $tabla->text('description');
          $tabla->decimal('princing','9','2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('products');
    }
}
