<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Repositories\Website\UserRepository;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $UserRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest');
        $this->UserRepository = $userRepository;
    }

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        $reset = PasswordReset::query()->where('token',$token)->first();
        if ($reset)
        {
            return view('root.auth.passwords.reset')->with(
                ['token' => $token]
            );
        }else{
            return redirect()->route('password.request')->with(['error'=>__('passwords.invalidLink')]);
        }

    }

    public function reset(ResetPasswordRequest $request)
    {

        $reset = PasswordReset::query()->where('token',$request->input('token'))->first();
        if ($reset){
            $user = User::query()->where('email',$reset->email)->first();
            try {
                DB::beginTransaction();
                    $this->UserRepository->resetPassword($user,bcrypt($request->input('new_password')));
                DB::commit();
                return redirect()->route('login')->with(['success'=>__('auth.passwordChangedSuccess')]);
            }catch (\Exception $e){
                DB::rollBack();
                return redirect()->back()->with(['error'=>__('auth.errorSetting')]);
            }
        }
        return redirect()->route('password.request')->with(['error'=>__('passwords.invalidLink')]);
    }

}
