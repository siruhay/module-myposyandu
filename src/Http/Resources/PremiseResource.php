<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduPremise;
use Illuminate\Http\Resources\Json\JsonResource;

class PremiseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return MyPosyanduPremise::mapResource($request, $this);
    }
}
