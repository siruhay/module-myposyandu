<?php

namespace Module\MyPosyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyPosyandu\Models\MyPosyanduPremise;
use Module\System\Http\Resources\UserLogActivity;

class PremiseShowResource extends JsonResource
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
            'record' => MyPosyanduPremise::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyPosyanduPremise::mapCombos($request, $this),

                'icon' => MyPosyanduPremise::getPageIcon('myposyandu-premise'),

                'key' => MyPosyanduPremise::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyPosyanduPremise::mapStatuses($request, $this),

                'title' => MyPosyanduPremise::getPageTitle($request, 'myposyandu-premise'),
            ],
        ];
    }
}
