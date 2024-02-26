<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Perfume;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getAllBrands() {
        $brands = Brand::query()->select(['id', 'name'])->get();
        return response()->json([
            'status' => true,
            'messages' => __('messages.success'),
            'data' => $brands,
        ]);
    }

    public function getAllPerfumes(): JsonResponse
    {
        $male = Perfume::query()
            ->where('status', 1)
            ->limit(20)
            ->get();
        return returnSuccessResponse($male);
    }

    public function getPerfumeBySlug($slug): JsonResponse
    {
        $perfume = Perfume::query()->where('slug', $slug)
            ->firstOrFail()->makeVisible(['product_information', 'price', 'media']);
        return returnSuccessResponse($perfume);
    }

}
