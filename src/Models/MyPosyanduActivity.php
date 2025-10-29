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
use Module\Posyandu\Models\PosyanduDocument;
use Illuminate\Database\Eloquent\SoftDeletes;
use Module\Posyandu\Models\PosyanduComplaint;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Module\MyPosyandu\Http\Resources\ActivityResource;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Module\Foundation\Models\FoundationCommunity;

class MyPosyanduActivity extends Model
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
    protected $table = 'posyandu_activities';

    /**
     * The roles variable
     *
     * @var array
     */
    protected $roles = ['myposyandu-activity'];

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
     * mapCombos function
     *
     * @param Request $request
     * @return array
     */
    public static function mapCombos(Request $request): array
    {
        return [
            'services' => PosyanduService::forCombo()
        ];
    }

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
            ['title' => 'Nama Kegiatan', 'value' => 'name'],
            ['title' => 'Bidang', 'value' => 'service_name'],
            ['title' => 'Tanggal', 'value' => 'date'],
            ['title' => 'Anggaran', 'value' => 'budget_formatted'],
            ['title' => 'JPM', 'value' => 'participants'],
            ['title' => 'Pelaksana', 'value' => 'executor'],
            ['title' => 'Status', 'value' => 'status'],
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
            'service_id' => $model->service_id,
            'service_name' => optional($model->service)->name,
            'participants' => $model->participants,
            'executor' => $model->executor,
            'budget' => floatval(optional($model->funding)->budget),
            'budget_formatted' => number_format(
                floatval(optional($model->funding)->budget),
                0,
                ",",
                "."
            ),
            'status' => $model->status,
            'description' => $model->description
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
            'service_name' => optional($model->service)->name,
            'participants' => $model->participants,
            'executor' => $model->executor,
            'budget' => floatval(optional($model->funding)->budget),
            'budget_formatted' => number_format(
                floatval(optional($model->funding)->budget),
                0,
                ",",
                "."
            ),
            'status' => $model->status,
            'complaints' => $model->complaints()->select('name', 'description')->get(),
            'description' => $model->description
        ];
    }

    /**
     * mapRecordBase function
     *
     * @param Request $request
     * @return array
     */
    public static function mapRecordBase(Request $request): array
    {
        return [
            'id' => null,
            'name' => null,
            'date' => null,
            'service_id' => null,
            'community_id' => null,
            'executor' => null,
            'description' => null,
            'participants' => null,
            'workunit_id' => null,
            'status' => null,
            'paths' => PosyanduDocument::whereIn('name', ['Proposal Pengajuan'])->get()->reduce(function ($carry, $document) {
                array_push($carry, [
                    'id' => $document->id,
                    'name' => $document->name,
                    'slug' => $document->slug,
                    'mime' => $document->mime,
                    'extension' => optional($document)->extension ?: '.pdf',
                    'maxsize' => $document->maxsize,
                    'path' => null
                ]);

                return $carry;
            }, []),
            'user_id' => null,
        ];
    }

    /**
     * mapStatuses function
     *
     * @param Request $request
     * @return array
     */
    public static function mapStatuses(Request $request, $model = null): array
    {
        return [
            'hasPremises' => $model ? $model->status === 'DRAFTED' && $model->premises->count() > 0 : false,
            'hasBeenPosted' => $model ? $model->status === 'POSTED' : false
        ];
    }

    /**
     * foundings function
     *
     * @return HasOne
     */
    public function funding(): HasOne
    {
        return $this->hasOne(MyPosyanduFounding::class, 'activity_id');
    }

    /**
     * complaints function
     *
     * @return BelongsToMany
     */
    public function complaints(): BelongsToMany
    {
        return $this->belongsToMany(
            PosyanduComplaint::class,
            'posyandu_premises',
            'activity_id',
            'complaint_id'
        );
    }

    /**
     * premises function
     *
     * @return BelongsToMany
     */
    public function premises(): BelongsToMany
    {
        return $this->belongsToMany(
            MyPosyanduComplaint::class,
            'posyandu_premises',
            'activity_id',
            'complaint_id'
        );
    }

    /**
     * recipients function
     *
     * @return BelongsToMany
     */
    public function recipients(): BelongsToMany
    {
        return $this->belongsToMany(
            MyPosyanduBeneficiary::class,
            'posyandu_recipients',
            'activity_id',
            'beneficiary_id'
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
            $model->name = $request->name;
            $model->date = $request->date;
            $model->service_id = $request->service_id;
            $model->community_id = optional($community)->id;
            $model->village_id = optional($community)->village_id;
            $model->subdistrict_id = optional($community)->subdistrict_id;
            $model->executor = $request->executor;
            $model->description = $request->description;
            $model->participants = $request->participants;
            $model->status = 'DRAFTED';
            $model->paths = $request->paths;
            $model->user_id = $request->user()->id;
            $model->save();

            MyPosyanduFounding::storeRecord($model, $request->budget);

            DB::connection($model->connection)->commit();

            return new ActivityResource($model);
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
            $model->name = $request->name;
            $model->date = $request->date;
            $model->service_id = $request->service_id;
            $model->executor = $request->executor;
            $model->description = $request->description;
            $model->participants = $request->participants;
            $model->status = 'DRAFTED';
            $model->paths = $request->paths;
            $model->user_id = $request->user()->id;
            $model->save();

            DB::connection($model->connection)->commit();

            return new ActivityResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * postedRecord function
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function postedRecord(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->status = 'POSTED';
            $model->posted_at = now();
            $model->save();

            $premises = $model->premises;

            foreach ($premises as $premise) {
                $premise->activity_id = $model->id;
                $premise->status = 'IN-PROGRESS';
                $premise->save();
            }

            DB::connection($model->connection)->commit();

            return new ActivityResource($model);
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

            return new ActivityResource($model);
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

            return new ActivityResource($model);
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

            return new ActivityResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
