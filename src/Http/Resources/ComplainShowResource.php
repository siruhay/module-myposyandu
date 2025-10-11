<?php

namespace Module\MyPosyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyPosyandu\Models\MyPosyanduComplain;
use Module\System\Http\Resources\UserLogActivity;

class ComplainShowResource extends JsonResource
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
            'record' => MyPosyanduComplain::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyPosyanduComplain::mapCombos($request, $this),

                'icon' => MyPosyanduComplain::getPageIcon('myposyandu-complain'),

                'key' => MyPosyanduComplain::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyPosyanduComplain::mapStatuses($request, $this),

                'title' => MyPosyanduComplain::getPageTitle($request, 'myposyandu-complain'),
            ],
        ];
    }
}
