<?php

namespace Module\MyPosyandu\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyPosyandu\Models\MyPosyanduComplaint;
use Module\System\Http\Resources\UserLogActivity;

class ComplaintShowResource extends JsonResource
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
            'record' => MyPosyanduComplaint::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyPosyanduComplaint::mapCombos($request, $this),

                'icon' => MyPosyanduComplaint::getPageIcon('myposyandu-complain'),

                'key' => MyPosyanduComplaint::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyPosyanduComplaint::mapStatuses($request, $this),

                'title' => MyPosyanduComplaint::getPageTitle($request, 'myposyandu-complain'),
            ],
        ];
    }
}
