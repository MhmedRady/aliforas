<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLogin;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCollection;
use Darryldecode\Cart\Exceptions\InvalidItemException;
use Darryldecode\Cart\Facades\CartFacade;
use Darryldecode\Cart\ItemCollection;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = '/';

    protected string $sessionCartId;
    protected CartCollection $sessionCartItems;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$this->guard()->check()) {
                $this->sessionCartId = Session::getId();
                $this->sessionCartItems = userCart()->getContent();
            }
            return $next($request);
        })->only('login');
        $this->middleware('guest:web')->except('logout');
    }

    public function showLoginForm()
    {
        return view('root.auth.login');
    }

    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), [
            'is_active' => true
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     * @throws InvalidItemException
     */
    protected function sendLoginResponse(Request $request)
    {
        if ($this->sessionCartItems->count() > 0) {
            $this->sessionCartItems->each(function (ItemCollection $item) use (&$userCart) {
                userCart()->add(array_merge($item->only(['id', 'name', 'quantity', 'attributes', 'price'])->toArray(), [
                    'associatedModel' => $item->get('associatedModel')
                ]));
            });
            CartFacade::session($this->sessionCartId)->clear();
        }

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    public function checkoutUserLogin(UserLogin $request)
    {
        $user = [
                    'email'=>$request->input('email'),
                    'password'=>$request->input('password'),
                ];

        if (Auth::guard('web')->attempt($user)){
            return redirect()->route('cart.checkout');
        }else{
            return redirect()->back()->with(['error'=>__('auth.failed2')]);
        }
    }

}
