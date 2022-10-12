<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Auth\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    private const AUTH_PATH = 'seller.auth.';

    public function loginForm()
    {
        return view(self::AUTH_PATH.'login');
    }

    public function login(Request $request)
    {
        $user = Seller::query()->where('is_active', true)->where(
            function ($q) use($request){
                return $q->where(function ($q) use ($request){
                    return $q->where('email',$request->input('email_phone'))->orWhere('phone',$request->input('email_phone'));
                });
            }
        )->first();

        if ($user){
            if (Auth::guard('seller')->attempt(
                [
                    'phone' => $user->phone,
                    'password' => $request->password,
                    'is_seller' => true,
                ], $request->get('remember'))) {
                $back = route('seller.home');
                if (session()->has('lastPage'))
                {
                    $back = session()->get('lastPage');
                }
                return redirect($back);
            }

        }
        return redirect()->route('seller.Login')->with(['error'=>__('auth.failed')]);

    }

    public function logout()
    {
        session()->put('lastPage', URL::previous());
        Auth::guard('seller')->logout();
        return redirect()->route('seller.Login');

    }
}
