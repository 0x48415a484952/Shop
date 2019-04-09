<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMylistProductVariationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('mylist_product_variation', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mylist_id');
            $table->foreign('mylist_id')->references('id')->on('mylists');
            $table->unsignedInteger('product_variation_id');
            $table->foreign('product_variation_id')->references('id')->on('product_variations');
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
        Schema::dropIfExists('mylist_products');
    }
}
