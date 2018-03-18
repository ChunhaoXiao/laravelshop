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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('product_sn');
            $table->integer('category_id');
            $table->decimal('price')->default(0);
            $table->decimal('market_price')->default(0);
            $table->string('brief')->default('');
            $table->string('thumb')->default('');
            $table->integer('sales')->default(0);
            $table->tinyInteger('is_hot')->default(0);
            $table->tinyInteger('is_on_sale')->default(1);
            $table->integer('number')->default(0);
            $table->string('unit')->default('');
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
        Schema::dropIfExists('products');
    }
}
