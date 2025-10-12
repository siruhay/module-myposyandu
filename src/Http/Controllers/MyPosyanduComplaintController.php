<?php

namespace Module\MyPosyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyPosyandu\Models\MyPosyanduComplaint;
use Module\MyPosyandu\Http\Resources\ComplaintCollection;
use Module\MyPosyandu\Http\Resources\ComplaintShowResource;

class MyPosyanduComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyPosyanduComplaint::class);

        return new ComplaintCollection(
            MyPosyanduComplaint::applyMode($request->mode)
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
        Gate::authorize('create', MyPosyanduComplaint::class);

        $request->validate([]);

        return MyPosyanduComplaint::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduComplaint $myPosyanduComplaint
     * @return \Illuminate\Http\Response
     */
    public function show(MyPosyanduComplaint $myPosyanduComplaint)
    {
        Gate::authorize('show', $myPosyanduComplaint);

        return new ComplaintShowResource($myPosyanduComplaint);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\MyPosyanduComplaint $myPosyanduComplaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyPosyanduComplaint $myPosyanduComplaint)
    {
        Gate::authorize('update', $myPosyanduComplaint);

        $request->validate([]);

        return MyPosyanduComplaint::updateRecord($request, $myPosyanduComplaint);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduComplaint $myPosyanduComplaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyPosyanduComplaint $myPosyanduComplaint)
    {
        Gate::authorize('delete', $myPosyanduComplaint);

        return MyPosyanduComplaint::deleteRecord($myPosyanduComplaint);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduComplaint $myPosyanduComplaint
     * @return \Illuminate\Http\Response
     */
    public function restore(MyPosyanduComplaint $myPosyanduComplaint)
    {
        Gate::authorize('restore', $myPosyanduComplaint);

        return MyPosyanduComplaint::restoreRecord($myPosyanduComplaint);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduComplaint $myPosyanduComplaint
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyPosyanduComplaint $myPosyanduComplaint)
    {
        Gate::authorize('destroy', $myPosyanduComplaint);

        return MyPosyanduComplaint::destroyRecord($myPosyanduComplaint);
    }
}
