<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToIndicator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicators', function (Blueprint $table) {
            $table->float('accelerometer_x')->default(0);
            $table->float('accelerometer_y')->default(0);
            $table->float('accelerometer_z')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indicators', function (Blueprint $table) {
            $table->dropColumn('accelerometer_x');
            $table->dropColumn('accelerometer_y');
            $table->dropColumn('accelerometer_z');
        });
    }
}
