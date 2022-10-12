<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionsGroupsRequest;
use App\Models\PermissionGroup;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

class PermissionsGroupsController extends Controller
{
    public function __construct()
    {
        /*$this->middleware('permission:view_role');
        $this->middleware('permission:create_role', ['only' => ['create','store']]);
        $this->middleware('permission:edit_role', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_role', ['only' => ['destroy']]);*/
    }

    /**
     * @throws \Exception
     */
    public function index(\Illuminate\Http\Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(PermissionGroup::query()->orderBy('id'));

            return created_at_filter($DataTables)->editColumn('created_at', function (PermissionGroup $permissionGroup) {
                return optional($permissionGroup->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (PermissionGroup $permissionGroup) {
                return route('admin.permission-group.edit', $permissionGroup);
            })->addColumn('delete_url', function (PermissionGroup $permissionGroup) {
                return route('admin.permission-group.destroy', $permissionGroup);
            })->only([
                'id', 'name', 'created_at', 'update_url', 'delete_url',
            ])->make(true);
        }
        return view('admin.content.access.permissionsGroups.index');
    }

    public function create()
    {
        $data['groups'] = PermissionGroup::get()->pluck('name', 'id');
        return view('admin.content.access.permissionsGroups.create')->with($data);
    }

    public function store(PermissionsGroupsRequest $request)
    {
        /** @var PermissionGroup $PermissionGroup */
        $PermissionGroup = PermissionGroup::query()->create($request->only('name'));
        logToDatabase([
            'msg' => 'Permission Group Added', 'model_id' => $PermissionGroup->id, 'user_id' => auth()->id()
        ]);
        session()->flash('success');
        return redirect()->route('admin.permission-group.index');
    }

    public function edit(PermissionGroup $PermissionGroup)
    {
        return view('admin.content.access.permissionsGroups.edit', compact('PermissionGroup'));
    }

    public function update(PermissionsGroupsRequest $request, PermissionGroup $PermissionGroup)
    {
        $PermissionGroup->update($request->only('name'));
        logToDatabase([
            'msg' => 'Permission Group Updated', 'model_id' => $PermissionGroup->id, 'user_id' => auth()->id()
        ]);
        session()->flash('success');
        return redirect()->route('admin.permission-group.index');
    }

    public function destroy(PermissionGroup $PermissionGroup)
    {
        $PermissionGroup->delete();
        // return redirect()->route('admin.permission-group.index');
    }
}
