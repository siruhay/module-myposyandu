<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduReport;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ReportResource::collection($this->collection);
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
                'combos' => MyPosyanduReport::mapCombos($request),

                /** the page data filter */
                'filters' => MyPosyanduReport::mapFilters(),

                /** the table header */
                'headers' => MyPosyanduReport::mapHeaders($request),

                /** the page icon */
                'icon' => MyPosyanduReport::getPageIcon('myposyandu-report'),

                /** the record key */
                'key' => MyPosyanduReport::getDataKey(),

                /** the page default */
                'recordBase' => MyPosyanduReport::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyPosyanduReport::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyPosyanduReport::getPageTitle($request, 'myposyandu-report'),

                /** the usetrash flag */
                'usetrash' => MyPosyanduReport::hasSoftDeleted(),
            ]
        ];
    }
}
