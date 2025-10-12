<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduComplaint;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ComplaintCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ComplaintResource::collection($this->collection);
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
                'combos' => MyPosyanduComplaint::mapCombos($request),

                /** the page data filter */
                'filters' => MyPosyanduComplaint::mapFilters(),

                /** the table header */
                'headers' => MyPosyanduComplaint::mapHeaders($request),

                /** the page icon */
                'icon' => MyPosyanduComplaint::getPageIcon('myposyandu-complain'),

                /** the record key */
                'key' => MyPosyanduComplaint::getDataKey(),

                /** the page default */
                'recordBase' => MyPosyanduComplaint::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyPosyanduComplaint::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyPosyanduComplaint::getPageTitle($request, 'myposyandu-complain'),

                /** the usetrash flag */
                'usetrash' => MyPosyanduComplaint::hasSoftDeleted(),
            ]
        ];
    }
}
