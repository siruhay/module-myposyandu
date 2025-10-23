<?php

namespace Module\MyPosyandu\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Module\Foundation\Models\FoundationCommunity;
use Module\Posyandu\Models\PosyanduCategory;
use Module\Reference\Models\ReferenceGender;
use Module\MyPosyandu\Http\Resources\BeneficiaryResource;
use Module\Posyandu\Models\PosyanduIndicator;

class MyPosyanduRecipient extends MyPosyanduBeneficiary
{
    /**
     * mapCombos function
     *
     * @param Request $request
     * @return array
     */
    public static function mapCombos(Request $request): array
    {
        $activity = MyPosyanduActivity::find(intval($request->segment(4)));

        return [
            'categories' => PosyanduCategory::forCombo(),
            'genders' => ReferenceGender::forCombo(),
            'indicators' => PosyanduIndicator::where('service_id', optional($activity)->service_id)->forCombo()
        ];
    }

    /**
     * The model store method
     *
     * @param Request $request
     * @return void
     */
    public static function storePivotRecord(Request $request, $parent)
    {
        DB::connection($parent->connection)->beginTransaction();

        try {
            $community = FoundationCommunity::find($request->user()->userable->workunitable_id);

            if ($beneficiary = MyPosyanduBeneficiary::storeFrom($request, $community)) {
                $parent->recipients()->attach($beneficiary->id, ['indicator_id' => $request->indicator_id]);
            }

            DB::connection($parent->connection)->commit();

            return new BeneficiaryResource($parent);
        } catch (\Exception $e) {
            DB::connection($parent->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
