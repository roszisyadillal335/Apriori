<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard.index');
        }

        if ($user->role === 'customer') {
            return redirect()->route('user.show');
        }

        return redirect()->intended('/'); // fallback
    }
}
