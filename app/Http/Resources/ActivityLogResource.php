<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogResource extends JsonResource
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
            "log_name" => $this->log_name,
            "description" => $this->description,
            "subject_type" => $this->subject_type,
            "subject_id" => $this->subject_id,
            "causer_type" => $this->causer_type,
            "causer_id" => $this->causer_id,
            "causer_name" => $this->causer->first_name,
            'old' => [
                "name" => $this->properties['old']['name'],
                "occupied_ward" => $this->properties['old']['occupied_ward'],
                "occupied_isolation" => $this->properties['old']['occupied_isolation'],
                "occupied_icu" => $this->properties['old']['occupied_icu'],
                "created_at" =>  $this->properties['old']['created_at'],
                "updated_at" =>  $this->properties['old']['updated_at'],
            ],
            'attributes' => [
                "name" => $this->properties['attributes']['name'],
                "occupied_ward" => $this->properties['attributes']['occupied_ward'],
                "occupied_isolation" => $this->properties['attributes']['occupied_isolation'],
                "occupied_icu" => $this->properties['attributes']['occupied_icu'],
                "created_at" =>  $this->properties['attributes']['created_at'],
                "updated_at" =>  $this->properties['attributes']['updated_at'],
            ],
            //"created_at" =>  $this->created_at->format('d-m-Y H:i:s'), //31-12-2021
            "created_at" =>  $this->created_at->format('j-M-Y H:i:s'),
            "updated_at" =>  $this->updated_at,
        ];
    }
}
