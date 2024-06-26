<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyEmail\ResendEmailRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class VerificationApiController extends Controller
{
    public function verify(Request $request) {
        try {
            $user = User::find($request->route('id'));
            if (!is_null($user)) {
                if (!is_null($user->email_verified_at)) {
                    throw new Exception();
                }
                if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
                    throw new Exception;
                }
                $user->markEmailAsVerified();
                $currentRouteName = $request->route()->getName();
                Session::put('previousRoute', $currentRouteName);

                return redirect('email-activation');
            } else {
                throw new Exception();
            }
        } catch(Exception $e) {
            return abort(500);
        }
    }

    /**
     * @throws InternalServerErrorException
     */
    public function resend(ResendEmailRequest $request): JsonResponse
    {
        try {
            $user = User::query()->where('email', $request->get('email'))->first();
            if (!is_null($user->email_verified_at)) {
                return response()->json([
                    'status' => true,
                    'message' => __('messages.emailHadVerified')
                ], 422);
            }
            $user->sendApiEmailVerificationNotification();
            return response()->json([
                'status' => true,
                'message' => __('messages.emailResendSuccessfully')
            ], 200);
        } catch(Exception $exception) {
            throw new InternalServerErrorException();
        }
    }
}
