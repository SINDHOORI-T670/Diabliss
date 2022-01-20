<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchOrderSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_order_settings', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id');
            $table->boolean('busy');
            $table->boolean('pickup');
            $table->boolean('schedule');
            $table->boolean('delivery');
            $table->integer('max_order_period');
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
        Schema::dropIfExists('branch_order_settings');
    }
}
