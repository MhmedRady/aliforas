<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\FacebookRegister;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\Auth\User;
use App\Models\UserDetails;
use Throwable;

class RegisterController extends Controller
{
    /**
     * will validating the request and create user
     * then send verification mail him if email not real will rise un error
     * asking him to send real email
     * @param App\Http\Requests\Auth\RegisterRequest $request
     * @return Illuminate\Http\Response
    */
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        try{
            mail::to($validatedData['email'])->send(new VerifyEmail($validatedData['email']));

            $validatedData['password'] = bcrypt($validatedData['password']);
            User::create($validatedData);

            UserDetails::create([
                'phone' => $validatedData['contact_number'],
                'email' => $validatedData['email']
            ]);

            return response()->json([
                'message' =>  [Lang::get('auth.register')],
                'errors' => []
            ], 201);

        } catch(Throwable $exception){
            return $exception;
            report($exception);
            return response()->json([
                'message' =>  [Lang::get('auth.email')],
                'errors' => []
            ], 422);
        }

    }

    public function registerFacebook(FacebookRegister $request)
    {
        $validatedData = $request->validated();
        try{
            $validatedData['password'] = bcrypt($validatedData['password']);
            $validatedData['email_verified_at'] = now();
            $validatedData['verification_code'] = rand(1,4);
            $validatedData['is_active'] = true;
            User::create($validatedData);

            UserDetails::create([
                'phone' => $validatedData['contact_number'],
                'email' => $validatedData['email']
            ]);

            return response()->json([
                'message' =>  [Lang::get('auth.register')],
                'errors' => []
            ], 201);

        } catch(Throwable $exception){
            return $exception;
            report($exception);
            return response()->json([
                'message' =>  [Lang::get('auth.email')],
                'errors' => []
            ], 422);
        }

    }
}
