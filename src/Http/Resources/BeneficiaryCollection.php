<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduBeneficiary;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BeneficiaryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return BeneficiaryResource::collection($this->collection);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function with($request): array
    {
        if ($request->has('initialized')) {
            return [];
        }

        return [
            'setups' => [
                /** the page combo */
                'combos' => MyPosyanduBeneficiary::mapCombos($request),

                /** the page data filter */
                'filters' => MyPosyanduBeneficiary::mapFilters(),

                /** the table header */
                'headers' => MyPosyanduBeneficiary::mapHeaders($request),

                /** the page icon */
                'icon' => MyPosyanduBeneficiary::getPageIcon('myposyandu-beneficiary'),

                /** the record key */
                'key' => MyPosyanduBeneficiary::getDataKey(),

                /** the page default */
                'recordBase' => MyPosyanduBeneficiary::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyPosyanduBeneficiary::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyPosyanduBeneficiary::getPageTitle($request, 'myposyandu-beneficiary'),

                /** the usetrash flag */
                'usetrash' => MyPosyanduBeneficiary::hasSoftDeleted(),
            ]
        ];
    }
}
