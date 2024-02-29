<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidCredentialException;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\UserIsNotActivatedException;
use App\Exceptions\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginPostRequest;
use App\Http\Requests\Auth\LoginSocialRequest;
use App\Models\User;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{

    /**
     * @throws InvalidCredentialException
     * @throws InternalServerErrorException
     * @throws UserIsNotActivatedException
     * @throws UnauthorizedException
     */
    public function login(LoginPostRequest $request): JsonResponse
    {
        $input = $request->validated();
        $check = Auth::guard()->attempt($input);
        if ($check) {
            $user = Auth::user();
            if ($user->email_verified_at == null) {
                throw new UnauthorizedException();
            }
            if ($user->status == 0) {
                throw new UserIsNotActivatedException();
            }
            $user->forceFill([
                'provider' => 'local'
            ])->save();
            return $this->generateAndReturnToken($user);
        } else {
            throw new InvalidCredentialException();
        }
    }

    /**
     * @throws InternalServerErrorException
     */
    public function logout(): JsonResponse
    {
        $user = Auth::guard('api')->user();
        $user->token()->revoke();
        try {
            if ($user->provider == 'google') {
                Http::get('https://accounts.google.com/o/oauth2/revoke', [
                    'token' => $user->social_token,
                ]);
            }
            $user->forceFill([
                'social_token' => null,
                'provider' => null
            ])->save();
            return response()->json(['status' => true, 'message' => 'Logout successfully!'], 200);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * @throws InternalServerErrorException
     * @throws UnauthorizedException
     */
    public function loginWithSocial(LoginSocialRequest $request): JsonResponse
    {
        try {
            $token = $request->get('token');
            $provider = $request->get('provider');
            $userDetails = Socialite::driver('google')->userFromToken($token);
        } catch (Exception $exception) {
            throw new UnauthorizedException();
        }
        try {
            $profile = $this->loginWithGoogle($userDetails);

            $user = User::query()->where('email', $profile['email'])->first();
            if (!$user) {
                $role = Role::query()->where('name', 'user')->get();
                $user = User::query()->create([
                    'name' => $profile['name'],
                    'email' => $profile['email'],
                    'password' => bcrypt(Str::random(8)),
                ]);
                $user->assignRole($role);
            }
            $user->forceFill([
                'status' => 1,
                'email_verified_at' => Carbon::now(),
                'social_token' => $token,
                'provider' => $provider
            ])->save();

            return $this->generateAndReturnToken($user);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    public function loginWithGoogle($userDetails): array
    {
        return [
            'name' => $userDetails->getName(),
            'email' => $userDetails->getEmail(),
        ];
    }

    /**
     * @throws InternalServerErrorException
     */
    public function generateAndReturnToken($user): JsonResponse
    {
        try {
            $token = $user->createToken($user->name)->accessToken;
            $address = $user->address()->get()->count();
        } catch(Exception $e) {
            throw new InternalServerErrorException();
        }
        return response()->json(['status' => true, 'data' => [
            'user' => $user,
            'token' => [
                'access_token' => $token,
                'token_type' => 'Bearer'
            ],
            'user_ability' => [$user->roles[0]->name, getPermissions($user->roles[0]->permissions)],
            'address' => $address
        ]], 200);
    }

}
