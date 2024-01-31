<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function getAllBrands() {
        $brands = Brand::query()->select(['id', 'name'])->get();
        return response()->json([
            'status' => true,
            'messages' => __('messages.success'),
            'data' => $brands,
        ]);
    }
}
