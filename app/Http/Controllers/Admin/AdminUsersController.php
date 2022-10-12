<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUsersRequest;
use App\Models\Auth\Admin;
use App\Models\OrderStatus;
use App\Models\Seller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

class AdminUsersController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(\Illuminate\Http\Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(Admin::query()->with('roles:name')->orderBy('id'));

            return created_at_filter($DataTables)->editColumn('created_at', function (Admin $user) {
                return optional($user->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (Admin $user) {
                return route('admin.users.edit', $user);
            })->addColumn('delete_url', function (Admin $user) {
                return route('admin.users.destroy', $user);
            })->only([
                'id', 'name', 'email', 'created_at', 'update_url', 'delete_url',
            ])->make(true);
        }
        return view('admin.content.users.index');
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $orderstatus = OrderStatus::all();
        $data = ['roles' => $roles, 'orderstatus' => $orderstatus];
        return view('admin.content.users.create')->with($data);
    }

    public function store(AdminUsersRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Admin::query()->create(array_merge($request->validated(), [
                'is_active' => $request->has('is_active'),
                'is_admin' => 1,
                'password' => bcrypt($request->get('password')),
            ]));

            $user->order_status_permissions = implode(',', $request->input('order_status_permissions'));
            $user->save();
            DB::commit();

            $role = (!empty($request->input('role'))) ? $request->input('role') : [];
            $user->syncRoles($role);

            logToDatabase([
                'msg' => 'Admin Added', 'model_id' => $user->id, 'user_id' => auth()->id()
            ]);
            session()->flash('success');
            return redirect()->route('admin.users.index')->with(['success'=>'New Admin Account Created Successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('admin.users.index');
        }
    }

    public function show($id)
    {
        $user = Admin::find($id);
        $data = ['row' => $user];
        return view('admin.content.users.show')->with($data);
    }

    public function showSeller($id)
    {
        $user = Admin::where("id", $id)->with("seller")->select()->first();
        $seller = Seller::where("user_id", $id)->first();
        return [$user];

        $user["address"] = $seller[0]["address"];
        $user["lat"] = $seller[0]["lat"];
        $user["lng"] = $seller[0]["lng"];
        return $user;
    }

    public function edit($id)
    {
        $user = Admin::find($id);

        $orderstatus = OrderStatus::all();
        $roles = Role::get();
        $userRoles = $user->roles()->first();
        $user->role_id = (!empty($userRoles)) ? $userRoles->id : '';
        $data = ['row' => $user, 'orderstatus' => $orderstatus, 'roles' => $roles->pluck('name', 'id')];
        # log the action to database
        $logPayload = ['msg' => 'Admin Updated', 'model_id' => $user->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return view('admin.content.users.edit')->with($data);
    }

    public function edit_profile()
    {
        $admin = auth()->guard('admin')->id();
//        return auth()->guard('admin')->user()->roles->first()->name;
        return $this->edit($admin);
    }

    public function update(AdminUsersRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->merge(['is_active' => $request->has('is_active')]);
            $password = (!empty($request->input('password'))) ? Hash::make($request->get('password')) : null;
            $request->merge(['password' => $password]);
            $user = Admin::query()->findOrFail($id);

            if ($request->has('order_status_permissions')) {
                $request->merge(['order_status_permissions' => implode(',', $request->get('order_status_permissions'))]);
            }

            $user->update($request->all());
            $role = (!empty($request->input('role'))) ? $request->input('role') : [];
            $user->syncRoles($role);

            DB::commit();
            session()->flash('success');
            return redirect()->back()->with(['success'=>'Admin Profile Data Updated Successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error'=>'Error While Update Profile Data Try Again Later!']);
        }
    }

    public function update_profile(AdminUsersRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->merge(['is_active' => $request->has('is_active')]);
            $password = (!empty($request->input('password'))) ? Hash::make($request->get('password')) : null;
            $request->merge(['password' => $password]);
            $user = auth()->guard('admin')->user();

            if ($request->has('order_status_permissions')) {
                $request->merge(['order_status_permissions' => implode(',', $request->get('order_status_permissions'))]);
            }

            $user->update($request->all());

//                $role = (!empty($request->input('role'))) ? $request->input('role') : [];
//                $user->syncRoles($role);
            DB::commit();
//            return auth()->guard('admin')->user();
            session()->flash('success');
            return redirect()->back()->with(['success'=>'Admin Profile Data Updated Successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with(['error'=>'Error While Update Profile Data Try Again Later!']);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $admin = Admin::find($id);
            if ($admin) {
                $admin->delete();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        session()->flash('success');
        return redirect()->route('admin.users.index');
    }

    public function list_seller()
    {
        return view('admin.content.seller.sellers', [
            'sellers' => Admin::where('is_seller', 1)->orderBy('id', 'desc')->get()
        ]);
    }

    public function change_seller_state($id)
    {
        $user = Admin::findOrFail($id);
        if ($user->is_active) {
            $user->is_active = 0;
        } else {
            $user->is_active = 1;
        }
        $user->save();
//        return $user;
        return back();
    }

    public function authorized()
    {
        return view('admin.panels.authorized');
    }
}
