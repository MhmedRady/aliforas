<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Mail\User_Reset_Password;
use App\Models\User;
use App\Models\PasswordReset;

use \App\Jobs\ResetPassword;
//use App\Notifications\Mail\ResetPassword;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('root.auth.passwords.email');
    }

    public function sendResetEmailLink(Request $request)
    {

        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->input('email');

        $user = User::query()->where('email', $email)->select()->first();

        if ($user) {

            $code = genRandomCode('str', 60);

            $reset = PasswordReset::query()->firstOrNew(['email'=>$email]);
            $reset->fill(['token' => $code,'created_at'=>now()])->save();

            $url = route('password.reset', ['token' => $code]);

            try
            {
                ResetPassword::dispatch($user,$url)->delay(\Carbon\Carbon::now()->addSeconds(5));
            }catch (\Exception $e){}

            return redirect()->route('password.request')->with(['status' => __('auth.restPWSend')])->withInput($request->input());
        } else {
            return redirect()->route('password.request')->withErrors(['email' => __('passwords.user')])->withInput($request->input());
        }
    }
}
