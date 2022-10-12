<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(Request $request)
    {
//        return Role::query()->with('permissions')->orderBy('id')->get();
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(Role::query()->with('permissions')->orderBy('id'));

            return created_at_filter($DataTables)->filterColumn('permissions', function ($q, $word) {
                return $q->where('name', 'like', [(config('datatables.search.smart') === true?'%':'') . "$word%"]);
            })->editColumn('created_at', function (Role $role) {
                return optional($role->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (Role $role) {
                return route('admin.roles.edit', $role);
            })->addColumn('delete_url', function (Role $role) {
                return route('admin.roles.destroy', $role);
            })->editColumn('permissions', function (Role $role) {
                if ($role->permissions->count() === 0) {
                    return 'No Permissions';
                }
                return $role->permissions->map(fn ($permission) => '<span class="badge rounded-pill bg-info">' . $permission->name . '</span>')->join(' ');
            })->only([
                'id', 'name', 'permissions', 'created_at', 'update_url', 'delete_url',
            ])->rawColumns(['permissions'])->make(true);
        }
        return view('admin.content.access.roles.index');
    }

    public function create()
    {
        $data['permissions'] = Permission::get();
        return view('admin.content.access.roles.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            DB::beginTransaction();
            # create role
            $role = Role::create(['name' => $request->input('name')]);
            # sync permissions to role
            $role->syncPermissions($request->input('permissions'));
//            $logPayload = ['msg' => 'Role Added', 'model_id' => $role->id, 'user_id' => auth()->id()];
//            logToDatabase($logPayload);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
//            return $e->getMessage();
        }
        session()->flash('success');
        return redirect()->route('admin.roles.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['row'] = Role::with('permissions')->find($id);
        $data['permissions'] = Permission::get();
        return view('admin.content.access.roles.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        # create role
        $role = Role::find($id);
        $role->update(['name' => $request->input('name')]);
        # sync permissions to role
        $role->syncPermissions($request->input('permissions'));
        $logPayload = ['msg' => 'Role Updated', 'model_id' => $role->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.roles.index');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Role::find($id)->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
//        return redirect()->route('admin.roles.index');
    }
}
