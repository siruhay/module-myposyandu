<?php

namespace Module\MyPosyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyPosyandu\Models\MyPosyanduReport;
use Module\MyPosyandu\Http\Resources\ReportCollection;
use Module\MyPosyandu\Http\Resources\ReportShowResource;

class MyPosyanduReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyPosyanduReport::class);

        return new ReportCollection(
            MyPosyanduReport::applyMode($request->mode)
                ->filter($request->filters)
                ->search($request->findBy)
                ->sortBy($request->sortBy)
                ->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create', MyPosyanduReport::class);

        $request->validate([]);

        return MyPosyanduReport::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduReport $myPosyanduReport
     * @return \Illuminate\Http\Response
     */
    public function show(MyPosyanduReport $myPosyanduReport)
    {
        Gate::authorize('show', $myPosyanduReport);

        return new ReportShowResource($myPosyanduReport);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\MyPosyanduReport $myPosyanduReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyPosyanduReport $myPosyanduReport)
    {
        Gate::authorize('update', $myPosyanduReport);

        $request->validate([]);

        return MyPosyanduReport::updateRecord($request, $myPosyanduReport);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduReport $myPosyanduReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyPosyanduReport $myPosyanduReport)
    {
        Gate::authorize('delete', $myPosyanduReport);

        return MyPosyanduReport::deleteRecord($myPosyanduReport);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduReport $myPosyanduReport
     * @return \Illuminate\Http\Response
     */
    public function restore(MyPosyanduReport $myPosyanduReport)
    {
        Gate::authorize('restore', $myPosyanduReport);

        return MyPosyanduReport::restoreRecord($myPosyanduReport);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduReport $myPosyanduReport
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyPosyanduReport $myPosyanduReport)
    {
        Gate::authorize('destroy', $myPosyanduReport);

        return MyPosyanduReport::destroyRecord($myPosyanduReport);
    }
}
