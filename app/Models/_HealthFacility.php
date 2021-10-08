<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class HealthFacility extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = ['id'];

    //log changes to all the unguarded attributes of the model
    protected static $logUnguarded = true;

    // Specifying a log for model
    protected static $logName = 'health_facility_log';

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    // public function getMunicipalityName(){
    //     return $this->municipality->name;
    // }


    /**
     * ID's
     * ward: 1
     * isolation: 2
     * icu: 3
     */

    //returns number
    public function getOccupiedWard()
    {
        return $this->patients
            ->where('bed_id', Patient::WARD_BED)
            ->where('patient_status_id', Patient::STATUS_ACTIVE)
            ->count();
    }

    //returns number
    public function getOccupiedIsolation()
    {
        return $this->patients
            ->where('bed_id', Patient::ISOLATION_BED)
            ->where('patient_status_id', Patient::STATUS_ACTIVE)->count();
    }

    //returns number
    public function getOccupiedIcu()
    {
        return $this->patients
            ->where('bed_id', Patient::ICU_BED)
            ->where('patient_status_id', Patient::STATUS_ACTIVE)
            ->count();
    }

    public function getRemainingIcuCapacity()
    {
        $icuPatient = $this->patients
            ->where('bed_id', 3)
            ->where('patient_status_id', Patient::STATUS_ACTIVE)->count();
        return $this->icu_capacity - $icuPatient;
    }

    //returns integer
    public function getRemainingIsolationCapacity()
    {
        $isolationPatient = $this->patients
            ->where('bed_id', 2)
            ->where('patient_status_id', Patient::STATUS_ACTIVE)->count();
        return $this->isolation_capacity - $isolationPatient;
    }

    //returns integer
    public function getRemainingWardCapacity()
    {
        $wardPatient = $this->patients
            ->where('bed_id', 1)
            ->where('patient_status_id', Patient::STATUS_ACTIVE)->count();
        return $this->ward_capacity - $wardPatient;
    }

    //returns integer
    public function getRemainingVentilators()
    {
        $usedVentilator = $this->patients->where('ventilator', 1)->count();
        return $this->ventilator_capacity - $usedVentilator;
    }

    //returns boolean
    public function isTwentyPercent($bedtype)
    {
        if ($bedtype === 'ward') {
            $twentyPercent = round($this->ward_capacity * .2);
            return $this->getRemainingWardCapacity() <= $twentyPercent || 0;
        }

        if ($bedtype === 'isolation') {
            $twentyPercent = round($this->isolation_capacity * .2);
            return $this->getRemainingIsolationCapacity() <= $twentyPercent || 0;
        }

        if ($bedtype === 'icu') {
            $twentyPercent = round($this->icu_capacity * .2);
            return $this->getRemainingIcuCapacity() <= $twentyPercent || 0;
        }

        if ($bedtype === 'ventilator') {

            $twentyPercent = round($this->ventilators_capacity * .2);
            return $this->getRemainingVentilators() <= $twentyPercent || 0;
        }
    }

    public function scopeTotalCapacity($query, $tablecol)
    {
        return $query->sum($tablecol);
    }

    public function scopeNameSearch($query, $value)
    {
        $value = '%' . strtolower($value) . '%';
        
        return $query->whereRaw('LOWER(name) LIKE ?', [$value]);
    }

    /**
     * Filter health facility based on municipality and bed type. and return the total count(number)
     * @param $municipality integer e.g. 11 = Virac
     * @param $bed_type string e.g. icu_capacity
     */
    public function scopeMunicipalityBedTotalCapacity($query){
        return $query->where('municipality_id', 11)->sum('icu_capacity');
    }

    /**
     * Get the total count of available bed per municipality
     * @param $municipality integer e.g. 11 = Virac
     * @param $bed_type string e.g. icu_capacity
     */

    public function muniBedTotalCapacity($municipality, $bed_type){
        dd($this->ward_capacity);
    }

}
