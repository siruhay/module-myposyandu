<?php

namespace Module\MyPosyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyPosyandu\Models\MyPosyanduBeneficiary;
use Module\System\Http\Resources\UserLogActivity;

class BeneficiaryShowResource extends JsonResource
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
            'record' => MyPosyanduBeneficiary::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyPosyanduBeneficiary::mapCombos($request, $this),

                'icon' => MyPosyanduBeneficiary::getPageIcon('myposyandu-beneficiary'),

                'key' => MyPosyanduBeneficiary::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyPosyanduBeneficiary::mapStatuses($request, $this),

                'title' => MyPosyanduBeneficiary::getPageTitle($request, 'myposyandu-beneficiary'),
            ],
        ];
    }
}
