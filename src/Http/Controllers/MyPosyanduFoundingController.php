<?php

namespace Module\MyPosyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyPosyandu\Models\MyPosyanduFounding;
use Module\MyPosyandu\Http\Resources\FoundingCollection;
use Module\MyPosyandu\Http\Resources\FoundingShowResource;

class MyPosyanduFoundingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyPosyanduFounding::class);

        return new FoundingCollection(
            MyPosyanduFounding::applyMode($request->mode)
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
        Gate::authorize('create', MyPosyanduFounding::class);

        $request->validate([]);

        return MyPosyanduFounding::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduFounding $myPosyanduFounding
     * @return \Illuminate\Http\Response
     */
    public function show(MyPosyanduFounding $myPosyanduFounding)
    {
        Gate::authorize('show', $myPosyanduFounding);

        return new FoundingShowResource($myPosyanduFounding);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\MyPosyanduFounding $myPosyanduFounding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyPosyanduFounding $myPosyanduFounding)
    {
        Gate::authorize('update', $myPosyanduFounding);

        $request->validate([]);

        return MyPosyanduFounding::updateRecord($request, $myPosyanduFounding);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduFounding $myPosyanduFounding
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyPosyanduFounding $myPosyanduFounding)
    {
        Gate::authorize('delete', $myPosyanduFounding);

        return MyPosyanduFounding::deleteRecord($myPosyanduFounding);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduFounding $myPosyanduFounding
     * @return \Illuminate\Http\Response
     */
    public function restore(MyPosyanduFounding $myPosyanduFounding)
    {
        Gate::authorize('restore', $myPosyanduFounding);

        return MyPosyanduFounding::restoreRecord($myPosyanduFounding);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduFounding $myPosyanduFounding
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyPosyanduFounding $myPosyanduFounding)
    {
        Gate::authorize('destroy', $myPosyanduFounding);

        return MyPosyanduFounding::destroyRecord($myPosyanduFounding);
    }
}
