<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Offer::class);
        $data['categories']=Category::all();
        $data['locations']=Location::all();
        return view('offer.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {
        $this->authorize('create', Offer::class);
        $data=array_merge([
            'author_id'=> Auth()->user()->id
        ], $request->all());

        $offer=Offer::create($data);
        //insert pivote table
        $offer->categories()->sync($request->get('categories')); //In select option value=id, so it return an array of id.
        $offer->locations()->sync($request->get('locations')); //In select option value=id, so it return an array of id.
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
