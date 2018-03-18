<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductattributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productattributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('attribute_id');
            $table->string('attribute_value')->default('');
            $table->string('attribute_price')->default('');
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
        Schema::dropIfExists('productattributes');
    }
}
