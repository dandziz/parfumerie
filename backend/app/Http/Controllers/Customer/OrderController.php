<?php

namespace App\Http\Controllers\Customer;

use App\Exceptions\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws InternalServerErrorException
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $user = Auth::guard('api')->user();
            $orders = $user->orders();
            return getItemsByRelationship($request, $orders);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
