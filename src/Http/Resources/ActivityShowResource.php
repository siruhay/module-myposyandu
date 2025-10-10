<?php

namespace Module\MyPosyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyPosyandu\Models\MyPosyanduActivity;
use Module\System\Http\Resources\UserLogActivity;

class ActivityShowResource extends JsonResource
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
            'record' => MyPosyanduActivity::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyPosyanduActivity::mapCombos($request, $this),

                'icon' => MyPosyanduActivity::getPageIcon('myposyandu-activity'),

                'key' => MyPosyanduActivity::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyPosyanduActivity::mapStatuses($request, $this),

                'title' => MyPosyanduActivity::getPageTitle($request, 'myposyandu-activity'),
            ],
        ];
    }
}
