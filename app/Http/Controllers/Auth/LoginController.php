<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function redirectTo()
    {
        if (!Auth::check()) {
            return '/';
        }
        
        $user = Auth::user();
        if ($user->role == 'admin') {
            return '/admin/dashboard';
        } elseif ($user->role == 'user') {
            return '/';
        }
        $redirectTo = '/';
        return $redirectTo;
    }
}
