<?php

namespace App\Http\Controllers\Customer;

use App\Exceptions\InternalServerErrorException;
use App\Exceptions\NotFoundApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Cart\StoreCartRequest;
use App\Http\Requests\Customer\Cart\UpdateCartRequest;
use App\Models\Cart;
use App\Models\PerfumePrice;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            $perfume_id = $request->get('perfume_id');
            $price_id = $request->get('price_id');
            $quantity = $request->get('quantity');
            $cart = $user->cart()->where('perfume_id', $perfume_id)
                ->where('price_id', $price_id)->first();
            if($cart) {
                $currentQuantity = $cart->quantity;
                $cart->update(['quantity' => $quantity + $currentQuantity]);
                $code = 204;
            } else {
                $cart = Cart::query()->create($request->validated() +
                    ['user_id' => $user->id]);
                $code = 201;
            }
            return returnSuccessResponse($cart, $code);
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
     * @throws InternalServerErrorException
     */
    public function update(UpdateCartRequest $request, $id): JsonResponse
    {
        try {
            $quantity = $request->get('quantity');
            $user = Auth::guard('api')->user();
            $user->cart()->where('id', $id)->update(['quantity' => $quantity]);
            return returnSuccessResponse(null, 204);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }

    }

    /**
     * Remove the specified resource from storage.
     * @throws NotFoundApiException
     * @throws InternalServerErrorException
     */
    public function destroy($cart)
    {
        try {
            $user = Auth::guard('api')->user();
            $cart = $user->cart()->where('id', $cart)->first();
            if ($cart) {
                $cart->delete();
                return returnSuccessResponse(null, 204);
            } else {
                throw new NotFoundApiException();
            }
        } catch (NotFoundApiException $exception) {
            throw new NotFoundApiException();
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }
}
