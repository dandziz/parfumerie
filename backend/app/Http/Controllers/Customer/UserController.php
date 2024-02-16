<?php

namespace App\Http\Controllers\Customer;

use App\Exceptions\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ChangePasswordRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getUserDetail(): JsonResponse
    {
        $user = Auth::guard('api')->user();
        return response()->json(['status' => true, 'message' => ['Get user successfully!'], 'data' => $user], 200);
    }

    /**
     * @throws InternalServerErrorException
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        try {
            $user = Auth::guard('api')->user();
            $user->update(['password' => $request->get('password')]);
            return response()->json([
                'status' => true,
                'message' => __('messages.updatePasswordSuccessfully')
            ], 200);
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
