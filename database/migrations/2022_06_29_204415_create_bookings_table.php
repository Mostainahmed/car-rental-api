<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('car_id');
            $table->double('total_cost')->nullable();
            $table->string('pickup_location')->nullable();
            $table->string('arrival_location')->nullable();
            $table->double('pickup_lat')->nullable();
            $table->double('pickup_lng')->nullable();
            $table->double('arrival_lat')->nullable();
            $table->double('arrival_lng')->nullable();
            $table->uuid('fuel_policy_id')->nullable();
            $table->uuid('rental_type_id')->nullable();
            $table->uuid('car_specification_id')->nullable();
            $table->enum('travel_status', ['ONGOING', 'BOOKED', 'FINISHED', 'PARKED'])->default('BOOKED');
            $table->uuid('insurance_policy_id')->nullable();
            $table->date('date_of_travel');
            $table->date('booked_date');
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
        Schema::dropIfExists('bookings');
    }
}
