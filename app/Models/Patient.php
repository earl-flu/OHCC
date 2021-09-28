<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Patient extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];

    //log changes to all the unguarded attributes of the model
    // protected static $logUnguarded = true;
    protected static $logAttributes = ['*', 'healthFacility.name', 'patientStatus.name'];

    //Logging only the changed attributes
    protected static $logOnlyDirty = true;

    // /Specifying a log for model
    protected static $logName = 'patient_log';

    const WARD_BED = 1;
    const ISOLATION_BED = 2;
    const ICU_BED = 3;
    const STATUS_ACTIVE = 1;

    public const CASE_DEFINITIONS = [
        'probable' => 1,
        'suspected' => 2,
        'confirmed' => 3
    ];

    public const SYMPTOMS_CLASSIFICATIONS = [
        'asymptomatic' => 1,
        'mild' => 2,
        'moderate' => 3,
        'severe' => 4,
        'critical' => 5,
    ];

    public const GENDER = [
        'male' => 1,
        'female' => 2,
    ];

    public const BEDS = [
        'ward' => 1,
        'isolation' => 2,
        'icu' => 3
    ];

    public function healthFacility()
    {
        return $this->belongsTo(HealthFacility::class);
    }

    public function patientStatus()
    {
        return $this->belongsTo(PatientStatus::class);
    }

    /**
     * Get the case definition of a patient
     * @return string
     */
    public function getCaseDefinition()
    {
        return array_search($this->case_definition_id, self::CASE_DEFINITIONS);
    }

    /**
     * Get the case symptoms classification of a patient
     * @return string
     */
    public function getSymptomsClassification()
    {
        return array_search($this->symptoms_classification_id, self::SYMPTOMS_CLASSIFICATIONS);
    }

    public function isMild()
    {
        return $this->symptoms_classification_id === self::SYMPTOMS_CLASSIFICATIONS['mild'];
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $bedtype - type of bed
     * @return integer
     */
    public function scopeTotalActivePatientIn($query, $bedtype)
    {
        $count =  $query->where('bed_id', $bedtype)->where('patient_status_id', self::STATUS_ACTIVE)->get()->count();
        return $count;
    }
}
