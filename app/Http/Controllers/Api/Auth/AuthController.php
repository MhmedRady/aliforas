<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Api\UserForgetPassword;
use App\Http\Resources\SellerBranchResource;
use App\Models\Branch;
use App\Models\Auth\User;
use App\Helpers\ApiHelpers;
use App\Models\UserAddress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Http\Response;
use App\Models\UserMobileTokens;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ForgetPassword;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserAddressResource;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\UserProfileRequest;

class AuthController extends Controller
{
    /**
     * Register a new User
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['password'] = Hash::make($request['password']);
        $data['is_active'] = true;

        try {
            DB::beginTransaction();
            $user = User::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiHelpers::apiResponse('error', ['error' => __('auth.FB_login_ERR')]);
        }

//        $token = $user->createToken("User-{$user->id}-" . time());

        $data = [
//            'token' => "Bearer {$token->plainTextToken}",
            'user' => $user->only(['id', 'name', 'email', 'phone', 'dob', 'gender', 'profile_image', 'first_name', 'last_name' ])
        ];
        return ApiHelpers::apiResponse('success', $data);
    }

    /**
     * Login Into The App
     * we need to replace later to convert,
     * it to jwt token for more security
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->post('phone'))
        {
            $validatedData = $request->only(['phone', 'password']);
        }

        if ($request->post('email')) {
            $validatedData = $request->only(['email', 'password']);
        }

        if (Auth::attempt($validatedData)) {
            /** @var User $user */
            $user = Auth::user();

            $token = $request->user()->createToken("User-{$user->id}-" . time());
            $user->save();

            $data = [
                'token' => "Bearer {$token->plainTextToken}",
                'user' => $request->user()->only(['id', 'name', 'email', 'phone', 'dob', 'gender', 'profile_image'])
            ];

            $existingTokens = UserMobileTokens::where('user_id', $user->id)->get();
            if ($existingTokens->count() > 0) {
                foreach ($existingTokens as $token) {
                    $token->delete();
                }
            }

            if ($request->has('device_key')) {
                UserMobileTokens::create([
                    'user_id'       =>  $user->id,
                    'device_key'    =>  $request->device_key,
                    'device_type'   =>  $request->device_type,
                ]);
            }

            return ApiHelpers::apiResponse('success', $data);
        } else {
            return ApiHelpers::apiResponse('error', ['error' => Lang::get('auth.failed2')]);
        }
    }

    /**
     * Destroy the token and logout.
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();
            return ApiHelpers::apiResponse('success', [], Lang::get('auth.logout'));
        } catch (\Exception $e) {
            return ApiHelpers::apiResponse('success', [], Lang::get('layouts.sorry'));
        }
    }

    /**
     * Destroy the token and logout.
     * @return JsonResponse
     */
    public function me(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $request->user()->only(['id', 'name', 'email', 'phone', 'dob', 'gender', 'profile_image'])
            ]
        ]);
    }

    public function forgetPassword(UserForgetPassword $request): JsonResponse
    {

//        return ApiHelpers::apiResponse('error', $request);

        if ($request->has('phone'))
            $user = User::where('phone', $request->post('phone'))->first();
        else
            $user = User::where('email', $request->post('email'))->first();


        if (!$user)
            return ApiHelpers::apiResponse('error', [], __('auth.UserNotExist'));

        $tempPassword = genRandomCode('int', 4);

        try {
            DB::beginTransaction();
                $reset = PasswordReset::query()->updateOrCreate(['email'=>$user->email], ['email'=>$user->email, 'token'=>$tempPassword, 'created_at'=>now()]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiHelpers::apiResponse('error', ['error' => __('auth.FB_login_ERR')]);
        }

        try {
            $user->notify(new ForgetPassword($tempPassword));
        } catch (\Throwable $th) {
            throw $th;
        }

        return ApiHelpers::apiResponse('success', ['code' => $tempPassword], __('auth.restPWSend'));
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'code'=> 'required|min:4',
            'password' => 'required|min:8'
        ]);

        $resetUser =  PasswordReset::query()->where('token', $request->get('code'));

        if (!$resetUser->first()) {
            return ApiHelpers::apiResponse('error', [], __('passwords.token'));
        }

        try {
            DB::beginTransaction();
            $user = User::where('email', $resetUser->first()->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            $resetUser->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiHelpers::apiResponse('error', [], __('passwords.token'));
        }

        return ApiHelpers::apiResponse('success', [], __('passwords.reset'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:4'
        ]);

        $user = User::query()->find(\auth()->id());
        try {
            DB::beginTransaction();
            $user->update(['password'=> bcrypt($request->password) ]) ;
            DB::commit();
            return ApiHelpers::apiResponse('success', [], __('auth.passwordChangedSuccess'));
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiHelpers::apiResponse('error', [], __('auth.restPWSend'));
        }
    }

    public function authUser()
    {
        $user = \auth()->user();
        $user->profile_image_url = $user->profile_image_url??null;
        if ($user) {
            return ApiHelpers::apiResponse('success', $user);
        } else {
            return ApiHelpers::apiResponse('error', []);
        }
    }

    public function user_details(Request $request)
    {
        $user = User::query()->find($request->id);
        if ($user) {
            return ApiHelpers::apiResponse('success', $user);
        } else {
            return ApiHelpers::apiResponse('error', [], 'user Not Found.!');
        }
    }

    public function updateProfile(UserProfileRequest $request)
    {
        $user = \auth()->user();

        try {
            $img = null;
            if ($request->has('user_image')) {
                $file = $request->file('user_image');
                $disk = Storage::disk('public');

                if (!is_dir($disk->path('uploads/users'))) {
                    mkdir($disk->path('uploads/users'));
                }

                $img = time().$file->getClientOriginalName();

                $image_resize = Image::make($file->getRealPath())->resize(250, 250);

                $image_resize->save($disk->path("uploads/users/$img"));
            }
//            $name = $request->get('first_name') . ' ' . $request->get('last_name');

            DB::beginTransaction();

            $user->update([
                'name' => $request->get('name'),
                'profile_image' => $img,
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'dob' => $request->get('dob'),
                'age' => $request->get('age')??0,
                'gender' => $request->get('gender'),
            ]);

            $user->save();
            $user= User::query()->find(\auth()->id());
            $user->profile_image_url = $user->profile_image_url??null;
            DB::commit();
            $user = $user->only(['name', 'email', 'phone', 'gender', 'dob', 'profile_image_url', 'age', 'first_name', 'last_name']);
            return ApiHelpers::apiResponse('success', $user, __('auth.successUpdate', ['var'=>__('user')]));
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiHelpers::apiResponse('error', $user, __('auth.errorSetting', ['var'=>__('user')]));
        }
    }

    public function getUserAddresses()
    {

        $cart = apiUserCart()->getContent();

        $firstSeller = $cart->first()->associatedModel->seller_id;

        $data = $cart->collect()->map(function ($item) use ($firstSeller){
            return !is_null($item->associatedModel->seller_id) && $item->associatedModel->seller_id == $firstSeller;
        });

        $sameSeller = $data->filter(function ($item){
            return !$item;
        });

//        $data = $sameSeller->count() ? 'not same seller' : 'same seller';

        $user_addresses = UserAddressResource::collection(\auth()->user()->userAddresses);
        $data = [
            'user_addresses' => $user_addresses,
            'branches' => null,
        ];

        if (!$sameSeller->count()) {
            $data['branches'] = SellerBranchResource::collection(Branch::query()->where([['is_active', true], ['seller_id', $firstSeller]])->get());
        }

        return ApiHelpers::apiResponse('success', $data);
    }
}
