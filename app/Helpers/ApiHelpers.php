<?php

namespace App\Helpers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;

class ApiHelpers
{
    public static function apiResponse($status, $data = [], $message = null){
        return new JsonResponse(
            [
                'status' => $status,
                'data' => $data,
                'message' => $message,
            ],
            Response::HTTP_OK
        );
    }

    public static function paginateResponse($data){
        return new JsonResponse(
            [
                'status' => 'success',
                'data' => $data,
                'pagination' => [
                    'total' => $data->count(),
                    'next_url' => $data->nextPageUrl(),
                ]
            ],
            Response::HTTP_OK
        );
    }

    public static function authResponse($status, $message)
    {
        return new JsonResponse(
            [
                'status' => $status,
                'message' => $message,
            ],
            (int)$status??Response::HTTP_OK
        );
    }
}
