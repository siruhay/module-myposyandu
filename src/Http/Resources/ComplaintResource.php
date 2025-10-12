<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduComplaint;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return MyPosyanduComplaint::mapResource($request, $this);
    }
}
