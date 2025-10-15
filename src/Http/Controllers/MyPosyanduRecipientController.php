<?php

namespace Module\MyPosyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyPosyandu\Models\MyPosyanduRecipient;
use Module\MyPosyandu\Models\MyPosyanduActivity;
use Module\MyPosyandu\Http\Resources\RecipientCollection;
use Module\MyPosyandu\Http\Resources\RecipientShowResource;

class MyPosyanduRecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MyPosyanduActivity $myPosyanduActivity)
    {
        Gate::authorize('view', MyPosyanduRecipient::class);

        return new RecipientCollection(
            $myPosyanduActivity
                ->recipients()
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
        Gate::authorize('create', MyPosyanduRecipient::class);

        $request->validate([]);

        return MyPosyanduRecipient::storeRecord($request, $myPosyanduActivity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @param  \Module\MyPosyandu\Models\MyPosyanduRecipient $myPosyanduRecipient
     * @return \Illuminate\Http\Response
     */
    public function show(MyPosyanduActivity $myPosyanduActivity, MyPosyanduRecipient $myPosyanduRecipient)
    {
        Gate::authorize('show', $myPosyanduRecipient);

        return new RecipientShowResource($myPosyanduRecipient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @param  \Module\MyPosyandu\Models\MyPosyanduRecipient $myPosyanduRecipient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyPosyanduActivity $myPosyanduActivity, MyPosyanduRecipient $myPosyanduRecipient)
    {
        Gate::authorize('update', $myPosyanduRecipient);

        $request->validate([]);

        return MyPosyanduRecipient::updateRecord($request, $myPosyanduRecipient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduActivity $myPosyanduActivity
     * @param  \Module\MyPosyandu\Models\MyPosyanduRecipient $myPosyanduRecipient
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyPosyanduActivity $myPosyanduActivity, MyPosyanduRecipient $myPosyanduRecipient)
    {
        Gate::authorize('delete', $myPosyanduRecipient);

        return MyPosyanduRecipient::deleteRecord($myPosyanduRecipient);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduRecipient $myPosyanduRecipient
     * @return \Illuminate\Http\Response
     */
    public function restore(MyPosyanduActivity $myPosyanduActivity, MyPosyanduRecipient $myPosyanduRecipient)
    {
        Gate::authorize('restore', $myPosyanduRecipient);

        return MyPosyanduRecipient::restoreRecord($myPosyanduRecipient);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduRecipient $myPosyanduRecipient
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyPosyanduActivity $myPosyanduActivity, MyPosyanduRecipient $myPosyanduRecipient)
    {
        Gate::authorize('destroy', $myPosyanduRecipient);

        return MyPosyanduRecipient::destroyRecord($myPosyanduRecipient);
    }
}