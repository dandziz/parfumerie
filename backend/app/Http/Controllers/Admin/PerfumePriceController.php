<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PerfumePrice\StorePerfumePriceRequest;
use App\Http\Requests\Admin\PerfumePrice\UpdatePerfumePriceRequest;
use App\Models\PerfumePrice;

class PerfumePriceController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePerfumePriceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PerfumePrice $perfumePrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerfumePrice $perfumePrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerfumePriceRequest $request, PerfumePrice $perfumePrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerfumePrice $perfumePrice)
    {
        //
    }
}
