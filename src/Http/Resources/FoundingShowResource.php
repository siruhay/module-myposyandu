<?php

namespace Module\MyPosyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyPosyandu\Models\MyPosyanduFounding;
use Module\System\Http\Resources\UserLogActivity;

class FoundingShowResource extends JsonResource
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
            /**
             * the record data
             */
            'record' => MyPosyanduFounding::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyPosyanduFounding::mapCombos($request, $this),

                'icon' => MyPosyanduFounding::getPageIcon('myposyandu-founding'),

                'key' => MyPosyanduFounding::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyPosyanduFounding::mapStatuses($request, $this),

                'title' => MyPosyanduFounding::getPageTitle($request, 'myposyandu-founding'),
            ],
        ];
    }
}
