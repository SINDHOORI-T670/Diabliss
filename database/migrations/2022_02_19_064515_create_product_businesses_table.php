<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_businesses', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->float('sale_price');
            $table->float('purchase_price');
            $table->float('shiping_cost');
            $table->integer('purchase_limit');
            $table->integer('barcode');
            $table->float('discount');
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
        Schema::dropIfExists('product_businesses');
    }
}
