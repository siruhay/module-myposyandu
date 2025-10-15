<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduPremise;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PremiseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PremiseResource::collection($this->collection);
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
                'combos' => MyPosyanduPremise::mapCombos($request),

                /** the page data filter */
                'filters' => MyPosyanduPremise::mapFilters(),

                /** the table header */
                'headers' => MyPosyanduPremise::mapHeaders($request),

                /** the page icon */
                'icon' => MyPosyanduPremise::getPageIcon('myposyandu-premise'),

                /** the record key */
                'key' => MyPosyanduPremise::getDataKey(),

                /** the page default */
                'recordBase' => MyPosyanduPremise::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyPosyanduPremise::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyPosyanduPremise::getPageTitle($request, 'myposyandu-premise'),

                /** the usetrash flag */
                'usetrash' => MyPosyanduPremise::hasSoftDeleted(),
            ]
        ];
    }
}
