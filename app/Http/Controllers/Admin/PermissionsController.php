<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionsRequest;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(Permission::query()->orderBy('id'));

            return created_at_filter($DataTables)->editColumn('created_at', function (Permission $permission) {
                return optional($permission->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (Permission $permission) {
                return route('admin.permissions.edit', $permission);
            })->addColumn('delete_url', function (Permission $permission) {
                return route('admin.permissions.destroy', $permission);
            })->only([
                'id', 'name', 'group_id', 'created_at', 'update_url', 'delete_url',
            ])->make(true);
        }
        return view('admin.content.access.permissions.index');
    }

    public function create()
    {
        $data['groups'] = PermissionGroup::get()->pluck('name', 'id');
        return view('admin.content.access.permissions.create')->with($data);
    }

    public function store(PermissionsRequest $request)
    {
        $permission = Permission::create(['name' => $request->input('name'), 'group_id' => $request->input('group_id')]);
        $logPayload = ['msg' => 'Permission Added', 'model_id' => $permission->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.permissions.index');
    }

    public function show($id)
    {
        $row = Permission::find($id);
        $data['row'] = $row;
        return view('admin.content.access.permissions.create')->with($data);
    }

    public function edit($id)
    {
        $row = Permission::find($id);
        $data['row'] = $row;
        $data['groups'] = PermissionGroup::get()->pluck('name', 'id');
        return view('admin.content.access.permissions.edit')->with($data);
    }

    public function update(PermissionsRequest $request, $id)
    {
        $permission = Permission::find($id);
        $permission->update($request->all());
        $logPayload = ['msg' => 'Permission Updated', 'model_id' => $permission->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.permissions.index');
    }

    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect()->route('admin.permissions.index');
    }
}
