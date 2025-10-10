<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduActivity;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ActivityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ActivityResource::collection($this->collection);
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
                'combos' => MyPosyanduActivity::mapCombos($request),

                /** the page data filter */
                'filters' => MyPosyanduActivity::mapFilters(),

                /** the table header */
                'headers' => MyPosyanduActivity::mapHeaders($request),

                /** the page icon */
                'icon' => MyPosyanduActivity::getPageIcon('myposyandu-activity'),

                /** the record key */
                'key' => MyPosyanduActivity::getDataKey(),

                /** the page default */
                'recordBase' => MyPosyanduActivity::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyPosyanduActivity::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyPosyanduActivity::getPageTitle($request, 'myposyandu-activity'),

                /** the usetrash flag */
                'usetrash' => MyPosyanduActivity::hasSoftDeleted(),
            ]
        ];
    }
}
