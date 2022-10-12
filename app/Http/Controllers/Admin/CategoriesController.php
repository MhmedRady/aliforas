<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Exports\CategoriesExport;
use App\Imports\CategoriesImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Translations\CategoryTranslation;

class CategoriesController extends Controller
{
    public function __construct()
    {

        /* $this->middleware('permission:view_category');
        $this->middleware('permission:create_category', ['only' => ['create','store']]);
        $this->middleware('permission:edit_category', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_category', ['only' => ['destroy']]); */

        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    public function index(Request $request)
    {

//        return $cat->parent->name;
        if ($request->ajax() || $request->has('draw')) {

            /** @var EloquentDataTable $DataTables */

            $DataTables = DataTables::of(Category::with('parent'));

            return created_at_filter($DataTables)
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereHas('translations', function ($query) use ($keyword) {
                    $query->where('name', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$keyword%"]);
                });
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereHas('translations', function ($query) use ($keyword) {
                    $query->where('name', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$keyword%"]);
                });
            })
            ->filterColumn('shipping_type', function ($q, $word) {
                $word = strtolower($word);
                if (Str::contains('one piece', $word)) {
                    $q->where('shipping_type', 0)->orWhereNull('shipping_type');
                } else {
                    $q->where('shipping_type', 1);
                }
            })
            ->filterColumn('parent', function ($q, $word) {
                $word = strtolower($word);
                $availableTrans = CategoryTranslation::where('name', 'like', "%$word%")->pluck('category_id')->toArray();
                $q->whereHas('parent', fn ($query) => $query->whereIn('id', $availableTrans));
            })
            ->filterColumn('is_active', function ($q, $word) {
                $status = null;
                if (Str::startsWith('a', $word) || Str::startsWith('ac', $word) || Str::startsWith('act', $word) || Str::startsWith('acti', $word) || Str::startsWith('activ', $word) || Str::startsWith('active', $word)) {
                    $status = 1;
                }
                if (Str::startsWith('i', $word) || Str::startsWith('in', $word) || Str::startsWith('ina', $word) || Str::startsWith('inac', $word) || Str::startsWith('inact', $word) || Str::startsWith('inacti', $word) || Str::startsWith('inactiv', $word) || Str::startsWith('inactive', $word)) {
                    $status = 0;
                }
                $q->where('is_active', $status);
            })
            ->editColumn('created_at', function (Category $category) {
                return optional($category->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (Category $category) {
                return route('admin.categories.edit', $category);
            })->addColumn('delete_url', function (Category $category) {
                return route('admin.categories.destroy', $category);
            })->editColumn('parent', function (Category $category) {
                return optional($category->parent)->name;
            })->editColumn('shipping_type', function (Category $category) {
                return $category->shipping_type == 0 ? 'One Piece' : "Total Pieces - {$category->shipping_value}";
            })->editColumn('is_active', function (Category $category) {
                return $category->is_active ? 'Active' : 'InActive';
            })->addColumn('actions', function (Category $category) {
                return
                    [
                        ['url' => route('admin.categories.active', $category), 'icon' => $category->is_active ? 'x-circle' : 'check-circle',],
                    ];
            })->only(['id', 'name', 'parent', 'shipping_type', 'delete_url', 'is_active', 'status', 'update_url', 'created_at', 'actions'])
                ->make(true);
        }
        return view('admin.content.categories.index');
    }

//    public function index(\Illuminate\Http\Request $request)
//    {
//
//        $query = Category::query();
//
//        if (\request()->get('category'))
//            $query->whereParentId(\request()->get('category'));
//
//        $category = $query->get();
//
//        $data = ['rows' => $category];
//        return view('admin.content.categories.index')->with($data);
//    }

    public function import()
    {
        Excel::import(new CategoriesImport, request()->file('file'));
        return back();
    }

    public function export()
    {
        return Excel::download(new CategoriesExport(), 'categories.xlsx');
    }

    public function create()
    {
        $dbCat = Category::get();
        $categories = [];
        $this->getCategories($dbCat, $categories);

        return view('admin.content.categories.create', compact('categories'));
    }

    public function getCategories($categories, &$result, $parent_id = 0, $depth = 0)
    {
        //filter only categories under current "parent"
        $cats = $categories->filter(function ($item) use ($parent_id) {
            return $item->parent_id == $parent_id;
        });

        //loop through them
        foreach ($cats as $cat) {
            //add category. Don't forget the dashes in front. Use ID as index
            $result[$cat->id] = str_repeat('-', $depth) . ($depth ? ' ' : '') . $cat->name;
            //go deeper - let's look for "children" of current category
            $this->getCategories($categories, $result, $cat->id, $depth + 1);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'name.*' => 'required',
//            'slug.*' => 'required|unique:category_translations,slug',
            'icon' => 'required|mimes:jpeg,PNG,JPG,JPEG,jpg,png|max:10000',
            'banner' => 'required|mimes:jpeg,PNG,JPG,JPEG,jpg,png|max:10000'
        ]);
        $category = new Category();
        $category->is_active = $request->get('active') == "on" ? 1 : 0;
        $category->in_header = $request->get('in_header') == "on" ? 1 : 0;
        $category->parent_id = $request->get('parent_id');
        $category->return_policy = $request->get('return_policy');
        $category->arrange = $request->get('arrange');
        $category->shipping_type = $request->get('shipping_type');
        $category->shipping_value = $request->get('shipping_value');

        $category->icon = upload_file($request->file('icon'), 'categories');
        $category->banner = upload_file($request->file('banner'), 'categories');

        $category->save();
        $check_sub = Category::where('parent_id', $category->id)->get();
        foreach ($check_sub as $sub) {
            if ((int)$sub->shipping_type < 1) {
                $sub->shipping_type = $request->get('shipping_type');
                $sub->shipping_value = $request->get('shipping_value');
                $sub->save();
            }
        }

        foreach ($this->languages as $local) {
            $categoryTrans = new CategoryTranslation();
            $categoryTrans->category_id = $category->id;
            $categoryTrans->name = $request->input('name.' . $local->locale);
            $categoryTrans->slug = $request->input('slug.' . $local->locale);
            $categoryTrans->description = $request->input('description.' . $local->locale);

            $categoryTrans->meta_title = $request->input('meta_title.' . $local->locale);
            $categoryTrans->meta_keywords = $request->input('meta_keywords.' . $local->locale);
            $categoryTrans->meta_description = $request->input('meta_description.' . $local->locale);
            $categoryTrans->locale = $local->locale;
            $categoryTrans->save();
        }

        # Category::create($request->all());
        $logPayload = ['msg' => 'Category Added', 'model_id' => $category->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category)
    {
        $data = ['row' => $category];
        return view('admin.content.categories.show')->with($data);
    }

    public function active($id)
    {
        $category = Category::findOrFail($id);
        if ($category->is_active == 0) {
            $category->update([
                'is_active' => '1'
            ]);
        } else {
            $category->update([
                'is_active' => '0'
            ]);
        }
        return redirect()->back();
//        return response()->json(['status' => 'success', 'active' => $category->is_active, 'msg' => 'Category Activated Successfully!']);
    }

    public function edit(Category $category)
    {
        $dbCat = Category::where('id', '!=', $category->id)->get();
        $categories = [];
        $this->getCategories($dbCat, $categories);

        $data = [
            'row' => $category,
            'categories' => $categories,
        ];
        return view('admin.content.categories.edit')->with($data);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name.*' => 'required',
            'slug.*' => 'required',
            'icon' => 'mimes:jpeg,PNG,JPG,JPEG,jpg,png|max:10000',
            'banner' => 'mimes:jpeg,PNG,JPG,JPEG,jpg,png|max:10000'
        ]);

        $category->is_active = $request->get('active') == "on" ? 1 : 0;
        $category->in_header = $request->get('in_header') == "on" ? 1 : 0;
        $category->parent_id = $request->get('parent_id');
        $category->return_policy = $request->get('return_policy');
        $category->arrange = $request->get('arrange');
        $category->shipping_type = $request->get('shipping_type');
        $category->shipping_value = $request->get('shipping_value');

        if ($request->hasFile('icon')) {
            $icon = upload_file($request->file('icon'), 'categories');
            if ($icon) {
                $category->icon = $icon;
            }
        }


        if ($request->hasFile('banner')) {
            $banner = upload_file($request->file('banner'), 'categories');
            if ($banner) {
                $category->banner = $banner;
            }
        }

        $category->save();

        $check_sub = Category::where('parent_id', $category->id)->get();
        foreach ($check_sub as $sub) {
            if ((int)$sub->shipping_type < 1) {
                $sub->shipping_type = $request->get('shipping_type');
                $sub->shipping_value = $request->get('shipping_value');
                $sub->save();
            }
        }

        foreach ($this->languages as $local) {
            $categoryTrans = CategoryTranslation::where([
                'category_id' => $category->id,
                'locale' => $local->locale,
            ])->first();
            if (!$categoryTrans) {
                $categoryTrans = new CategoryTranslation();
            }
            $categoryTrans->category_id = $category->id;
            $categoryTrans->name = $request->input('name.' . $local->locale);
            $categoryTrans->slug = $request->input('slug.' . $local->locale);
            $categoryTrans->description = $request->input('description.' . $local->locale);

            $categoryTrans->meta_title = $request->input('meta_title.' . $local->locale);
            $categoryTrans->meta_keywords = $request->input('meta_keywords.' . $local->locale);
            $categoryTrans->meta_description = $request->input('meta_description.' . $local->locale);
            $categoryTrans->locale = $local->locale;
            $categoryTrans->save();
        }
        $logPayload = ['msg' => 'Category Updated', 'model_id' => $category->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.categories.index');
    }


    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();
            //check if category use in any product
            if (Product::where('category_id', $category->id)->first()) {
                toastr()->error('can\'t  delete because this category contain product');
                return redirect()->route('admin.categories.index');
            }
            $Products = ProductCategory::whereCategoryId($category->id)->delete();
            Category::where('parent_id', $category->id)->update([
                'parent_id' => 0
            ]);

            $categoryTrans = CategoryTranslation::where('category_id', $category->id)->delete();
            $category->delete();
            DB::commit();
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('can\'t  delete because this category contain product');
            return redirect()->route('admin.categories.index');
        }
    }
}
