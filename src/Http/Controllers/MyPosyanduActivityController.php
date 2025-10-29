<?php

namespace Module\MyPosyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyPosyandu\Models\MyPosyanduActivity;
use Module\MyPosyandu\Http\Resources\ActivityCollection;
use Module\MyPosyandu\Http\Resources\ActivityShowResource;

class MyPosyanduActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyPosyanduActivity::class);

        return new ActivityCollection(
            MyPosyanduActivity::with(['funding', 'service'])
                ->forCurrentUser($request->user())
                ->applyMode($request->mode)
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
        Gate::authorize('create', MyPosyanduActivity::class);

        $request->validate([]);

        return MyPosyanduActivity::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function show(MyPosyanduActivity $myPosyanduActivity)
    {
        Gate::authorize('show', $myPosyanduActivity);

        return new ActivityShowResource($myPosyanduActivity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyPosyanduActivity $myPosyanduActivity)
    {
        Gate::authorize('update', $myPosyanduActivity);

        $request->validate([]);

        return MyPosyanduActivity::updateRecord($request, $myPosyanduActivity);
    }

    /**
     * posted function
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function posted(Request $request, MyPosyanduActivity $myPosyanduActivity)
    {
        Gate::authorize('update', $myPosyanduActivity);

        $request->validate([]);

        return MyPosyanduActivity::postedRecord($request, $myPosyanduActivity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyPosyanduActivity $myPosyanduActivity)
    {
        Gate::authorize('delete', $myPosyanduActivity);

        return MyPosyanduActivity::deleteRecord($myPosyanduActivity);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function restore(MyPosyanduActivity $myPosyanduActivity)
    {
        Gate::authorize('restore', $myPosyanduActivity);

        return MyPosyanduActivity::restoreRecord($myPosyanduActivity);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyPosyanduActivity $myPosyanduActivity)
    {
        Gate::authorize('destroy', $myPosyanduActivity);

        return MyPosyanduActivity::destroyRecord($myPosyanduActivity);
    }
}
