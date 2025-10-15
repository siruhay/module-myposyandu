<?php

namespace Module\MyPosyandu\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Module\Posyandu\Models\PosyanduService;
use Module\MyPosyandu\Models\MyPosyanduActivity;
use Module\MyPosyandu\Http\Resources\PremiseResource;

class MyPosyanduPremise extends MyPosyanduComplaint
{
    /**
     * mapCombos function
     *
     * @param Request $request
     * @return array
     */
    public static function mapCombos(Request $request): array
    {
        $activity = MyPosyanduActivity::find($request->segment(4));

        return [
            'services' => PosyanduService::forCombo(),
            'complaints' => static::where('service_id', $activity->service_id)
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('posyandu_premises')
                        ->whereColumn('posyandu_premises.complaint_id', 'posyandu_complaints.id');
                })
                ->forCombo(),
        ];
    }

    /**
     * scopeForCombo function
     *
     * @param Builder $query
     * @return void
     */
    public function scopeForCombo(Builder $query)
    {
        return $query
            ->select('description AS title', 'id AS value')
            ->get();
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
            $parent->premises()->attach($request->complaint_id);

            DB::connection($parent->connection)->commit();

            return new PremiseResource($parent);
        } catch (\Exception $e) {
            DB::connection($parent->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model delete method
     *
     * @param [type] $model
     * @return void
     */
    public static function deletePivotRecord($model, $parent)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $parent->premises()->detach($model->id);

            DB::connection($model->connection)->commit();

            return new PremiseResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
