<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return "Redirect To";
    }
    public function redirectFrom(): RedirectResponse
    {
        return redirect("/redirect/to");
    }
    public function redirectHello(string $name): string
    {
        return "Hello $name";
    }
    public function redirectName(): RedirectResponse
    {
        return redirect()->route('redirect-hello', [
            "name" => "Iqbal"
        ]);
    }
    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], [
            'name' => 'Iqbal'
        ]);
    }
    public function redirectAway(): RedirectResponse
    {
        return redirect()->away("https://www.youtube.com/");
    }
}
