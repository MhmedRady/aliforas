<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainSettingRequest;
use App\Models\Language;
use App\Models\MainSetting;
use App\Models\Setting;
use App\Models\Translations\SettingTranslation;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Toaster;

class MainSettingController extends Controller
{

    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('lang', $this->languages);
        /* $this->middleware('permission:view_setting');
        $this->middleware('permission:create_setting', ['only' => ['create','store']]);
        $this->middleware('permission:edit_setting', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_setting', ['only' => ['destroy']]); */
    }

    public function index(\Illuminate\Http\Request $request)
    {

    }

    public function main_setting()
    {
        return view('admin.content.setting.main');
    }

    public function main_settings_rows()
    {

    }

    public function main_setting_post(Request $request)
    {

    }

    public function create()
    {
        $setting = MainSetting::get();
        return view('admin.content.setting.main',compact('setting'));
    }

    public function store(MainSettingRequest $request)
    {
        $request->validate(
            [
                'taxes' => 'nullable|numeric|min:0',
            ],
            [
                'taxes.numeric' => 'Taxes Must Be In Numeric Values',
            ]
        );

        try {
            DB::beginTransaction();
            foreach (($request->except('_token')) as $key => $val)
            {
                if (!is_null($val))
                {
                    $check = MainSetting::query()->firstOrNew(['key' => $key]);
                    $check->fill(['value' => $val])->save();
                }
            }
            DB::commit();
            return redirect()->route('admin.setting.main_setting')->with(['success'=>'Main Settings Data Saved Successfully']);
        }catch (\Exception $e){
            DB::rollBack();
            Toaster::Error('Error While Saving Data Try again Later','error');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $len = Language::all();
        $setting = Setting::find($id);
        return view('admin.content.setting.edit', compact('len', 'setting'));
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        $lan = Language::all();
        $setting = Setting::find($id);
        foreach ($lan as $local) {
            $set = SettingTranslation::where(['setting_id' => $id, "locale" => $local->locale])->first();
            $set->locale = $local->locale;
            $set->name = $request->get('name_' . $local->locale);
            $set->description = $request->get('description_' . $local->locale);
            $set->save();
        }
        $logPayload = ['msg' => 'Setting Updated', 'model_id' => $setting->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.setting.index');

    }

    public function destroy($id)
    {
        Setting::find($id)->delete();
        return redirect()->route('admin.setting.index');
    }
}
