<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('health_facility_id')->constrained()->onUpdate('cascade');
            $table->foreignId('municipality_id')->constrained()->onUpdate('cascade');
            $table->string('icu_capacity')->nullable();
            $table->string('isolation_capacity')->nullable();
            $table->string('ward_capacity')->nullable();
            $table->string('occupied_icu')->nullable();
            $table->string('occupied_isolation')->nullable();
            $table->string('occupied_ward')->nullable();
            $table->string('max_ventilator')->nullable();
            $table->smallInteger('active_ventilator')
                ->unsigned()
                ->default(0);
            $table->string('log_name');
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
        Schema::dropIfExists('histories');
    }
}
