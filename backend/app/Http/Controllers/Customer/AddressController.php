<?php

namespace App\Http\Controllers\Customer;

use App\Exceptions\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Address\StoreAddressRequest;
use App\Models\Address;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\UnauthorizedException;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws InternalServerErrorException
     */
    public function index()
    {
        try {
            $user = Auth::guard('api')->user();
            $data = $user->address;
            return returnSuccessResponse($data);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    public function getNumberOfAddresses() {
        try {
            $user = Auth::guard('api')->user();
            $count = $user->address->count();
            return returnSuccessResponse($count);
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
    public function store(StoreAddressRequest $request): JsonResponse
    {
        try {
            $user = Auth::guard('api')->user();
            $builder = $user->address()->where('default', 1);
            $count = $builder->get()->count();
            $data = $request->validated();
            if ($count == 0) {
                $data['default'] = 1;
            } else if ($data['default'] == 1) {
                $builder->update(['default' => 0]);
            }
            $address = Address::create($data + [
                'user_id' => $user->id,
            ]);
            return returnSuccessResponse($address, 201);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAddressRequest $request, $id)
    {
        $address = Address::findOrFail($id);
        try {
            $user = Auth::guard('api')->user();
            $builder = $user->address()->where('default', 1);
            $count = $builder->get()->count();
            $data = $request->validated();
            if ($count == 0) {
                $data['default'] = 1;
            } else if ($data['default'] == 1 && $address->default != 1) {
                $builder->update(['default' => 0]);
            } else if ($data['default'] == 0 && $address->default == 1) {
                $data['default'] = 1;
            }
            if ($address->user_id != $user->id)
                throw new UnauthorizedException();
            $address->update($data);
            return response([], 204);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        try {
            $user = Auth::guard('api')->user();
            if ($address->user_id != $user->id)
                throw new UnauthorizedException();
            if ($address->default == 1 && $user->address->count() > 1) {
                Address::query()->whereNotIn('id', [$address->id])->inRandomOrder()->first()->update(['default' => 1]);
            }
            $address->delete();
            return response([], 204);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }
}
