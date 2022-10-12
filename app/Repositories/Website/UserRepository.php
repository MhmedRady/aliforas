<?php
namespace App\Repositories\Website;

use App\Http\Requests\UserAddressRequest;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Subscribers;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class UserRepository extends BaseRepository
{
    public function Model()
    {
        return User::class;
    }

    public function changePassword(string $password)
    {
        User::query()->update(['password'=>$password]);
    }

    public function resetPassword(User $user, string $password)
    {
        $user->update(['password'=>$password]);
    }

    public function store(UserRegisterRequest $user)
    {
        $name = $user->input('first_name') . ' ' . $user->input('last_name');
        $password = Hash::make($user->input("Password"));
        $code = genRandomCode();

        $date = [
            'name' => $name,
            'gender' => $user->input('gender'),
            'email' => $user->input('email'),

            'verification_code' => $code,
            'email_verified_at'=> now(),
            'is_active' => 1,

//            'dob' => $user['dob'],
            'password' => $password,

        ];

        if (config('setting.pricing') === false) {
            $date ['phone'] = $user->input('phone');
            $date ['age'] = $user->input('age');
            $date ['national_id'] = $user->input('national_id');
            $date ['employer'] = $user->input('employer');
        }

        User::query()->create($date);

        // save details data
//        UserDetail::query()->create([
//            'first_name' => $user->input('first_name'),
//            'last_name' => $user->input('last_name'),
//
//            'user_id' => $userId->id,
//            'email' => $user->input('email'),
//            'phone' => $user->input('phone'),
//
//            'age' => $user->input('age'),
////            'address' => $user->input('address'),
//            'national_id' => $user->input('national_id'),
//            'employer' => $user->input('employer'),
//
////            'city_id'=> $user->input('city_id'),
////            'state_id'=> $user->input('state_id'),
//        ]);

//        UserAddress::query()->create([
//            'address' => $user->input('address'),
//            'user_id' => $userId,
//            'city_id'=> $user->input('city_id'),
//            'state_id'=> $user->input('state_id'),
//        ]);
    }

    public function update(User $user, UserProfileRequest $request)
    {
        $userDetails = $request->all();
        $userDetails['name'] = $request->get('first_name') .' '.$request->get('last_name');

        // I don't know the purpose of this code block but kept for future use [SHOULD BR REMOVED]
        if (config('setting.pricing') === false)
        {
            $userDetails ['national_id'] = $request->national_id;
            $userDetails ['employer'] = $request->employer;
        }
        $user->update($userDetails);
    }

    public function subscribe($email)
    {
        Subscribers::query()->create(['email'=>$email]);
    }

    public function updateAddress(UserAddressRequest $request)
    {
        $UserAddress = [
            'user_id'=> auth()->user()->id,
            'address' => $request->input('address_address'),
            'city_id'=> $request->input('address_city_id'),
            'state_id'=> $request->input('address_state_id'),
            'postal_code'=> $request->input('address_postal_code'),
        ];
        UserAddress::query()->where('id', $request->address_id)->update($UserAddress);
    }

    public function newUserAddress(UserAddressRequest $request)
    {
        $UserAddress = [
            'user_id'=> auth()->user()->id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'city_id'=> $request->input('city_id'),
            'state_id'=> $request->input('state_id'),
            'postal_code'=> $request->input('postal_code'),
        ];

        auth()->user()->userAddress->create($UserAddress);
    }
}
