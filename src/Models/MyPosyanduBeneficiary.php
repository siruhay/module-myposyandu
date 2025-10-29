<?php

namespace Module\MyPosyandu\Models;

use Illuminate\Http\Request;
use Module\System\Traits\HasMeta;
use Illuminate\Support\Facades\DB;
use Module\System\Traits\Filterable;
use Module\System\Traits\Searchable;
use Module\System\Traits\HasPageSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Module\Foundation\Models\FoundationBiodata;
use Module\Foundation\Models\FoundationCommunity;
use Module\MyPosyandu\Http\Resources\BeneficiaryResource;
use Module\Posyandu\Models\PosyanduCategory;

class MyPosyanduBeneficiary extends Model
{
    use Filterable;
    use HasMeta;
    use HasPageSetup;
    use Searchable;
    use SoftDeletes;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'platform';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posyandu_beneficiaries';

    /**
     * The roles variable
     *
     * @var array
     */
    protected $roles = ['myposyandu-beneficiary'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'meta' => 'array'
    ];

    /**
     * The default key for the order.
     *
     * @var string
     */
    protected $defaultOrder = 'name';

    /**
     * mapHeaders function
     *
     * readonly value?: SelectItemKey<any>
     * readonly title?: string | undefined
     * readonly align?: 'start' | 'end' | 'center' | undefined
     * readonly width?: string | number | undefined
     * readonly minWidth?: string | undefined
     * readonly maxWidth?: string | undefined
     * readonly nowrap?: boolean | undefined
     * readonly sortable?: boolean | undefined
     *
     * @param Request $request
     * @return array
     */
    public static function mapHeaders(Request $request): array
    {
        return [
            ['title' => 'Name', 'value' => 'name'],
            ['title' => 'Phone', 'value' => 'phone'],
            ['title' => 'Kategori', 'value' => 'category_name'],
            ['title' => 'Lembaga', 'value' => 'community_name'],
            ['title' => 'Kecamatan', 'value' => 'subdistrict_name'],
            ['title' => 'Desa/Kelurahan', 'value' => 'village_name'],
            ['title' => 'Updated', 'value' => 'updated_at', 'sortable' => false, 'width' => '170'],
        ];
    }

    /**
     * mapResource function
     *
     * @param Request $request
     * @return array
     */
    public static function mapResource(Request $request, $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'slug' => $model->slug,
            'phone' => optional($model->biodata)->phone,
            'gender_id' => optional($model->biodata)->gender_id,
            'category_id' => $model->category_id,
            'category_name' => optional($model->category)->name,
            'community_id' => $model->community_id,
            'community_name' => optional($model->community)->name,
            'subdistrict_name' => optional($model->biodata?->subdistrict)->name,
            'village_name' => optional($model->biodata?->village)->name,
            'citizen' => optional($model->biodata)->citizen,
            'neighborhood' => optional($model->biodata)->neighborhood,
            'subtitle' => (string) $model->updated_at,
            'updated_at' => (string) $model->updated_at,
        ];
    }

    /**
     * biodata function
     *
     * @return BelongsTo
     */
    public function biodata(): BelongsTo
    {
        return $this->belongsTo(FoundationBiodata::class, 'biodata_id');
    }

    /**
     * category function
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(PosyanduCategory::class, 'category_id');
    }

    /**
     * community function
     *
     * @return BelongsTo
     */
    public function community(): BelongsTo
    {
        return $this->belongsTo(FoundationCommunity::class, 'community_id');
    }

    /**
     * The model store method
     *
     * @param Request $request
     * @return void
     */
    public static function storeRecord(Request $request)
    {
        $community = FoundationCommunity::find($request->user()->userable->workunitable_id);

        try {
            $model = static::storeFrom($request, $community);

            return new BeneficiaryResource($model);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * storeFrom function
     *
     * @param Request $request
     * @param [type] $community
     * @return Model|null
     */
    public static function storeFrom(Request $request, $community): Model|null
    {
        if (! $model = static::firstWhere('slug', $request->slug)) {
            $model = new static();
        }

        $biodata = FoundationBiodata::storeFrom(
            (object) [
                'name' => str($request->name)->upper()->toString(),
                'slug' => $request->slug,
                'phone' => $request->phone,
                'kind' => 'NON-ASN',
                'type' => 'CITIZEN',
                'role' => 'CITIZEN',
                'gender_id' => $request->gender_id,
                'workunitable_type' => get_class($community),
                'workunitable_id' => $community->id,
                'village_id' => $community->village_id,
                'subdistrict_id' => $community->subdistrict_id,
                'regency_id' => 3,
                'citizen' => $request->citizen,
                'neighborhood' => $request->neighborhood,
            ]
        );

        $model->name = $biodata->name;
        $model->slug = $biodata->slug;
        $model->community_id = $community->id;
        $model->village_id = $community->village_id;
        $model->category_id = $request->category_id;
        $model->biodata_id = $biodata->id;
        $model->save();

        return $model;
    }

    /**
     * The model update method
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function updateRecord(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            // ...
            $model->save();

            DB::connection($model->connection)->commit();

            return new BeneficiaryResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

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
    public static function deleteRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->delete();

            DB::connection($model->connection)->commit();

            return new BeneficiaryResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model restore method
     *
     * @param [type] $model
     * @return void
     */
    public static function restoreRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->restore();

            DB::connection($model->connection)->commit();

            return new BeneficiaryResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model destroy method
     *
     * @param [type] $model
     * @return void
     */
    public static function destroyRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->forceDelete();

            DB::connection($model->connection)->commit();

            return new BeneficiaryResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
