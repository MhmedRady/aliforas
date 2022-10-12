<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Priority;
use App\Models\PrioritySetting;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $rows = Priority::orderBy('order_id')->get();
        $priority_setting = PrioritySetting::query()->firstOrCreate([], ['enable' => true]);
        return view('admin.content.priority.index', compact('rows', 'priority_setting'));
    }

    public function create()
    {
        $len = Language::all();
        return view('admin.content.priority.create', compact('len'));
    }

    //store
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:periorties,name',
            'order_id' => 'required'
        ];

        $request->validate($rules);
        $data = $request->except('_token');
        if ($rows = Priority::where('order_id', $request->order_id)->first()) {
            $rows2 = Priority::where('order_id', '>=', $request->order_id)->increment('order_id');
        }

        Priority::create($data);
        return redirect(url('big-boss/priority'));
    }

    //Edit
    public function edit(Request $request, $id)
    {
        $row = Priority::find($id);
        return view('admin.content.priority.edit', compact('row'));
    }

    //Update
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|unique:periorties,name,' . $id,
            'order_id' => 'required'
        ];

        $request->validate($rules);
        $data = $request->except('_token');
        if ($rows = Priority::where('order_id', $request->order_id)->first()) {
            $rows2 = Priority::where('order_id', '>=', $request->order_id)->increment('order_id');
        }
        $row = Priority::find($id);
        $row->update($data);


        return redirect(url('big-boss/priority'));
    }

    //update_all
    public function update_all(Request $request)
    {
        $order = 1;
        //dd($request->ids);
        foreach ($request->get('ids') as $id) {
            Priority::where('id', $id)->update([
                'order_id' => $order
            ]);
            $order++;
        }


        return $request->ajax() ? [] : back();
    }

    //Enable Priority
    public function toggole(Request $request)
    {
        if ($request->ajax()) {
            $priority_setting = PrioritySetting::query()->firstOrCreate([], ['enable' => true]);
            $priority_setting->enable == 0 ? $priority_setting->enable = 1 : $priority_setting->enable = 0;
            $priority_setting->save();
            return $priority_setting->enable;
        }
    }
}
