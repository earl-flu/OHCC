<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    //Health Facilities
    public function healthFacilities()
    {
        return $this->hasMany(HealthFacility::class);
    }

    /**
     * Return total number of capacity e.g. icu_capacity
     */
    public function getTotal($capacity_type)
    {
        return $this->healthFacilities->sum($capacity_type);
    }
}
