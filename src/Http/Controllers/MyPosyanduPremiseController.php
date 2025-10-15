<?php

namespace Module\MyPosyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyPosyandu\Models\MyPosyanduPremise;
use Module\MyPosyandu\Models\MyPosyanduActivity;
use Module\MyPosyandu\Http\Resources\PremiseCollection;
use Module\MyPosyandu\Http\Resources\PremiseShowResource;

class MyPosyanduPremiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MyPosyanduActivity $myPosyanduActivity)
    {
        Gate::authorize('view', MyPosyanduPremise::class);

        return new PremiseCollection(
            $myPosyanduActivity
                ->premises()
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
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MyPosyanduActivity $myPosyanduActivity)
    {
        Gate::authorize('create', MyPosyanduPremise::class);

        $request->validate([]);

        return MyPosyanduPremise::storeRecord($request, $myPosyanduActivity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @param  \Module\MyPosyandu\Models\MyPosyanduPremise $myPosyanduPremise
     * @return \Illuminate\Http\Response
     */
    public function show(MyPosyanduActivity $myPosyanduActivity, MyPosyanduPremise $myPosyanduPremise)
    {
        Gate::authorize('show', $myPosyanduPremise);

        return new PremiseShowResource($myPosyanduPremise);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @param  \Module\MyPosyandu\Models\MyPosyanduPremise $myPosyanduPremise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyPosyanduActivity $myPosyanduActivity, MyPosyanduPremise $myPosyanduPremise)
    {
        Gate::authorize('update', $myPosyanduPremise);

        $request->validate([]);

        return MyPosyanduPremise::updateRecord($request, $myPosyanduPremise);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @param  \Module\MyPosyandu\Models\MyPosyanduPremise $myPosyanduPremise
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyPosyanduActivity $myPosyanduActivity, MyPosyanduPremise $myPosyanduPremise)
    {
        Gate::authorize('delete', $myPosyanduPremise);

        return MyPosyanduPremise::deleteRecord($myPosyanduPremise);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduPremise $myPosyanduPremise
     * @return \Illuminate\Http\Response
     */
    public function restore(MyPosyanduActivity $myPosyanduActivity, MyPosyanduPremise $myPosyanduPremise)
    {
        Gate::authorize('restore', $myPosyanduPremise);

        return MyPosyanduPremise::restoreRecord($myPosyanduPremise);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduPremise $myPosyanduPremise
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyPosyanduActivity $myPosyanduActivity, MyPosyanduPremise $myPosyanduPremise)
    {
        Gate::authorize('destroy', $myPosyanduPremise);

        return MyPosyanduPremise::destroyRecord($myPosyanduPremise);
    }
}
