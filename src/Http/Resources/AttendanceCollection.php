<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduAttendance;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AttendanceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return AttendanceResource::collection($this->collection);
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
                'combos' => MyPosyanduAttendance::mapCombos($request),

                /** the page data filter */
                'filters' => MyPosyanduAttendance::mapFilters(),

                /** the table header */
                'headers' => MyPosyanduAttendance::mapHeaders($request),

                /** the page icon */
                'icon' => MyPosyanduAttendance::getPageIcon('myposyandu-attendance'),

                /** the record key */
                'key' => MyPosyanduAttendance::getDataKey(),

                /** the page default */
                'recordBase' => MyPosyanduAttendance::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyPosyanduAttendance::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyPosyanduAttendance::getPageTitle($request, 'myposyandu-attendance'),

                /** the usetrash flag */
                'usetrash' => MyPosyanduAttendance::hasSoftDeleted(),
            ]
        ];
    }
}
