<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_facility_id')->constrained()->onUpdate('cascade');
            $table->foreignId('patient_status_id')->constrained()->onUpdate('cascade');
            $table->foreignId('municipality_id')->constrained()->onUpdate('cascade');
            
            $table->string('barangay');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('patient_number')->nullable();
            $table->tinyInteger('age')->unsigned();
            $table->tinyInteger('gender_id'); //const
            $table->tinyInteger('case_definition_id'); //const
            $table->tinyInteger('symptoms_classification_id'); //const
            $table->tinyInteger('bed_id'); //const
            $table->text('remarks')->nullable();
            $table->date('date_admitted');
            $table->date('date_discharged')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
