<?php

namespace App\Http\Resources;

use App\Models\HealthFacility;
use Illuminate\Http\Resources\Json\JsonResource;

class SuperAdminHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $health_facility_name = HealthFacility::find($this->health_facility_id)->name;

        return [
            "id" => $this->id,
            "user_id" =>  $this->user_id,
            "health_facility_id" => $this->health_facility_id,
            "health_facility_name" => $health_facility_name,
            "municipality_id" =>  $this->municipality_id,
            "icu_capacity" =>  $this->icu_capacity,
            "isolation_capacity" =>  $this->isolation_capacity,
            "ward_capacity" =>  $this->ward_capacity,
            "occupied_icu" => $this->occupied_icu,
            "occupied_isolation" => $this->occupied_isolation,
            "occupied_ward" =>  $this->occupied_ward,
            "active_ventilator" =>  $this->active_ventilator,
            "max_ventilator" =>  $this->max_ventilator,
            "log_name" =>  $this->log_name,
            "created_at" => $this->created_at->format('j-M-Y H:i:s'),
            "updated_at" => $this->updated_at
        ];
        // return parent::toArray($request);
    }
}
