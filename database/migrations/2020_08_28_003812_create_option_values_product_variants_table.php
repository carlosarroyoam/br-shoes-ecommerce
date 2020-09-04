<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionValuesProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_values_product_variants', function (Blueprint $table) {
            $table->unsignedBigInteger('option_value_id');
            $table->unsignedBigInteger('product_variant_id');
            $table->timestamps();

            $table->foreign('option_value_id')->references('id')->on('option_values')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_value_product_variants');
    }
}
