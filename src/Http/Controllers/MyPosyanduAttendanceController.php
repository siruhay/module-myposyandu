<?php

namespace Module\MyPosyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyPosyandu\Models\MyPosyanduAttendance;
use Module\MyPosyandu\Models\Activity;
use Module\MyPosyandu\Http\Resources\AttendanceCollection;
use Module\MyPosyandu\Http\Resources\AttendanceShowResource;

class MyPosyanduAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\MyPosyandu\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Activity $activity)
    {
        Gate::authorize('view', MyPosyanduAttendance::class);

        return new AttendanceCollection(
            $activity
                ->attendances()
                ->applyMode($request->mode)
                ->filter($request->filters)
                ->search($request->findBy)
                ->sortBy($request->sortBy, $request->sortDesc)
                ->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Activity $activity)
    {
        Gate::authorize('create', MyPosyanduAttendance::class);

        $request->validate([]);

        return MyPosyanduAttendance::storeRecord($request, $activity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyPosyandu\Models\Activity $activity
     * @param  \Module\MyPosyandu\Models\MyPosyanduAttendance $myPosyanduAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity, MyPosyanduAttendance $myPosyanduAttendance)
    {
        Gate::authorize('show', $myPosyanduAttendance);

        return new AttendanceShowResource($myPosyanduAttendance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\Activity $activity
     * @param  \Module\MyPosyandu\Models\MyPosyanduAttendance $myPosyanduAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity, MyPosyanduAttendance $myPosyanduAttendance)
    {
        Gate::authorize('update', $myPosyanduAttendance);

        $request->validate([]);

        return MyPosyanduAttendance::updateRecord($request, $myPosyanduAttendance);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyPosyandu\Models\Activity $activity
     * @param  \Module\MyPosyandu\Models\MyPosyanduAttendance $myPosyanduAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity, MyPosyanduAttendance $myPosyanduAttendance)
    {
        Gate::authorize('delete', $myPosyanduAttendance);

        return MyPosyanduAttendance::deleteRecord($myPosyanduAttendance);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduAttendance $myPosyanduAttendance
     * @return \Illuminate\Http\Response
     */
    public function restore(Activity $activity, MyPosyanduAttendance $myPosyanduAttendance)
    {
        Gate::authorize('restore', $myPosyanduAttendance);

        return MyPosyanduAttendance::restoreRecord($myPosyanduAttendance);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduAttendance $myPosyanduAttendance
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Activity $activity, MyPosyanduAttendance $myPosyanduAttendance)
    {
        Gate::authorize('destroy', $myPosyanduAttendance);

        return MyPosyanduAttendance::destroyRecord($myPosyanduAttendance);
    }
}