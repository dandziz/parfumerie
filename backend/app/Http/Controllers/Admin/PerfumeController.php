<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Perfume\StorePerfumeRequest;
use App\Http\Requests\Admin\Perfume\UpdatePerfumeRequest;
use App\Models\Perfume;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->except(['itemPerPage', 'page']);
        $perfumes = Perfume::query();
        return getItems($request, $query, $perfumes);
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
     * @throws InternalServerErrorException
     */
    public function store(StorePerfumeRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::guard('api')->user();
        $data = $request->validated() + ['user_id' => $user->id];
        //try {
            $perfume = Perfume::query()->create($data);
            return returnSuccessResponse($perfume, 201);
        //} catch (Exception $exception) {
            //throw new InternalServerErrorException();
        //}
    }

    /**
     * Display the specified resource.
     */
    public function show(Perfume $perfume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perfume $perfume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerfumeRequest $request, Perfume $perfume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perfume $perfume)
    {
        //
    }
}
