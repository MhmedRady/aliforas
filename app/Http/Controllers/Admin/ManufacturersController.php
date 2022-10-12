<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ManufacturersExport;
use App\Http\Controllers\Controller;
use App\Imports\ManufacturersImport;
use App\Models\Language;
use App\Models\Manufacturer;
use App\Models\Translations\ManufacturerTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ManufacturersController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('permission:view_manufacture');
        $this->middleware('permission:create_manufacture', ['only' => ['create','store']]);
        $this->middleware('permission:edit_manufacture', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_manufacture', ['only' => ['destroy']]); */

        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    public function index(\Illuminate\Http\Request $request)
    {

        if ($request->ajax() || $request->has('draw'))
        {

            $dataTable = DataTables::of(Manufacturer::query());
            return created_at_filter($dataTable)->filterColumn('name',function ($q, $word){
                return $q->whereHas('translations', function ($q) use ($word){
                    $q->where('name', 'like', [(config('datatables.search.smart') === true?'%':'') . "$word%"]);
                });
            })->editColumn('created_at', function (Manufacturer $manufacturer){
                return optional($manufacturer->created_at)->diffForHumans();
            })->addColumn('update_url',function (Manufacturer $manufacturer){
                return route('admin.manufacturers.edit',$manufacturer);
            })->addColumn('delete_url',function (Manufacturer $manufacturer){
                return route('admin.manufacturers.destroy',$manufacturer);
            })->addColumn('logo', '@isset($logo_thumb)
                    <img src="{{$logo_thumb}}" style="width: 64px;" class="thumbnail" alt="">@endisset')
                ->only([
                    'id', 'name', 'logo', 'actions', 'created_at', 'update_url', 'delete_url',
                ])->rawColumns(['logo'])->make(true);
        }

        return view('admin.content.manufacturers.index');

//        $query = Manufacturer::query();
//        $manufacturer = $query->get();
//
//        $data = ['rows' => $manufacturer];
//        return view('admin.content.manufacturers.index')->with($data);
    }

    public function export()
    {
        return Excel::download(new ManufacturersExport(), 'manufacturers.xlsx');
    }

    public function import()
    {
        Excel::import(new ManufacturersImport, request()->file('file'));
        return back();
    }

    public function create()
    {
        return view('admin.content.manufacturers.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name.*' => 'required',
            # 'slug.*' => 'required|unique:manufacturer_translations,slug',
            'logo' => 'required|mimes:jpeg,PNG,JPG,JPEG,jpg,png|max:10000'
        ]);

        try {
            DB::beginTransaction();
            $manufacturer = new Manufacturer();

            $logo = upload_file($request->file('logo'), 'manufacturers');

            if ($logo) $manufacturer->logo = $logo;

            $manufacturer->save();

            foreach ($this->languages as $local) {
                $manufacturerTrans = new ManufacturerTranslation();
                $manufacturerTrans->manufacturer_id = $manufacturer->id;
                $manufacturerTrans->name = $request->input('name.' . $local->locale);

                $manufacturerTrans->meta_title = $request->input('meta_title.' . $local->locale);
                $manufacturerTrans->meta_keywords = $request->input('meta_keywords.' . $local->locale);
                $manufacturerTrans->meta_description = $request->input('meta_description.' . $local->locale);
                $manufacturerTrans->locale = $local->locale;
                $manufacturerTrans->save();
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }

        # Manufacturer::create($request->all());
        $logPayload = ['msg' => 'Manufacturer Added', 'model_id' => $manufacturer->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.manufacturers.index');

    }

    public function show(Manufacturer $manufacturer)
    {
        $data = ['row' => $manufacturer];
        return view('admin.content.manufacturers.show')->with($data);
    }


    public function edit(Manufacturer $manufacturer)
    {

        $data = [
            'row' => $manufacturer,
        ];
        return view('admin.content.manufacturers.edit')->with($data);
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {

        $request->validate([
            'name.*' => 'required',
            # 'slug.*' => 'required',
            'logo' => 'mimes:jpeg,PNG,JPG,JPEG,jpg,png|max:10000'
        ]);

        $logo = upload_file($request->file('logo'), 'manufacturers');
        if ($logo) $manufacturer->logo = $logo;
        $manufacturer->save();

        foreach ($this->languages as $local) {
            $manufacturerTrans = ManufacturerTranslation::where([
                'manufacturer_id' => $manufacturer->id,
                'locale' => $local->locale,
            ])->first();
            if (!$manufacturerTrans) $manufacturerTrans = new ManufacturerTranslation();
            $manufacturerTrans->manufacturer_id = $manufacturer->id;
            $manufacturerTrans->name = $request->input('name.' . $local->locale);

            $manufacturerTrans->meta_title = $request->input('meta_title.' . $local->locale);
            $manufacturerTrans->meta_keywords = $request->input('meta_keywords.' . $local->locale);
            $manufacturerTrans->meta_description = $request->input('meta_description.' . $local->locale);
            $manufacturerTrans->locale = $local->locale;
            $manufacturerTrans->save();
        }
        $logPayload = ['msg' => 'Manufacturer Updated', 'model_id' => $manufacturer->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.manufacturers.index');

    }


    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturerTrans = ManufacturerTranslation::where('manufacturer_id', $manufacturer->id)->delete();
        $manufacturer->delete();
        return redirect()->route('admin.manufacturers.index');
    }

}
