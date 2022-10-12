<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Mail\User_Reset_Password;
use App\Models\User;
use App\Models\Auth\Seller;
use App\Models\PasswordReset;
use App\Http\Requests\ResetPasswordRequest;
use App\Repositories\Website\UserRepository;

use \App\Jobs\ResetPassword;
//use App\Notifications\Mail\ResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected $UserRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('seller.auth.forgetPW');
    }

    public function sendResetEmailLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->input('email');

        $user = Seller::query()->where('email', $email)->select()->first();

        if ($user) {

            $code = genRandomCode('str', 60);

            $reset = PasswordReset::query()->where(['email'=>$email])->first();

            if ($reset){
                $reset->where(['email'=>$email])->update(['token' => $code,'created_at'=>now()]);
            }else{
                $reset->where(['email'=>$email])->create(['token' => $code,'created_at'=>now()]);
            }
            $url = route('password.reset', ['token' => $code]);

            try
            {
                ResetPassword::dispatch($user,$url)->delay(\Carbon\Carbon::now()->addSeconds(5));
            }catch (\Exception $e){}
            return redirect()->route('seller.forget.password')->with(['success' => __('auth.restPWSend')])->withInput(['email'=>$request->input('email')]);
        } else {
            return redirect()->route('seller.forget.password')->withErrors(['email' => __('passwords.user')])->withInput(['email'=>$request->input('email')]);
        }
    }

    public function showResetForm(Request $request){

        $token = $request->route()->parameter('token');
        $reset = PasswordReset::query()->where('token',$token)->first();
        if ($reset)
        {
            return view('seller.auth.resetPW')->with(
                ['token' => $token]
            );
        }else{
            return redirect()->route('seller.forget.password')->with(['error'=>__('passwords.invalidLink')]);
        }

    }

    public function reset(ResetPasswordRequest $request)
    {
        $reset = PasswordReset::query()->where('token',$request->input('token'))->first();
        if ($reset){
            $user = User::query()->where('email',$reset->email)->first();
//            return $user;
            try {
                DB::beginTransaction();
                    $this->UserRepository->resetPassword($user,bcrypt($request->input('new_password')));
                DB::commit();
                return redirect()->route('seller.Login')->with(['success'=>__('auth.passwordChangedSuccess')]);
            }catch (\Exception $e){
                DB::rollBack();
                return redirect()->route('seller.reset.form')->with(['error'=>__('auth.errorSetting')]);
            }
        }
        return redirect()->route('seller.reset.form')->with(['error'=>__('passwords.invalidLink')]);
    }
}
