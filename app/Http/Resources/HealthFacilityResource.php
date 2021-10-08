<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HealthFacilityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "name" => $this->name,
            "barangay" => $this->barangay,
            "level" => $this->level,
            "ward_capacity" => $this->ward_capacity,
            "isolation_capacity" => $this->isolation_capacity,
            "icu_capacity" => $this->icu_capacity,
            "max_ventilator" => $this->max_ventilator,
            "occupied_ward" => $this->occupied_ward,
            "occupied_isolation" => $this->occupied_isolation,
            "occupied_icu" => $this->occupied_icu,
            "contact" => $this->contact,
            "is_isolation_facility" => $this->is_isolation_facility,
            "is_infirmary" => $this->is_infirmary,
            "remarks" => $this->remarks,
            // 'municipality' => new MunicipalityResource($this->municipality),
            'municipality' => $this->municipality,
            "updated_at" => $this->updated_at
        ];
    }
}
