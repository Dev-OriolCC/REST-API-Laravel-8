<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // TODO: Pending to test
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'color' => $this->color,
            'last_update' => $this->updated_at->diffForHumans(),
            // ? Verify if works pending
            'status' => $this->status == 1 ? 'Unpublished' : 'Published',
            // ! Need to test relationship 
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
        ];
    }
}
