<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Models\Brand;
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
        foreach ($query as $key => $item) {
            $brands->where($key, 'like', '%'.$item.'%');
        }
        $itemPerPage = $request->has('itemPerPage') ? (int)$request->get('itemPerPage') : 10;
        $pageNumber = $request->has('page') ? (int)$request->get('page') : 1;
        $brands = $brands->paginate($itemPerPage, ['*'], 'page', $pageNumber);
        return response()->json([
            "status" => true,
            "message" => __('success'),
            "pagination" => convertTypeOfPagination($brands),
            "data" => $brands->items(),
        ], 200);
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
            return response()->json([
                'status' => true,
                'messages' => __('messages.success'),
                'data' => $brand,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'messages' => __('messages.createFailed', ['name' => __('messages.brand')])
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $Brand)
    {
        return response()->json([
            'status' => true,
            'messages' => __('success'),
            'data' => $Brand
        ]);
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
    public function update(UpdateBrandRequest $request, Brand $Brand)
    {
        $data = $request->validated();
        $isUpdate = $Brand->update($data);
        if ($isUpdate) {
            return response()->json([], 204);
        } else {
            return response()->json([
                'status' => false,
                'messages' => __('messages.updateFailed', ['name' => __('messages.brand')]),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $Brand)
    {
        $isDelete = $Brand->delete();
        if ($isDelete) {
            return response()->json([], 204);
        } else {
            return response()->json([
                'status' => false,
                'messages' => __('messages.deleteFailed', ['name' => __('messages.brand')]),
            ], 500);
        }
    }
}

