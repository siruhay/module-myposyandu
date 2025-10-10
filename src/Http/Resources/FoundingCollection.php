<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduFounding;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FoundingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return FoundingResource::collection($this->collection);
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
                'combos' => MyPosyanduFounding::mapCombos($request),

                /** the page data filter */
                'filters' => MyPosyanduFounding::mapFilters(),

                /** the table header */
                'headers' => MyPosyanduFounding::mapHeaders($request),

                /** the page icon */
                'icon' => MyPosyanduFounding::getPageIcon('myposyandu-founding'),

                /** the record key */
                'key' => MyPosyanduFounding::getDataKey(),

                /** the page default */
                'recordBase' => MyPosyanduFounding::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyPosyanduFounding::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyPosyanduFounding::getPageTitle($request, 'myposyandu-founding'),

                /** the usetrash flag */
                'usetrash' => MyPosyanduFounding::hasSoftDeleted(),
            ]
        ];
    }
}
