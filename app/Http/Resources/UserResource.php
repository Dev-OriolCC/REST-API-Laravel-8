<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // * Tested passed 100%
        return [
            'id' => $this->id,
            'username' => $this->name,
            'email' => $this->email,
            'joined_date' => $this->created_at->diffForHumans()
        ];
    }
}
