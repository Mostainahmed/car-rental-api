<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text( 'description');
            $table->decimal( 'cost',8,2)->nullable();
            $table->enum('cost_unit', ['euro', 'dollar'])->default('euro');
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
        Schema::dropIfExists('rental_types');
    }
}
