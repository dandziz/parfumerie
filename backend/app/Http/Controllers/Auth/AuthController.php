<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\UserIsNotActivated;
use App\Exceptions\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginPostRequest;
use App\Models\User;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * @throws InternalServerErrorException
     * @throws UserIsNotActivated
     */
    public function login(LoginPostRequest $request): JsonResponse
    {
        $input = $request->validated();
        $check = Auth::guard()->attempt($input);
        if ($check) {
            $user = Auth::user();
            if ($user->email_verified_at != null) {
                $token = $user->createToken($user->name)->accessToken;
                return response()->json(['status' => true, 'data' => [
                    'user' => $user,
                    'token' => [
                        'access_token' => $token,
                        'token_type' => 'Bearer'
                    ],
                    'user_ability' => [$user->roles[0]->name, getPermissions($user->roles[0]->permissions)]
                ]], 200);
            } else {
                throw new UserIsNotActivated();
            }
        } else {
            throw new InternalServerErrorException();
        }
    }

    /**
     * @throws InternalServerErrorException
     */
    public function logout(): JsonResponse
    {
        try {
            $user = Auth::guard('api')->user();
            $user->token()->revoke();
            return response()->json(['status' => true, 'message' => 'Logout successfully!'], 200);
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
