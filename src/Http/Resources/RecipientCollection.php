<?php

namespace Module\MyPosyandu\Http\Resources;

use Module\MyPosyandu\Models\MyPosyanduRecipient;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RecipientCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return RecipientResource::collection($this->collection);
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
                'combos' => MyPosyanduRecipient::mapCombos($request),

                /** the page data filter */
                'filters' => MyPosyanduRecipient::mapFilters(),

                /** the table header */
                'headers' => MyPosyanduRecipient::mapHeaders($request),

                /** the page icon */
                'icon' => MyPosyanduRecipient::getPageIcon('myposyandu-recipient'),

                /** the record key */
                'key' => MyPosyanduRecipient::getDataKey(),

                /** the page default */
                'recordBase' => MyPosyanduRecipient::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyPosyanduRecipient::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyPosyanduRecipient::getPageTitle($request, 'myposyandu-recipient'),

                /** the usetrash flag */
                'usetrash' => MyPosyanduRecipient::hasSoftDeleted(),
            ]
        ];
    }
}
