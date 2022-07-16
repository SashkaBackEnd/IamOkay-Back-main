<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained();
            $table->integer('systolic_pressure')->default(0);
            $table->integer('diastolic_pressure')->default(0);
            $table->integer('pulse_average')->default(0);
            $table->integer('pulse_min')->default(0);
            $table->integer('pulse_max')->default(0);
            $table->integer('dispersion')->default(0);
            $table->float('saturation')->default(0);
            $table->integer('steps')->default(0);
            $table->integer('sleep')->default(0);
            $table->string('time')->nullable();
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
        Schema::dropIfExists('indicators');
    }
}
