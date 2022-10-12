<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Language;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Models\AttributeCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributesRequest;
use App\Models\Translations\CategoryTranslation;
use App\Models\Translations\AttributeTranslation;
use App\Models\Translations\AttributeCategoryTranslation;

class AttributeGroupsController extends Controller
{
    public function __construct()
    {
        /*$this->middleware('permission:view_attribute');
        $this->middleware('permission:create_attribute', ['only' => ['create','store']]);
        $this->middleware('permission:edit_attribute', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_attribute', ['only' => ['destroy']]);*/
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    public function index(\Illuminate\Http\Request $request)
    {
//        return Attribute::query()->whereNull('group_id')->withCount('childes', 'categories')->orderByDesc('id')->first();
        if ($request->ajax() && $request->has('draw')) {
            $DataTables = DataTables::of(Attribute::query()->whereNull('group_id')->withCount('childes', 'categories')->orderByDesc('id'));
            return created_at_filter($DataTables)->filterColumn('name', function ($q, $word) {
                return $q->whereHas('translations', function ($q) use ($word) {
                    $q->where('name', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$word%"]);
                });
            })
            ->filterColumn('status', function ($q, $word) {
                $status = null;
                if (Str::startsWith('a', $word) || Str::startsWith('ac', $word) || Str::startsWith('act', $word) || Str::startsWith('acti', $word) || Str::startsWith('activ', $word) || Str::startsWith('active', $word)) {
                    $status = 1;
                }
                if (Str::startsWith('i', $word) || Str::startsWith('in', $word) || Str::startsWith('ina', $word) || Str::startsWith('inac', $word) || Str::startsWith('inact', $word) || Str::startsWith('inacti', $word) || Str::startsWith('inactiv', $word) || Str::startsWith('inactive', $word)) {
                    $status = 0;
                }
                $q->where('is_active', $status);
            })
            ->editColumn('created_at', function (Attribute $attr) {
                return optional($attr->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (Attribute $attr) {
                return route('admin.attrGroups.edit', $attr);
            })->addColumn('delete_url', function (Attribute $attr) {
                return route('admin.attrGroups.destroy', $attr);
            })->addColumn('attrCount', function (Attribute $attr) {
                return $attr->childes_count?? 0;
            })->addColumn('status', function (Attribute $attr) {
                return $attr->is_active ?
                    '<label class="badge rounded-pill bg-success">'.__('auth.active').'</label>' :
                    '<label class="badge rounded-pill bg-danger">'.__('auth.inActive').'</label>';
            })->addColumn('actions', function (Attribute $attr) {
                return [
                    ['url' => route('admin.attribute.activation', $attr), 'icon' => $attr->is_active ? 'x-circle' : 'check-circle',]
                ];
            })->only([
                'id', 'name', 'category', 'attrCount', 'status', 'actions', 'created_at', 'update_url', 'delete_url',
            ])->rawColumns(['status'])->make(true);
        }

        return view('admin.content.attributeGroups.index');
    }

    public function create()
    {
        $categories = Category::query()->whereNotNull('parent_id')->get();
        return view('admin.content.attributeGroups.create', compact('categories'));
    }

    public function store(AttributesRequest $request)
    {
//        return $request;

//        $attribute = Attribute::create([
//            'is_active' => $request->is_active
//        ]);

        $request->is_active = $request->has('is_active');

        try {
            DB::beginTransaction();
            $attr = Attribute::query()->create(['is_active'=>$request->is_active]);
            foreach ($this->languages as $lang) {
                $attTrans = new AttributeTranslation();
                $attTrans->attribute_id = $attr->id;
                $attTrans->name = $request->input('name.'.$lang->locale);
                $attTrans->locale = $lang->locale;
                $attTrans->save();
            }

            if ($request->input('category_id')) {
                foreach ($request->input('category_id') as $attrCat) {
                    $attrGroup = new AttributeCategory();
                    $attrGroup->category_id     = $attrCat;
                    $attrGroup->attribute_id    = $attr->id;
                    $attrGroup->save();
                }
            }

            DB::commit();
//            $logPayload = ['msg' => 'Attribute Group Added', 'model_id' => $attribute->id, 'user_id' => auth()->id()];
//            logToDatabase($logPayload);
            return redirect()->route('admin.attrGroups.index')->with('New Attribute Category Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('admin.attrGroups.index')->with('Error While Creating New Attribute Category .!');
        }
    }

    public function show($id)
    {
        return redirect(404);
    }

    public function edit($id)
    {
//        return Attribute::query()->whereNull('group_id')->findOrFail($id)->getCategoriesId();
        $data = [
            'row' => Attribute::query()->whereNull('group_id')->findOrFail($id),
            'categories' => Category::query()->where('is_active', true)->get()
        ];

        return view('admin.content.attributeGroups.edit')->with($data);
    }

    public function update(AttributesRequest $request, $id)
    {
        $attribute = Attribute::findOrFail($id);

        try {
            DB::beginTransaction();

            $request->is_active = $request->has('is_active');

            $attribute->update($request->all());

            $attribute->group_categories()->sync($request->category_id);

            foreach ($attribute->childes()->get() as $childAttr) {
                $childAttr->group_categories()->sync($request->category_id);
            }

            foreach ($this->languages as $lang) {
                $trans = AttributeTranslation::query()->where(['locale' => $lang->locale,'attribute_id'=>$id])->first();
                if (!$trans) {
                    $trans = new AttributeTranslation();
                }
                $trans->locale =  $lang->locale;
                $trans->name =  $request->input("name.$lang->locale");
                $trans->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        # log the action to database
        $logPayload = ['msg' => 'Attribute Group Updated', 'model_id' => $attribute->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.attrGroups.index')->with(['success', 'Attribute Group Updated Successfully!']);
    }

    public function destroy($id)
    {
        try {
            $attr = Attribute::find($id);
            DB::beginTransaction();
            if (!$attr->childes->count()) {
                $attr->categories()->delete();
                $attr->translations()->delete();
                $attr->delete();
            } else {
                return response()->json(['error' => 'can\'t delete this Attribute Group!'], 401);
            }
//                $attr->childes()->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function activate($id)
    {
        $attGroup = Attribute::query()->find($id);

        try {
            DB::beginTransaction();
            $attGroup->update(['is_active'=>!$attGroup->is_active]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect()->back();
    }
}
