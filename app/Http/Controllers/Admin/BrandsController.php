<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BrandsExport;
use App\Http\Controllers\Controller;
use App\Imports\BrandsImport;
use App\Models\Brand;
use App\Models\Language;
use App\Models\Translations\BrandTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

class BrandsController extends Controller
{
    public function __construct()
    {
        /*$this->middleware('permission:view_brand');
        $this->middleware('permission:create_brand', ['only' => ['create','store']]);
        $this->middleware('permission:edit_brand', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_brand', ['only' => ['destroy']]);*/
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    /**
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(Brand::query()->orderByDesc('id'));

            return created_at_filter($DataTables)
            ->filterColumn('name', function ($q, $word) {
                return $q->whereHas('translations', function ($q) use ($word) {
                    $q->where('name', 'like', [(config('datatables.search.smart') === true?'%':'') . "$word%"]);
                });
            })
            ->filterColumn('logo_thumb', function ($q, $word) {
                return $q->whereHas('translations', function ($q) use ($word) {
                    $q->where('name', 'like', "$word%");
                });
            })->editColumn('created_at', function (Brand $brand) {
                return optional($brand->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (Brand $brand) {
                return route('admin.brands.edit', $brand);
            })->addColumn('delete_url', function (Brand $brand) {
                return route('admin.brands.destroy', $brand);
            })->addColumn('logo_thumb', '@isset($logo_thumb)
                    <img src="{{$logo_thumb}}" style="width: 64px;" class="thumbnail" alt="">@endisset')
                ->only([
                'id', 'name', 'logo_thumb', 'actions', 'created_at', 'update_url', 'delete_url',
            ])->rawColumns(['logo_thumb'])->make(true);
        }

        /*$query = Brand::query();
        $query->orderBy('id', 'desc');
        if (\request()->get('brand'))
            $query->whereParentId(\request()->get('brand'));
        $brand = $query->get();
        $data = ['rows' => $brand];*/
        return view('admin.content.brands.index');
    }

    public function import()
    {
        Excel::import(new BrandsImport, request()->file('file'));
        return back();
    }

    public function export()
    {
        return Excel::download(new BrandsExport, 'brands.xlsx');
    }

    public function create()
    {
        return view('admin.content.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name.*' => 'required|unique:brand_translations,name',
            # 'slug.*' => 'required|unique:brand_translations,slug',
            'logo' => 'required|mimes:jpeg,PNG,JPG,JPEG,jpg,png|max:10000'
        ]);

        try {
            DB::beginTransaction();
            $brand = new Brand();

            $logo = upload_file($request->file('logo'), 'brands');
            if ($logo) {
                $brand->logo = $logo;
            }

            # $brand->is_active = $request->get('active') == "on" ? 1 : 0 ;
            # $brand->parent_id = $request->get('parent_id');

            $brand->save();

            foreach ($this->languages as $local) {
                $brandTrans = new BrandTranslation();
                $brandTrans->brand_id = $brand->id;
                $brandTrans->name = $request->input('name.' . $local->locale);

                $brandTrans->meta_title = $request->input('meta_title.' . $local->locale);
                $brandTrans->meta_keywords = $request->input('meta_keywords.' . $local->locale);
                $brandTrans->meta_description = $request->input('meta_description.' . $local->locale);
                $brandTrans->locale = $local->locale;
                $brandTrans->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        # Brand::create($request->all());
        # log the action to database
        $logPayload = ['msg' => 'Brand Added', 'model_id' => $brand->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.brands.index');
    }

    public function show(Brand $brand)
    {
        $data = ['row' => $brand];
        return view('admin.content.brands.show')->with($data);
    }

    public function edit(Brand $brand)
    {
        $data = [
            'row' => $brand,
        ];
        return view('admin.content.brands.edit')->with($data);
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name.*' => 'required',
            # 'logo' => 'required',
            'logo' => 'mimes:jpeg,PNG,JPG,JPEG,jpg,png|max:10000'
        ]);

        $logo = upload_file($request->file('logo'), 'brands');
        if ($logo) {
            $brand->logo = $logo;
        }

        $brand->save();

        foreach ($this->languages as $local) {
            $brandTrans = BrandTranslation::where([
                'brand_id' => $brand->id,
                'locale' => $local->locale,
            ])->first();
            if (!$brandTrans) {
                $brandTrans = new BrandTranslation();
            }
            $brandTrans->brand_id = $brand->id;
            $brandTrans->name = $request->input('name.' . $local->locale);

            $brandTrans->meta_title = $request->input('meta_title.' . $local->locale);
            $brandTrans->meta_keywords = $request->input('meta_keywords.' . $local->locale);
            $brandTrans->meta_description = $request->input('meta_description.' . $local->locale);
            $brandTrans->locale = $local->locale;
            $brandTrans->save();
        }
        # log the action to database
        $logPayload = ['msg' => 'Brand Updated', 'model_id' => $brand->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.brands.index');
    }

    public function destroy(Brand $brand)
    {
        try {
            DB::beginTransaction();
            $brandTrans = BrandTranslation::where('brand_id', $brand->id)->delete();
            $brand->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
//        return redirect()->route('admin.brands.index');
    }
}
