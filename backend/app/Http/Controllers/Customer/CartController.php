<?php

namespace App\Http\Controllers\Customer;

use App\Exceptions\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Cart\StoreCartRequest;
use App\Http\Requests\Customer\Cart\UpdateCartRequest;
use App\Models\Cart;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws InternalServerErrorException
     */
    public function index(): JsonResponse
    {
        try {
            $user = Auth::guard('api')->user();
            $carts = $user->cart;
            return returnSuccessResponse($carts);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
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
    public function store(StoreCartRequest $request): JsonResponse
    {
        try {
            $user = Auth::guard('api')->user();
            $cart = Cart::query()->create($request->validated() + ['user_id' => $user->id]);
            return returnSuccessResponse($cart, 201);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
