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
    public function getTotal($name)
    {
        return $this->healthFacilities->sum($name);
    }

    public function getVacant($capacity, $occupied)
    {
        $total_occupied = $this->getTotal($occupied);
        $total_capacity = $this->getTotal($capacity);

        return $total_capacity - $total_occupied;
    }
}
