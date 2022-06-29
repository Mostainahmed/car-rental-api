<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->uuid('brand_id')->nullable();
            $table->uuid('car_type_id')->nullable();
            $table->uuid('supplier_id')->nullable();
            $table->enum('transmission', ['AUTO', 'MANUAL'])->default('AUTO');
            $table->text('images')->nullable();
            $table->enum('status', ['INACTIVE', 'BOOKED', 'BUSY'])->default('INACTIVE');
            $table->double('current_lat')->nullable();
            $table->double('current_lng')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('cars');
    }
}
