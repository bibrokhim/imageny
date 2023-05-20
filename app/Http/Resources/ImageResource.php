<?php

namespace App\Http\Resources;

use App\Services\ImageService;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'extension' => $this->extension,
            'size' => ImageService::calculateSize($this->size),
            'resolution' => ImageService::resolution($this->path),
            'uri' => asset('storage/images/' . $this->path),
            'sizes' => $this->sizes($this->path, $this->extension),
            'formats' => $this->formats(),
        ];
    }
}
