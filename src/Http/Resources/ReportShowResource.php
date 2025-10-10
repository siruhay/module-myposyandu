<?php

namespace Module\MyPosyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyPosyandu\Models\MyPosyanduReport;
use Module\System\Http\Resources\UserLogActivity;

class ReportShowResource extends JsonResource
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
            'record' => MyPosyanduReport::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyPosyanduReport::mapCombos($request, $this),

                'icon' => MyPosyanduReport::getPageIcon('myposyandu-report'),

                'key' => MyPosyanduReport::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyPosyanduReport::mapStatuses($request, $this),

                'title' => MyPosyanduReport::getPageTitle($request, 'myposyandu-report'),
            ],
        ];
    }
}
