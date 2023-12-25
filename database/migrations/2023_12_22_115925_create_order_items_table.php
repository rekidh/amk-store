<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique()->index();
            $table->uuid('order_id');
            $table->uuid('item_id');
            $table->foreign('order_id')->references('uuid')->on('orders');
            $table->foreign('item_id')->references('uuid')->on('items');
            $table->integer('qty')->index();
            $table->decimal('price', 20, 2)->index();
            $table->decimal('discount')->index();
            $table->decimal('total', 20, 2)->index();
            $table->string('note')->index();
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
        Schema::dropIfExists('order_items');
    }
};
