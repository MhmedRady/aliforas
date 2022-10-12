<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialLoginController extends Controller
{
    function facebookRedirectToProvider(Request $request)
    {
        if ($request->has('fb_callback_redirect'))
            Session::put('fb_callback_redirect', $request->get('fb_callback_redirect'));
        return Socialite::driver('facebook')->redirect();
    }

    function facebookHandleProviderCallback(Request $request)
    {
        try {
            $state = null;
            if ($request->has('state'))
                $state = json_decode($request->get('state'));
            /** @var \Laravel\Socialite\Two\User $fbUser */
            $fbUser = Socialite::driver('facebook')->user();

            /** @var User $user */
            $user = User::query()->where('email', $fbUser->email)->first();

            if (is_null($user))
                return redirect()->to(Session::pull('fb_callback_redirect', route('login')))->withErrors((function () {
                    $errorBag = new MessageBag();
                    $errorBag->add('email', __("auth.FB_login_ERR"));
                    return $errorBag;
                })());

            if (is_null($user->profile_image) && !is_null($fbUser->avatar)) {
                $disk = Storage::disk('public');
                if (!$disk->exists('uploads/users'))
                    $disk->makeDirectory('uploads/users');
                $imgPath = time() . '-' . $fbUser->id . '.jpg';
                $image = Image::make($fbUser->getAvatar(250));
                $image->save($disk->path("uploads/users/$imgPath"));
                $user->update(['profile_image' => $imgPath]);
            }
            auth()->login($user);
            return redirect()->to(Session::pull('fb_callback_redirect', route('index', 'home')));
        } catch (\Exception $exception) {
            return redirect()->to(Session::pull('fb_callback_redirect', route('login')))->withErrors((function () {
                $errorBag = new MessageBag();
                $errorBag->add('email', __("auth.FB_login_ERR"));
                return $errorBag;
            })());
        }
    }

//    function findOrCreate($user, $provider)
//    {
//        if ($user) {
//            $userName = $user["name"];
//            $userEmail = $user["email"] ? $user["email"] : $user["id"];
//            // add this user to database
//
//            $userDatabaseRecord = User::where('email', $userEmail)->first();
//
//            if (!$userDatabaseRecord) {
//
//                try {
//
//                    DB::beginTransaction();
//                    $userDatabaseRecord = User::create([
//                        'name' => $userName,
//                        'email' => $userEmail,
//                        'password' => bcrypt($user["id"]),
//                        'provider' => $provider,
//                        "is_active" => 1,
//                        'email_verified_at' => Carbon::now()
//                    ]);
//
//                    // save details data
//                    UserDetail::create([
//                        'first_name' => $userName,
//                        'user_id' => $userDatabaseRecord->id,
//                        'email' => $userEmail
//                    ]);
//                    DB::commit();
//                } catch (Exception $th) {
//                    DB::rollback();
//                    return redirect()->to("/login")->withErrors(__("auth.FB_login_ERR"));
//                }
//
//                if (_AUTH::attempt(['email' => $userEmail, 'password' => $user["id"]])) {
//                    return redirect()->to("/");
//                } else {
//                    return redirect()->to("/login")->withErrors(__("auth.FB_login_ERR"));
//                }
//            } else {
//                if (_AUTH::loginUsingId($userDatabaseRecord->id)) {
//                    return redirect()->to("/");
//                } else {
//                    return redirect()->to("/login")->withErrors(__("auth.FB_login_ERR"));
//                }
//            }
//
//
//            //auth()->login($userDatabaseRecord);
//        }
//
//
//        return redirect()->to('/');
//    }
//
//    public function getHTTP($url)
//    {
//        /* $client = new \GuzzleHttp\Client();
//
//        $request = $client->get($url); */
//        $request = file_get_contents($url);
//
//        return json_decode($request, true);
//    }
//
//    function googleRedirectToProvider()
//    {
//        return Socialite::driver('google')->redirect();
//    }
//
//    function googleHandleProviderCallback()
//    {
//        // user instance
//        $user = Socialite::driver('google')->user();
//        return $this->createUser($user, 'google');
//    }
//
//    function twitterRedirectToProvider()
//    {
//        return Socialite::driver('twitter')->redirect();
//    }
//
//    function twitterHandleProviderCallback()
//    {
//        // user instance
//        $user = Socialite::driver('twitter')->user();
//        return $this->createUser($user, 'twitter');
//    }
//
//    function createUser($user, $provider)
//    {
//        // user accepted the driver api
//        if ($user) {
//            $userName = $user->getName();
//            $userEmail = $user->getEmail() ?: '';
//            // add this user to database
//            $userDatabaseRecord = User::where('email', $user->getEmail())->first();
//            if (!$userDatabaseRecord) {
//                $userDatabaseRecord = User::create([
//                    'name' => $userName,
//                    'email' => $userEmail,
//                    'password' => bcrypt($user->getId()),
//                    'provider' => $provider,
//                    'email_verified_at' => Carbon::now()
//                ]);
//                // save details data
//                UserDetail::create([
//                    'first_name' => $userName,
//                    'user_id' => $userDatabaseRecord->id,
//                    'email' => $userEmail
//                ]);
//            }
//            auth()->attempt(['email' => $userEmail, 'password' => $user->getId()]);
//            //auth()->login($userDatabaseRecord);
//        }
//
//
//        return redirect()->to('/');
//    }
}
