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
            $table->string('id');
            $table->string('title');
            $table->string('title_ar');
            $table->integer('cat_id');
            $table->integer('sub_cat_id');
            $table->integer('order');
            $table->integer('prep_time');
            $table->string('prep_type');
            $table->string('unit');
            $table->string('link');
            $table->longText('description');
            $table->longText('description_ar');
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
