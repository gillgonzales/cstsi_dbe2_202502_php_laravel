<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function authenticate(array $credentials): User | null{
        if(!Auth::attempt($credentials))
            return null;
        return User::where('email',$credentials['email'])->first();
    }

}
