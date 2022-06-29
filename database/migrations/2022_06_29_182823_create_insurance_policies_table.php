<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_policies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text( 'description')->nullable();
            $table->text( 'title');
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
        Schema::dropIfExists('insurance_policies');
    }
}
