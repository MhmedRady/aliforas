<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressRequest;
use App\Models\User;
use App\Models\State;
use App\Models\Subscribers;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\Website\UserRepository;
use App\Models\PriceQuoteOrder;

use Brian2694\Toastr\Toastr;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class UserProfileController extends Controller
{
    protected $UserRepository;
    protected User $user;
    public function __construct(UserRepository $userRepository)
    {
        $this->UserRepository = $userRepository;
        $this->middleware(function (Request $request, $next) {
            $this->user = auth()->guard('web')->user();
            view()->share(['user'=>$this->user]);
            return $next($request);
        });
    }
    const ProfileTabs = 'root.auth.profileTabs.';

    public function showProfile()
    {
//        $user = Auth::User();
        return view(self::ProfileTabs.'profileContent');
//        return view('root.auth.user-profile-setting',compact('user','states'));
    }

    public function viewUserProfile()
    {
//        $user = Auth::User();
        $states = State::query()->get();
        return view(self::ProfileTabs.'editProfile', compact('states'));
    }

    public function updateProfile(UserProfileRequest $request)
    {

//        $user = \auth()->guard('web')->user();

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

        $request->request->add(['profile_image'=>$img]);

        try {
            DB::beginTransaction();
            $this->UserRepository->update($this->user, $request);
            DB::commit();
            session()->flash('success');
            return redirect()->back()->with(['success'=>__('auth.successSetting')]);
//            return response()->json(['tag'=>true,'msg'=>__('auth.successSetting')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->back()->with(['error'=>__('auth.errorSetting')]);
//            return response()->json(['tag'=>false,'msg'=>__('auth.errorSetting')]);
        }
    }

    public function showPasswordForm()
    {
//        $user = \auth()->user();

        return view('root.auth.passwords.changePW');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $user = $this->user->makeVisible(['new_password']);

        if (!Hash::check($request->input("currentPW"), $user->password)) {
            return redirect()->back()->with(['error'=>__('auth.errPassword')]);
//              return response()->json(['tag'=>false,'msg'=>__('auth.errPassword')]);
        } else {
            try {
                DB::beginTransaction();
                $this->UserRepository->changePassword(bcrypt($request->input("new_password")));
                DB::commit();
                return redirect()->back()->with(['success'=>__('auth.passwordChangedSuccess')]);
//                  return response()->json(['tag'=>true,'msg'=>__('auth.passwordChangedSuccess')]);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['error'=>__('auth.errorSetting')]);
//                  return response()->json(['tag'=>false,'msg'=>__('auth.errorSetting')]);
            }
        }
    }

    public function viewUserAddress()
    {
        $user = \Auth::User();
        $states = State::query()->get();
        return view(self::ProfileTabs.'userAddresses', compact('user', 'states'));
    }

    public function updateUserAddress(UserAddressRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->UserRepository->updateAddress($request);
            DB::commit();
            return redirect()->route('view-user-address')->with(['success'=>__('auth.successSetting')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('view-user-address')->with(['error'=>__('auth.errorSetting')]);
        }
    }

    public function newUserAddress(UserAddressRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->UserRepository->newUserAddress($request);
            DB::commit();
            return redirect()->back()->with(['success'=>__('auth.new SHIPPING ADDRESS')]);
//            return response()->json(['tag'=>true,'msg'=>__('auth.new SHIPPING ADDRESS')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error'=>__('auth.errorSetting')]);
        }
    }

//    public function showRelatedOrders()
//    {
//        $user = \auth()->user();
//        return view(self::ProfileTabs.'myOrders',compact('user'));
//    }

//    public function viewOrderPrices($order)
//    {
//        $user = \auth()->user();
//        $order = PriceQuoteOrder::query()->where('user_id',$user->id)->findOrFail($order);
//
//        return view('root.auth.orderPricesTable',compact('order'));
//    }

    public function userSubscribe(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'email'=>'required|email:rfc,dns'
        ]);

        if ($validate->fails()) {
            return response()->json(['tag'=>false,'msg'=>__('auth.EmailErr')]);
        }

        $email = $request->get('email');
        $Subscribers = Subscribers::query()->where('email', $email)->first();
        if (!$Subscribers) {
            try {
                DB::beginTransaction();
                Subscribers::query()->create(['email'=>$email]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
//                return $e->getMessage();
                return response()->json(['tag'=>false]);
            }
        }
        return response()->json(['tag'=>true,'msg'=>__('auth.subscribeSuccess'),]);
    }
}
