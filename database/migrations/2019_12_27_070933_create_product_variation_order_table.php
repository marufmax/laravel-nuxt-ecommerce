<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variation_order', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->index();
            $table->unsignedInteger('production_variation_id')->index();
            $table->unsignedInteger('quantity');
            $table->timestamps();
            
            $table->foreign('order_id')
                ->references('id')
                ->on('products');
            
            $table->foreign('production_variation_id')
                ->references('id')
                ->on('product_variations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variation_order');
    }
}
