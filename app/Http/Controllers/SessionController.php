<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        $request->session()->put("userId", "iqbal");
        $request->session()->put("isMember", true);
        return "OK";
    }
    public function getSession(Request $request): string
    {
        $userId = $request->session()->get('userId', 'guest');
        $isMember = $request->session()->get('isMember', "false");

        return "User Id : ${userId}, Is Member : ${isMember}";
    }
}
