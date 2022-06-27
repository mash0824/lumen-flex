<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'full_name' => $this->first_name.' '.$this->last_name,
            'email' => $this->email,
            'username' => $this->username,
            'gender' => $this->gender,
            'country' => $this->country,
            'city' => $this->city,
            'phone' => $this->phone,
        ];
    }
}
