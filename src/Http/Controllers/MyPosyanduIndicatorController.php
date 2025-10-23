<?php

namespace Module\MyPosyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyPosyandu\Models\MyPosyanduIndicator;
use Module\MyPosyandu\Http\Resources\IndicatorCollection;
use Module\MyPosyandu\Http\Resources\IndicatorShowResource;

class MyPosyanduIndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyPosyanduIndicator::class);

        return new IndicatorCollection(
            MyPosyanduIndicator::applyMode($request->mode)
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
        Gate::authorize('create', MyPosyanduIndicator::class);

        $request->validate([]);

        return MyPosyanduIndicator::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduIndicator $myPosyanduIndicator
     * @return \Illuminate\Http\Response
     */
    public function show(MyPosyanduIndicator $myPosyanduIndicator)
    {
        Gate::authorize('show', $myPosyanduIndicator);

        return new IndicatorShowResource($myPosyanduIndicator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\MyPosyanduIndicator $myPosyanduIndicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyPosyanduIndicator $myPosyanduIndicator)
    {
        Gate::authorize('update', $myPosyanduIndicator);

        $request->validate([]);

        return MyPosyanduIndicator::updateRecord($request, $myPosyanduIndicator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduIndicator $myPosyanduIndicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyPosyanduIndicator $myPosyanduIndicator)
    {
        Gate::authorize('delete', $myPosyanduIndicator);

        return MyPosyanduIndicator::deleteRecord($myPosyanduIndicator);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduIndicator $myPosyanduIndicator
     * @return \Illuminate\Http\Response
     */
    public function restore(MyPosyanduIndicator $myPosyanduIndicator)
    {
        Gate::authorize('restore', $myPosyanduIndicator);

        return MyPosyanduIndicator::restoreRecord($myPosyanduIndicator);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduIndicator $myPosyanduIndicator
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyPosyanduIndicator $myPosyanduIndicator)
    {
        Gate::authorize('destroy', $myPosyanduIndicator);

        return MyPosyanduIndicator::destroyRecord($myPosyanduIndicator);
    }
}
