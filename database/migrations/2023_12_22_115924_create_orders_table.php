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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique()->index();
            $table->uuid('customer_id');
            $table->foreign('customer_id')->references('uuid')->on('customers');
            $table->string('code')->index();
            $table->date('date')->index()->nullable();
            $table->string('address')->index();
            $table->decimal('subtotal', 20, 2)->index()->nullable();
            $table->decimal('discount', 20, 2)->index()->nullable();
            $table->decimal('total', 20, 2)->index()->nullable();
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
        Schema::dropIfExists('orders');
    }
};
