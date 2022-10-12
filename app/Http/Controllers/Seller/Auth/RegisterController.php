<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\State    ;
use App\Models\Auth\Seller;
use Illuminate\Http\Request;
use App\Http\Requests\Seller\RegisterRequest;
use App\Repositories\Seller\SellerRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Toaster;

class RegisterController extends Controller
{
    private const AUTH_PATH = 'seller.auth.';
    private SellerRepository $sellerRepository;

    public function __construct(SellerRepository $repository)
    {
        $this->sellerRepository = $repository;
    }
    public function registerForm()
    {
        $states = State::query()->get();

        return view(self::AUTH_PATH.'register', compact('states'));
    }

    public function sellerRegister(RegisterRequest $request)
    {
        try {
            DB::rollBack();
            $name = $request->input('first_name').' '.$request->input('last_name');
            $user = [
                'name' => $name,
                'password' => bcrypt($request->input('password')),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'national_id' => $request->input('document_id'),
                'gender' => $request->input('gender'),
                'dob' => $request->input('dob'),
                'is_active' => true,
                'is_seller' => true,
            ];
            $seller = [
                'document_id' => $request->input('document_id'),
                'store' => $request->input('store'),
            ];
            $userAddress = [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone' => $request->input('pickup_phone'),
                'country_id' => 1,
                'city_id' => $request->input('city'),
                'state_id' => $request->input('state'),
                'street' => $request->input('street'),
                'address' => $request->input('address'),
                'build_number' => $request->input('build_number'),
                'postal_code' => $request->input('postal_code'),
            ];
            DB::beginTransaction();
            $this->sellerRepository->store($user, $seller, $userAddress);
            DB::commit();
            return redirect()->route('seller.Login')->with(['success'=>__('seller.newSellerSuccess')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('seller.register')->with(['error'=>__('auth.errorNewSetting')]);
        }
    }
}
