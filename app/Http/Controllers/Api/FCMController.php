<?php

namespace App\Http\Controllers\Api;

use App\Models\Auth\User;
use App\Helpers\ApiHelpers;
use App\Models\OrderStatus;
use Illuminate\Http\Response;
use App\Models\UserMobileTokens;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class FCMController extends Controller
{
    public static function sendNotification($user_id, $statusid)
    {
        $FcmToken = UserMobileTokens::where('user_id', $user_id)->pluck('device_key')->all();
        $status = OrderStatus::find($statusid);

        $msgtitle = ($status->name == 'New')  ? 'Congratulations New Order.' : 'An Update Occurred to Your Order';
        $msgBody = ($status->name == 'New')  ? 'Congratulations Your Order Has been Placed.' : "You Order Status Has been Changed to be {$status->name}.";

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $msgtitle,
                "body"  => $msgBody,
            ],
        ];

        $result =  static::request('https://fcm.googleapis.com/fcm/send', $data);

        return ApiHelpers::apiResponse('success', [], 'Success.');
    }

    private static function request($url, $payload, $method = 'post')
    {
        return Http::withHeaders([
            'Authorization' => 'key=' . env('FIREBASE_SERVER_KEY'),
            'Content-Type'  => 'application/json'
        ])->{$method}($url, $payload);
    }
}
