<?php

namespace App\Http\Controllers\API\Auth;

interface MustVerifyApiEmailInterface
{
    public function hasVerifiedEmail();
    public function markEmailAsVerified();
    public function sendApiEmailVerificationNotification();
    public function getEmailForVerification();
}
