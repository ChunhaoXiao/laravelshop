<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_sn');
            $table->integer('user_id');
            $table->string('order_status')->default('unpaied');
            $table->tinyInteger('shipping_status')->default(0);
            $table->tinyInteger('pay_status')->default(0);
            $table->string('user_note')->default('');
            //$table->string('consignee')->default('');
            $table->integer('address_id') ;
            //$table->string('mobile');
            $table->string('pay_name')->default('') ;
            $table->decimal('order_amount')->default(0);
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
        Schema::dropIfExists('order_infos');
    }
}
