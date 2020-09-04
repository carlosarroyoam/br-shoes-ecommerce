<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingBagItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_bag_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_variant_id');
            $table->unsignedBigInteger('shopping_bag_id');
            $table->unsignedSmallInteger('quantity');
            $table->timestamps();

            $table->foreign('product_variant_id')->references('id')->on('product_variants');
            $table->foreign('shopping_bag_id')->references('id')->on('shopping_bag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_bag_items');
    }
}
