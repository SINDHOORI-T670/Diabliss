<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchWorkingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_working_hours', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id');
            $table->enum('day', [
                'ALL',
                'SUN',
                'MON',
                'TUE',
                'WED',
                'THU',
                'FRI',
                'SAT'
            ])->default('ALL')->nullable();
            $table->string('work_start_time');
            $table->string('work_end_time');
            $table->string('break_start_time');
            $table->string('break_end_time');
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
        Schema::dropIfExists('branch_working_hours');
    }
}
