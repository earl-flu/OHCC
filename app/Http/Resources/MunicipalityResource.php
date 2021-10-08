<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MunicipalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "code" => $this->code,
            "id_code" => $this->id_code,
            "name" => $this->name,
            "total_icu_capacity" => $this->getTotal('icu_capacity'),
            "total_isolation_capacity" => $this->getTotal('isolation_capacity'),
            "total_ward_capacity" => $this->getTotal('ward_capacity'),
            "total_icu_occupied" => $this->getTotal('occupied_icu'),
            "total_isolation_occupied" => $this->getTotal('occupied_isolation'),
            "total_ward_occupied" => $this->getTotal('occupied_ward'),
        ];
        // return parent::toArray($request);
    }
}
