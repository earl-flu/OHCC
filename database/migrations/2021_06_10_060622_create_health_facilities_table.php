<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_facilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('municipality_id');

            $table->string('name');
            $table->string('barangay');
            $table->tinyInteger('level')->unsigned()->nullable();
            $table->smallInteger('ward_capacity')->unsigned()->default(0);
            $table->smallInteger('isolation_capacity')->unsigned()->default(0);
            $table->smallInteger('icu_capacity')->unsigned()->default(0);
            $table->smallInteger('max_ventilator')->unsigned()->default(0);
            $table->smallInteger('active_ventilator')
                ->unsigned()
                ->default(0);
            $table->smallInteger('occupied_ward')->unsigned()->default(0);
            $table->smallInteger('occupied_isolation')->unsigned()->default(0);
            $table->smallInteger('occupied_icu')->unsigned()->default(0);
            $table->string('contact')->nullable();
            $table->boolean('is_isolation_facility')->default(0);
            $table->boolean('is_infirmary')->default(0);
            $table->text('remarks')->nullable();

            $table->foreign('municipality_id')->references('id')->on('municipalities')->onUpdate('cascade');
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
        Schema::dropIfExists('health_facilities');
    }
}
