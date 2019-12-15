<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->index();
            $table->string('name');
            $table->integer('price')->nullable();
            $table->unsignedInteger('type_id')->index();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
            
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
    
            $table->foreign('type_id')
                ->references('id')
                ->on('product_variation_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
}
