<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduComplain;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ComplainCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ComplainResource::collection($this->collection);
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
                'combos' => MyPosyanduComplain::mapCombos($request),

                /** the page data filter */
                'filters' => MyPosyanduComplain::mapFilters(),

                /** the table header */
                'headers' => MyPosyanduComplain::mapHeaders($request),

                /** the page icon */
                'icon' => MyPosyanduComplain::getPageIcon('myposyandu-complain'),

                /** the record key */
                'key' => MyPosyanduComplain::getDataKey(),

                /** the page default */
                'recordBase' => MyPosyanduComplain::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyPosyanduComplain::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyPosyanduComplain::getPageTitle($request, 'myposyandu-complain'),

                /** the usetrash flag */
                'usetrash' => MyPosyanduComplain::hasSoftDeleted(),
            ]
        ];
    }
}
