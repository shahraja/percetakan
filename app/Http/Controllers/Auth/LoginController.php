<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function redirectTo()
    {
        if(auth()->user()->role == 'admin'){
                $redirectTo = '/admin/dashboard';
                return $redirectTo;
            }
        else if(auth()->user()->role == 'user'){
                $redirectTo = '/';
                return $redirectTo;
            }
        else {
                $redirectTo = '/login';
                return $redirectTo;
        }
        
    }
}
