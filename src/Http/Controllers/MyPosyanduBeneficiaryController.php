<?php

namespace Module\MyPosyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyPosyandu\Models\MyPosyanduBeneficiary;
use Module\MyPosyandu\Http\Resources\BeneficiaryCollection;
use Module\MyPosyandu\Http\Resources\BeneficiaryShowResource;

class MyPosyanduBeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyPosyanduBeneficiary::class);

        return new BeneficiaryCollection(
            MyPosyanduBeneficiary::applyMode($request->mode)
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
        Gate::authorize('create', MyPosyanduBeneficiary::class);

        $request->validate([]);

        return MyPosyanduBeneficiary::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduBeneficiary $myPosyanduBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function show(MyPosyanduBeneficiary $myPosyanduBeneficiary)
    {
        Gate::authorize('show', $myPosyanduBeneficiary);

        return new BeneficiaryShowResource($myPosyanduBeneficiary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyPosyandu\Models\MyPosyanduBeneficiary $myPosyanduBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyPosyanduBeneficiary $myPosyanduBeneficiary)
    {
        Gate::authorize('update', $myPosyanduBeneficiary);

        $request->validate([]);

        return MyPosyanduBeneficiary::updateRecord($request, $myPosyanduBeneficiary);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduBeneficiary $myPosyanduBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyPosyanduBeneficiary $myPosyanduBeneficiary)
    {
        Gate::authorize('delete', $myPosyanduBeneficiary);

        return MyPosyanduBeneficiary::deleteRecord($myPosyanduBeneficiary);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduBeneficiary $myPosyanduBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function restore(MyPosyanduBeneficiary $myPosyanduBeneficiary)
    {
        Gate::authorize('restore', $myPosyanduBeneficiary);

        return MyPosyanduBeneficiary::restoreRecord($myPosyanduBeneficiary);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyPosyandu\Models\MyPosyanduBeneficiary $myPosyanduBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyPosyanduBeneficiary $myPosyanduBeneficiary)
    {
        Gate::authorize('destroy', $myPosyanduBeneficiary);

        return MyPosyanduBeneficiary::destroyRecord($myPosyanduBeneficiary);
    }
}
