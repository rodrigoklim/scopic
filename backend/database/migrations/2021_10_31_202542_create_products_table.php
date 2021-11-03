<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->timestamps();
            $table->string('product');
            $table->string('style');
            $table->text('description');
            $table->decimal('auction_price');
            $table->timestamp('start', $precision = 0);
            $table->timestamp('end', $precision = 0);
            $table->string('image_path1');
            $table->string('image_path2');
            $table->string('image_path3');
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