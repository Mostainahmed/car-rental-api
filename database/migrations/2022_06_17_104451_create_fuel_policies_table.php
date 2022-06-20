<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_policies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string( 'title');
            $table->decimal( 'distance',8,2)->nullable();
            $table->decimal('cost',8,2)->default(0.00);
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
        Schema::dropIfExists('fuel_policies');
    }
}
