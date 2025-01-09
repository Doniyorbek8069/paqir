<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Custom;
use App\Models\Order;
use App\Models\Sessions;
use App\Models\User;
use App\Services\DiscountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $check = [
            'login' => $request->login,
            'password' => $request->password
        ];

        if (Auth::guard('web')->attempt($check)) 
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function logout(Request $request) 
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }

    public function checklogin(Request $request)
    {
        $users=User::query()->where('login','=',$request->login)->first();
        if(empty($users)){
            echo "Pustoy";
        }
        else{
            echo "Band";
        }
    }
}