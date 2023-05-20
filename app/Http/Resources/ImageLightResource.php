<?php

namespace App\Http\Resources;

use App\Services\ImageService;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageLightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'uri' => asset('storage/images/small/' . $this->path),
        ];
    }
}
