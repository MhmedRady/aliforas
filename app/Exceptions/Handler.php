<?php

namespace App\Exceptions;

use App\Helpers\ApiHelpers;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {

        // Here you can return your own response or work with request
        // return response()->json(['status' : false], 401);

        // This is the default
        return $request->expectsJson()
            ? ApiHelpers::authResponse(401, $exception->getMessage())
            : redirect()->guest($exception->redirectTo() ?? route('index'));
    }
}
