<?php

namespace App\service;

use Illuminate\Support\Facades\Auth;

class RedirectUser
{
    public static function redirect()
    {
        $user = Auth::user();

        if ($user) {
            if($user->checkRole(1)) {
                return redirect()->route('dashboard.index');
            }
            return self::redirect()->route('home');
        }
    }
}
