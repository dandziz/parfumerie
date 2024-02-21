<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\StoreBrandRequest;
use App\Http\Requests\Admin\Brand\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->except(['itemPerPage', 'page']);
        $brands = Brand::query();
        return getItems($request, $query, $brands);
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
    public function store(StoreBrandRequest $request)
    {
        try {
            $brand = $request->validated();
            $user = Auth::guard('api')->user();
            $brand = Brand::create([...$brand, 'user_id' => $user->id]);
            return returnSuccessResponse($brand, 201);
        } catch (\Exception $e) {
            return returnFailureResponse(__('messages.createFailed', ['name' => __('messages.brand')]));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $Brand)
    {
        return returnSuccessResponse($Brand);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $Brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $Brand): JsonResponse
    {
        $data = $request->validated();
        $isUpdate = $Brand->update($data);
        if ($isUpdate) {
            return response()->json([], 204);
        } else {
            return returnFailureResponse(__('messages.updateFailed', ['name' => __('messages.brand')]));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $Brand): JsonResponse
    {
        $isDelete = $Brand->delete();
        if ($isDelete) {
            return response()->json([], 204);
        } else {
            return returnFailureResponse(__('messages.deleteFailed', ['name' => __('messages.brand')]));
        }
    }
}

