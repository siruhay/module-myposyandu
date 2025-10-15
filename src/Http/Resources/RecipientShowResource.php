<?php

namespace Module\MyPosyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyPosyandu\Models\MyPosyanduRecipient;
use Module\System\Http\Resources\UserLogActivity;

class RecipientShowResource extends JsonResource
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
            'record' => MyPosyanduRecipient::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyPosyanduRecipient::mapCombos($request, $this),

                'icon' => MyPosyanduRecipient::getPageIcon('myposyandu-recipient'),

                'key' => MyPosyanduRecipient::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyPosyanduRecipient::mapStatuses($request, $this),

                'title' => MyPosyanduRecipient::getPageTitle($request, 'myposyandu-recipient'),
            ],
        ];
    }
}
