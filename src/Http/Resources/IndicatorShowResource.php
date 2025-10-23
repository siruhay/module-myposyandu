<?php

namespace Module\MyPosyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyPosyandu\Models\MyPosyanduIndicator;
use Module\System\Http\Resources\UserLogActivity;

class IndicatorShowResource extends JsonResource
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
            'record' => MyPosyanduIndicator::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyPosyanduIndicator::mapCombos($request, $this),

                'icon' => MyPosyanduIndicator::getPageIcon('myposyandu-indicator'),

                'key' => MyPosyanduIndicator::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyPosyanduIndicator::mapStatuses($request, $this),

                'title' => MyPosyanduIndicator::getPageTitle($request, 'myposyandu-indicator'),
            ],
        ];
    }
}
