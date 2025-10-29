<?php

namespace Module\MyPosyandu\Models;

use Illuminate\Http\Request;
use Module\System\Traits\HasMeta;
use Illuminate\Support\Facades\DB;
use Module\System\Traits\Filterable;
use Module\System\Traits\Searchable;
use Module\System\Traits\HasPageSetup;
use Illuminate\Database\Eloquent\Model;
use Module\Posyandu\Models\PosyanduService;
use Module\Posyandu\Models\PosyanduActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Module\Foundation\Models\FoundationCommunity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Module\MyPosyandu\Http\Resources\ComplaintResource;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MyPosyanduComplaint extends Model
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
    protected $table = 'posyandu_complaints';

    /**
     * The roles variable
     *
     * @var array
     */
    protected $roles = ['myposyandu-complain'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'paths' => 'array',
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
            ['title' => 'Bidang', 'value' => 'service_name'],
            ['title' => 'Tanggal', 'value' => 'date'],
            ['title' => 'Urgensi', 'value' => 'urgency'],
            ['title' => 'Keterangan', 'value' => 'description'],
            ['title' => 'Status', 'value' => 'status', 'width' => '170'],
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
            'date' => $model->date,
            'service_name' => $model->service?->name,
            'urgency' => $model->urgency,
            'status' => $model->status,
            'description' => $model->description,

            'subtitle' => (string) $model->updated_at,
            'updated_at' => (string) $model->updated_at,
        ];
    }

    /**
     * mapResourceShow function
     *
     * @param Request $request
     * @return array
     */
    public static function mapResourceShow(Request $request, $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'date' => $model->date,
            'service_id' => $model->service_id,
            'description' => $model->description,
            'urgency' => $model->urgency,
            'status' => $model->status,
            'paths' => $model->paths,
        ];
    }

    /**
     * mapCombos function
     *
     * @param Request $request
     * @return array
     */
    public static function mapCombos(Request $request): array
    {
        return [
            'services' => PosyanduService::forCombo(),
        ];
    }

    /**
     * complaints function
     *
     * @return BelongsToMany
     */
    public function complaints(): BelongsToMany
    {
        return $this->belongsToMany(
            PosyanduActivity::class,
            'posyandu_premises',
            'complaint_id',
            'activity_id',
        );
    }

    /**
     * service function
     *
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(PosyanduService::class, 'service_id');
    }

    /**
     * The model store method
     *
     * @param Request $request
     * @return void
     */
    public static function storeRecord(Request $request)
    {
        $model = new static();

        $community = FoundationCommunity::find(
            optional($request->user()->userable)->workunitable_id
        );

        DB::connection($model->connection)->beginTransaction();

        try {
            // ['LOW', 'MEDIUM', 'HIGH']
            // ['NEW', 'IN-PROGRESS', 'RESOLVED']
            $model->name = str($request->name)->upper()->toString();
            $model->date = $request->date;
            $model->service_id = $request->service_id;
            $model->community_id = optional($community)->id;
            $model->village_id = optional($community)->village_id;
            $model->subdistrict_id = optional($community)->subdistrict_id;
            $model->description = $request->description;
            $model->paths = $request->paths;
            $model->urgency = $request->urgency;
            $model->status = 'NEW';
            $model->user_id = $request->user()->id;
            $model->save();

            DB::connection($model->connection)->commit();

            return new ComplaintResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
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
            $model->name = str($request->name)->upper()->toString();
            $model->date = $request->date;
            $model->service_id = $request->service_id;
            $model->description = $request->description;
            $model->paths = $request->paths;
            $model->urgency = $request->urgency;
            $model->user_id = $request->user()->id;
            $model->save();

            DB::connection($model->connection)->commit();

            return new ComplaintResource($model);
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

            return new ComplaintResource($model);
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

            return new ComplaintResource($model);
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

            return new ComplaintResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
