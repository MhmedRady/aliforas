<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUsersRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

class CustomersController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(Request $request)
    {

//        return User::query()->where([['is_admin','!=',1],['is_seller','!=',1]])->with('details')->orderBy('id')->get();

        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(User::query()->where([['is_admin','!=',1],['is_seller','!=',1]])->with('details')->orderBy('id'));
            return created_at_filter($DataTables)->filterColumn('is_active', function ($q, $word) {
                return $q->where('is_active', 'like', Helper::filterActive($word));
            })->filterColumn('email_verified_at', function ($q, $word) {
                return Helper::filterActive($word)? $q->whereNotNull('email_verified_at'): $q->whereNull('email_verified_at');
            })->editColumn('created_at', function (User $user) {
                return optional($user->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (User $user) {
                return route('admin.customers.edit', $user);
            })->addColumn('delete_url', function (User $user) {
                return route('admin.customers.destroy', $user);
            })->editColumn('email_verified_at', function (User $user) {
                return $user->email_verified_at ? '<span class="badge rounded-pill bg-info">Verified</span>' : '<span class="badge rounded-pill bg-danger">Not Verified</span>';
            })->editColumn('is_active', function (User $user) {
                return $user->is_active ? '<span class="badge rounded-pill bg-info">Active</span>' : '<span class="badge rounded-pill bg-danger">Inactive</span>';
            })->addColumn('actions', function (User $user) {
                return [
                    $user->is_active
                        ?['url' => '#', 'icon'=> 'check-circle']
                        :['url' => route('admin.customers.active', $user), 'icon'=> 'x-circle'],

                    !is_null($user->email_verified_at)
                        ?['url' => '#', 'icon'=> 'user-check']
                        :['url' => route('admin.customers.verify', $user), 'icon'=> 'user-x'],

                    ['url' => route('admin.customers.show', $user), 'icon' => 'eye'],
                ];
            })->only([
                'id', 'name', 'email', 'actions', 'email_verified_at', 'is_active', 'created_at', 'update_url', 'delete_url',
            ])->rawColumns(['email_verified_at', 'is_active'])->make(true);
        }
        return view('admin.content.customers.index');
    }

    public function create()
    {
        $data = [
            'countries' => Country::all()->pluck('name:en', 'id'),
            'cities' => City::all()->pluck('name:en', 'id')
        ];
        return view('admin.content.customers.create')->with($data);
    }


    public function store(AdminUsersRequest $request)
    {
        try {
            $password = Hash::make($request->get('password'));
//            $name = $request->input('first_name'). ' ' . $request->input('last_name');

            $request->merge(['is_active' => $request->has('is_active'),
                'password' => $password,
                'name' => $request->get('name'),
                'verification_code' => genRandomCode(),
                'email_verified_at'=> now()]);

            if (config('setting.pricing') === false) {
                $request->merge(['employer' => $request->input('employer'),
                    'national_id'=> $request->input('national_id')]);
            }
            $request = $request->except('_method', '_token', 'password_confirmation', 'first_name', 'last_name');
            DB::beginTransaction();
            $user = User::create($request);
            DB::commit();
//        $detailsData = $request->except('_method', '_token', 'password', 'password_confirmation', 'is_active', 'name', 'gender', 'dob', 'contact_number');
//        $detailsData['email'] = $request->order_email;
//        $user->details()->updateOrCreate(['user_id' => $user->id], $detailsData);
            # log the action to database
            $logPayload = ['msg' => 'Customer Added', 'model_id' => $user->id, 'user_id' => auth()->id()];
            logToDatabase($logPayload);
            $msg = ['success'=>'New User Created Successfully.!'];
        } catch (\Exception $e) {
            DB::rollBack();
            $msg = ['error'=>'Error While Creating New User Please Try again Later.!'];
        }
        session()->flash('success');
        return redirect()->route('admin.customers.index')->with($msg);
    }

    public function show($id)
    {
        $user = User::find($id);
//        return $user->userAddresses->first()->state->name;
        $data = ['row' => $user];
        return view('admin.content.customers.show')->with($data);
    }

    public function edit($id)
    {
        $user = User::customers()->findOrFail($id);

        return view('admin.content.customers.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::customers()->findOrFail($id);

            if ($request->input('password')) {
                $password = (!empty($request->input('password'))) ? Hash::make($request->get('password')) : null;
                $request->merge(['password' => $password]);
            }


            $name = $request->input('first_name'). ' '. $request->input('last_name');
            $request->merge([
                'is_active' => $request->has('is_active'),
                'name'=>$name
            ]);

            DB::beginTransaction();
            $user->update($request ->except(
                ['password_confirmation','_token','_method','first_name', 'last_name']
            ));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        // update user details
//        $detailsData = $request->except('_method', '_token', 'password', 'password_confirmation', 'is_active', 'name', 'gender', 'dob', 'contact_number');
//        $detailsData['email'] = $request->order_email;
//        $user->details()->updateOrCreate(['user_id' => $user->id], $detailsData);
        // log
//        $logPayload = ['msg' => 'Customer Updated', 'model_id' => $user->id, 'user_id' => auth()->id()];
//        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.customers.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $user->details()->delete();
//        return redirect()->route('admin.customers.index');
    }

    public function active(User $user)
    {
        $user->is_active = (bool)$user->is_active;
        switch ($user->is_active) {
            case false:
                $user->is_active = true;
                break;
            case true:
                $user->is_active = false;
                break;
        }
        $user->save();
        session()->flash('success');
        return redirect()->route('admin.customers.index');
    }

    public function verify(User $user)
    {
        $user->verification_code = !!$user->verification_code;
        switch ($user->verification_code) {
            case true:
                $user->verification_code = null;
                $user->email_verified_at = null;
                break;
            case false:
                $user->verification_code = rand(1, 432);
                $user->email_verified_at = now();
                break;
        }
        $user->save();
        return redirect()->route('admin.customers.index');
    }
}
