<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_specifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string( 'title');
            $table->decimal('cost', 8, 2)->default(0.00);
            $table->boolean('is_applied_per_km')->default(false);
            $table->decimal('minimum_travel_distance', 8, 2)->nullable();
            $table->boolean('is_minimum_travel_distance_applied')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('car_specifications');
    }
}
