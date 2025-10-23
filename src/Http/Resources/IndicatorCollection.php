<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduIndicator;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndicatorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return IndicatorResource::collection($this->collection);
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
                'combos' => MyPosyanduIndicator::mapCombos($request),

                /** the page data filter */
                'filters' => MyPosyanduIndicator::mapFilters(),

                /** the table header */
                'headers' => MyPosyanduIndicator::mapHeaders($request),

                /** the page icon */
                'icon' => MyPosyanduIndicator::getPageIcon('myposyandu-indicator'),

                /** the record key */
                'key' => MyPosyanduIndicator::getDataKey(),

                /** the page default */
                'recordBase' => MyPosyanduIndicator::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyPosyanduIndicator::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyPosyanduIndicator::getPageTitle($request, 'myposyandu-indicator'),

                /** the usetrash flag */
                'usetrash' => MyPosyanduIndicator::hasSoftDeleted(),
            ]
        ];
    }
}
