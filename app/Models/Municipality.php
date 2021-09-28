<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    //Health Facilities
    public function hospitals()
    {
        return $this->hasMany(HealthFacility::class);
    }

    /**
     * Return total number of capacity e.g. icu_capacity
     */
    public function bedCount($capacity_type)
    {
        return $this->hospitals->sum($capacity_type);
    }
}
