<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginPostRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function login(LoginPostRequest $request): JsonResponse
    {
        $input = $request->validated();
        $check = Auth::attempt($input);
        if ($check) {
            $user = Auth::user();
            $token = $user->createToken($user->name)->accessToken;
            Log::info('User failed to login.', ['id' => $user->id]);
            return response()->json(['status' => true, 'data' => [
                'user' => $user,
                'token' => [
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ]
            ]], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Invalid credentials!'
            ], 401);
        }
    }

    public function logout(): JsonResponse
    {
        $user = Auth::guard('api')->user();
        $user->token()->revoke();
        return response()->json(['status' => true, 'message' => 'Logout successfully!'], 200);
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
