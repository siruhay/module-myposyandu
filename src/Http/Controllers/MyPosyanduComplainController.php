<?php

namespace Module\MyPosyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyPosyandu\Models\MyPosyanduComplain;
use Module\MyPosyandu\Http\Resources\ComplainCollection;
use Module\MyPosyandu\Http\Resources\ComplainShowResource;

class MyPosyanduComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyPosyanduComplain::class);

        return new ComplainCollection(
            MyPosyanduComplain::applyMode($request->mode)
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
        Gate::authorize('create', MyPosyanduComplain::class);

        $request->validate([]);

        return MyPosyanduComplain::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduComplain $myPosyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function show(MyPosyanduComplain $myPosyanduComplain)
    {
        Gate::authorize('show', $myPosyanduComplain);

        return new ComplainShowResource($myPosyanduComplain);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\MyPosyanduComplain $myPosyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyPosyanduComplain $myPosyanduComplain)
    {
        Gate::authorize('update', $myPosyanduComplain);

        $request->validate([]);

        return MyPosyanduComplain::updateRecord($request, $myPosyanduComplain);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduComplain $myPosyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyPosyanduComplain $myPosyanduComplain)
    {
        Gate::authorize('delete', $myPosyanduComplain);

        return MyPosyanduComplain::deleteRecord($myPosyanduComplain);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduComplain $myPosyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function restore(MyPosyanduComplain $myPosyanduComplain)
    {
        Gate::authorize('restore', $myPosyanduComplain);

        return MyPosyanduComplain::restoreRecord($myPosyanduComplain);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduComplain $myPosyanduComplain
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyPosyanduComplain $myPosyanduComplain)
    {
        Gate::authorize('destroy', $myPosyanduComplain);

        return MyPosyanduComplain::destroyRecord($myPosyanduComplain);
    }
}
