<?php

namespace App\Repositories\Seller;

use App\Models\Seller;
use App\Models\Auth\Seller as AuthSeller;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\SellerFile;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class SellerRepository.
 */
class SellerRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */

    public function model()
    {
        return AuthSeller::class;
    }

    public function store($user, &$seller, &$userAddress)
    {
        $newUser = AuthSeller::query()->create($user);

        $seller['user_id'] = $newUser->id;
        $userAddress['user_id'] = $newUser->id;
        $newUser->seller()->create($seller);
        $newUser->userAddress()->create($userAddress);
//        Seller::query()->create($seller);
//        UserAddress::query()->create($userAddress);
    }

    public function update(User $user,$users, &$sellers, &$userAddresses)
    {
//        $authUser = auth()->guard('seller')->user();
        $user->update($users);
        $user->seller?$user->seller->update($sellers) : Seller::query()->create($sellers);
        $user->userAddress->count()?$user->userAddress->update($userAddresses) : $user->userAddress->create($userAddresses);
    }

    public function changePassword(string $password)
    {
        User::query()->update(['password'=>$password]);
    }

}
