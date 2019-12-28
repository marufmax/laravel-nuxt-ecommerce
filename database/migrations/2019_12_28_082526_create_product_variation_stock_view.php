<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationStockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE VIEW product_variation_stock_view AS
            SELECT
            product_variations.product_id AS product_id,
            product_variations.id AS product_variation_id,
            COALESCE(SUM(stocks.quantity) - COALESCE(SUM(product_variation_order.quantity), 0), 0) as stock,
            CASE WHEN COALESCE(SUM(stocks.quantity) - COALESCE(SUM(product_variation_order.quantity), 0), 0) > 0
                THEN TRUE
                ELSE FALSE
            END in_stock
        FROM product_variations
        LEFT JOIN (
            SELECT stocks.product_variation_id as id,
            SUM(stocks.quantity) as quantity
            FROM stocks
            GROUP BY stocks.product_variation_id
        ) AS stocks USING (id)
        
        LEFT JOIN (
                SELECT
                    product_variation_order.product_variation_id as id,
                    SUM(product_variation_order.quantity) as quantity
                FROM product_variation_order
                GROUP BY product_variation_order.product_variation_id
        ) as product_variation_order USING (id)
        GROUP BY product_variations.id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DRPP VIEW IF EXISTS product_variation_stock_view');
    }
}
