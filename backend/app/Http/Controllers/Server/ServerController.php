<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServerController extends Controller
{
    public function index() {
        $previousRouteName = Session::get('previousRoute');
        if (!is_null($previousRouteName)) {
            if ($previousRouteName != 'verification.api.verify')
                abort(500);
        } else
            abort(500);
        Session::forget('previousRoute');
        return view('email_activation');
    }
}
