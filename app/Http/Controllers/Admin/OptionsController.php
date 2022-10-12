<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Option;
use App\Models\OptionValue;
use Illuminate\Http\Request;

class OptionsController extends Controller
{

    public function index(\Illuminate\Http\Request $request)
    {
        $opts = Option::get();
        $data = ['rows' => $opts];
        return view('admin.content.options.index')->with($data);
    }

    public function create()
    {
        $data = [
            'fields' => Field::get()->pluck('name', 'id')
        ];
        return view('admin.content.options.create')->with($data);
    }

    public function store(Request $request)
    {

        $opt = Option::create($request->all());
        $optValues = [];
        foreach ($request->input('field_values') as $value) {
            $optValues[] = ['value' => $value];
        }
        $opt->values()->createMany($optValues);
        $logPayload = ['msg' => 'Option Added', 'model_id' => $opt->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.options.index');
    }

    public function show($id)
    {
        //
    }

    public function getValuesByOptionId()
    {
        $id = \request()->get('id');
        $values = OptionValue::where('option_id', $id)->get()->pluck('value', 'id');
        if (!count($values))
            return 0;
        return view('admin.content.options.values')->with(compact('values'));
    }

    public function edit($id)
    {
        $data = [
            'row' => Option::findOrFail($id),
            'fields' => Field::get()->pluck('name', 'id')
        ];
        return view('admin.content.options.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $opt = Option::findOrFail($id);
        $opt->update($request->all());
        $optValues = [];
        foreach ($request->input('field_values') as $value) {
            $optValues[] = ['value' => $value];
        }
        $opt->values()->delete();
        $opt->values()->createMany($optValues);
        $logPayload = ['msg' => 'Option Updated', 'model_id' => $opt->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.options.index');
    }

    public function destroy($id)
    {
        Attribute::find($id)->delete();
        return redirect()->route('admin.options.index');
    }

}
