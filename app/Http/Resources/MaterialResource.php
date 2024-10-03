<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "material_categories_id" => $this->categories ? $this->categories->id : null,
            "material_categories_name" => $this->categories ? $this->categories->nama : null,
            "user_id" => $this->whenLoaded('userId'),
            // "description" => $this -> categories -> description ?? null,
            "code" => $this->code,
            "name" => $this->name,
            "brand" => $this->brand,
            "expired_date" => date("Y-m-d", strtotime($this->expired_date)),
            "is_toxic" => $this->is_toxic,
        ];
    }
}
