<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCustomerChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_customer_choices', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->integer('type')->nullable();
            $table->integer('required')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('minimum')->nullable();
            $table->integer('maximum')->nullable();
            $table->string('option_values')->nullable();
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
        Schema::dropIfExists('product_customer_choices');
    }
}
