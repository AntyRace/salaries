<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->unsignedInteger('salary');
            $table->unsignedInteger('perk');
            $table->timestamp('salary_date');
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unique(['employee_id', 'salary_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
