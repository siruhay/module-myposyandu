<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduComplain;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplainResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return MyPosyanduComplain::mapResource($request, $this);
    }
}
