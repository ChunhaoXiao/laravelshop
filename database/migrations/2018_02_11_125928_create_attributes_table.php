<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->smallInteger('category_id');
            $table->tinyInteger('input_type')->default(0);
            $table->tinyInteger('attribute_type')->default(0);
            $table->string('attribute_value')->default('');
            $table->tinyInteger('attribute_index')->default(0);
            $table->smallInteger('sort_order')->default(0);
            $table->tinyInteger('group')->default(0);
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
        Schema::dropIfExists('attributes');
    }
}
