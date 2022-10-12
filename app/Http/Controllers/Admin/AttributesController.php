<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\AttributeCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributesRequest;
use App\Models\Translations\AttributeTranslation;

class AttributesController extends Controller
{
    public function __construct()
    {
        /*$this->middleware('permission:view_attribute');
        $this->middleware('permission:create_attribute', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_attribute', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_attribute', ['only' => ['destroy']]);*/
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    public function index(Request $request)
    {
//        return Attribute::query()->whereNotNull('group_id')->orderByDesc('id')->first()->parentAttr->name;

        if ($request->ajax() && $request->has('draw')) {
            $DataTables = DataTables::of(Attribute::query()->whereNotNull('group_id')->orderByDesc('id'));
            return created_at_filter($DataTables)->filterColumn('name', function ($q, $word) {
                return $q->whereHas('translations', function ($q) use ($word) {
                    $q->where('name', 'like', [(config('datatables.search.smart') === true?'%':'') . "$word%"]);
                });
            })
            ->filterColumn('parent', function ($q, $word) {
                return $q->whereHas('parentAttr.translations', function ($q) use ($word) {
                    $q->where('name', 'like', [(config('datatables.search.smart') === true?'%':'') . "$word%"]);
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
                return route('admin.attributes.edit', $attr);
            })->addColumn('delete_url', function (Attribute $attr) {
                return route('admin.attributes.destroy', $attr);
            })->addColumn('parent', function (Attribute $attr) {
                return $attr->parentAttr->name??'-';
            })->addColumn('status', function (Attribute $attr) {
                return $attr->is_active ?
                    '<label class="badge rounded-pill bg-success">'.__('auth.active').'</label>' :
                    '<label class="badge rounded-pill bg-danger">'.__('auth.inActive').'</label>';
            })->addColumn('actions', function (Attribute $attr) {
                return [
                    ['url' => route('admin.attribute.activation', $attr), 'icon' => $attr->is_active ? 'x-circle' : 'check-circle',]
                ];
            })->only([
                'id', 'name', 'parent', 'status', 'actions', 'created_at', 'update_url', 'delete_url',
            ])->rawColumns(['status'])->make(true);
        }
        return view('admin.content.attributes.index');
    }

    public function create()
    {
        $data = [
            'groups' => Attribute::parents()->get()->pluck('name:en', 'id')
        ];
        return view('admin.content.attributes.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
        'name.*' => 'required',
        'group_id' => 'required'
    ]);
        try {
            DB::beginTransaction();
            $attr = Attribute::query()->create(['group_id'=>$request->input('group_id'),'is_active'=>$request->is_active]);
            foreach ($this->languages as $lang) {
                $attTrans = new AttributeTranslation();
                $attTrans->attribute_id = $attr->id;
                $attTrans->name = $request->input('name.'.$lang->locale);
                $attTrans->locale = $lang->locale;
                $attTrans->save();
            }

            DB::commit();
//            $logPayload = ['msg' => 'Attribute Group Added', 'model_id' => $attribute->id, 'user_id' => auth()->id()];
//            logToDatabase($logPayload);
            return redirect()->route('admin.attributes.index')->with('New Attribute Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('admin.attributes.index')->with('Error While Creating New Attribute .!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = [
            'row' => Attribute::findOrFail($id),
            'groups' => Attribute::parents()->get()->pluck('name:en', 'id')
        ];
        return view('admin.content.attributes.edit')->with($data);
    }

    public function update(AttributesRequest $request, $id)
    {
        $request->merge(['is_active' => $request->has('is_active')]);

        try {
            $attribute = Attribute::query()->findOrFail($id);

            DB::beginTransaction();

            $attribute->update(['group_id'=>$request->input('group_id'), 'is_active'=>$request->input('is_active')]);

            foreach ($this->languages as $lang) {
                $trans = AttributeTranslation::query()->where(['locale' => $lang->locale,'attribute_id'=>$id])->first();
                if (!$trans) {
                    $trans = new AttributeTranslation();
                }
                $trans->locale =  $lang->locale;
                $trans->attribute_id =  $id;
                $trans->name =  $request->input("name.$lang->locale");
                $trans->save();
            }
            DB::commit();
            # log the action to database
            $logPayload = ['msg' => 'Attribute Updated', 'model_id' => $attribute->id, 'user_id' => auth()->id()];
            logToDatabase($logPayload);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return redirect()->route('admin.attributes.index');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $attr = Attribute::find($id);
            $attr->categories()->delete();
            $attr->translations()->delete();
            $attr->delete();
            DB::commit();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
