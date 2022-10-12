<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Mail\resetPassword;
use App\Models\Auth\User;

class ResetPasswordController extends Controller
{
    /**
     * find if email is inserted in database or not,
     * if it there then the backend will send resetpassword mail for it
     * and return message if not will return error this mail not match our records
     * @param App\Http\Requests\Auth\ResetPasswordRequest $request
     * @return Illuminate\Http\Response
     */
    public function forgotPwd(ResetPasswordRequest $request)
    {
        $user = User::where($request->validated())->first();

        Mail::to($user->email)->send(new resetPassword($user));
        return response()->json([
            'message' => [Lang::get('passwords.send')],
            'errors' => []
        ],201);
    }
}
