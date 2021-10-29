<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class HealthFacility extends Model
{
    use HasFactory;
    // use LogsActivity;

    protected $guarded = ['id'];

    const UPDATE_OCCUPIED = 'updated_occupied';
    const UPDATE_CAPACITY = 'updated_capacity';

    //log changes to all the unguarded attributes of the model
    // protected static $logUnguarded = true;

    // Specifying a log for model
    // protected static $logName = 'health_facility_log';

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

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function writeHistoryCapacity($user_id, $health_facility, $log_name)
    {
        //if there are no changes, will not save history
        if (empty($this->getChanges())) return;

        $history = new History([
            'user_id' => $user_id,
            'municipality_id' => $health_facility->municipality_id,
            'ward_capacity' => $health_facility->ward_capacity,
            'isolation_capacity' => $health_facility->isolation_capacity,
            'occupied_ward' => $health_facility->occupied_ward,
            'occupied_isolation' => $health_facility->occupied_isolation,
            'occupied_icu' => $health_facility->occupied_icu,
            'icu_capacity' => $health_facility->icu_capacity,
            'max_ventilator' => $health_facility->max_ventilator,
            'active_ventilator' => $health_facility->active_ventilator,
            'log_name' => $log_name,

        ]);

        $this->histories()->save($history);
    }

    public function writeHistoryOccupied($user_id, $health_facility, $log_name)
    {
        //if there are no changes, will not save history
        if (empty($this->getChanges())) return;

        $history = new History([
            'user_id' => $user_id,
            'municipality_id' => $health_facility->municipality_id,
            'ward_capacity' => $health_facility->ward_capacity,
            'isolation_capacity' => $health_facility->isolation_capacity,
            'icu_capacity' => $health_facility->icu_capacity,
            'occupied_ward' => $health_facility->occupied_ward,
            'occupied_isolation' => $health_facility->occupied_isolation,
            'occupied_icu' => $health_facility->occupied_icu,
            'max_ventilator' => $health_facility->max_ventilator,
            'active_ventilator' => $health_facility->active_ventilator,
            'log_name' => $log_name,

        ]);

        $this->histories()->save($history);
    }

    /**
     * ID's
     * ward: 1
     * isolation: 2
     * icu: 3
     */

    //returns integer
    public function totalRemainingWard()
    {
        return $this->ward_capacity - $this->occupied_ward;
    }

    public function totalRemainingIso()
    {
        return $this->isolation_capacity - $this->occupied_isolation;
    }

    public function totalRemainingIcu()
    {
        return $this->icu_capacity - $this->occupied_icu;
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
    public function scopeMunicipalityBedTotalCapacity($query)
    {
        return $query->where('municipality_id', 11)->sum('icu_capacity');
    }

    /**
     * Get the total count of available bed per municipality
     * @param $municipality integer e.g. 11 = Virac
     * @param $bed_type string e.g. icu_capacity
     */

    public function muniBedTotalCapacity($municipality, $bed_type)
    {
        dd($this->ward_capacity);
    }
}
