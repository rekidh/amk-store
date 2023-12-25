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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique()->index();
            $table->string('name')->index();
            $table->decimal('price', 20, 2)->index();
            $table->string('description')->index();
            $table->uuid('category_id');
            $table->timestamps();

            $table->foreign('category_id')->references('uuid')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
