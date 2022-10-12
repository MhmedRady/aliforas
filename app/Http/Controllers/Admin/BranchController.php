<?php

namespace App\Http\Controllers\Admin;

use Toaster;
use App\Models\User;

use App\Models\Language;
use App\Models\Auth\Seller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Seller\Branch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use Yajra\DataTables\EloquentDataTable;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Translations\BranchTranslation;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    private const BRANCH_VIEW = 'admin.content.branches.';

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            $DataTables = DataTables::of(Branch::query()->orderByDesc('id'));

            return created_at_filter($DataTables)->filterColumn('name', function ($q, $word) {
                return $q->whereHas('translations', function ($q) use ($word) {
                    $q->where('name', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$word%"]);
                });
            })
            ->filterColumn('seller', function ($q, $word) {
                $word = strtolower($word);
                $availableTrans = Seller::where('name', 'like', "%$word%")->pluck('id')->toArray();
                $q->whereHas('seller', fn ($query) => $query->whereIn('seller_id', $availableTrans));
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
            ->editColumn('created_at', function (Branch $Branch) {
                return optional($Branch->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (Branch $Branch) {
                return route('admin.branch.edit', $Branch);
            })->addColumn('delete_url', function (Branch $Branch) {
                return route('admin.branch.destroy', $Branch);
            })->editColumn('seller', function (Branch $Branch) {
                return $Branch->seller->name??"-";
            })->addColumn('products', function (Branch $Branch) {
                return $Branch->products->count();
            })->addColumn('is_active', function (Branch $Branch) {
                return $Branch->is_active ?
                    '<label class="badge rounded-pill bg-success">'.__('auth.active').'</label>' :
                    '<label class="badge rounded-pill bg-danger">'.__('auth.inActive').'</label>';
            })->addColumn('actions', function (Branch $Branch) {
                return [
                    ['url' => route('admin.branch.activation', $Branch), 'icon' => $Branch->is_active ? 'x-circle' : 'check-circle',]
                ];
            })->only([
                'id', 'name', 'seller', 'products', 'is_active', 'actions', 'created_at', 'update_url', 'delete_url', 'products',
            ])->rawColumns(['is_active'])->make(true);
        }
        return view(self::BRANCH_VIEW.'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(self::BRANCH_VIEW.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BranchRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BranchRequest $request)
    {
        try {
            DB::beginTransaction();
            $branch = Branch::query()->create([
                'is_active'=> true,
                'address'=> $request->input('address'),
                'seller_id'=> auth()->guard('seller')->user()->id,
                'lat'=> $request->input('lat'),
                'lng'=> $request->input('lng'),
            ]);

            foreach ($this->languages as $lang) {
                $branchTrans = new BranchTranslation();
                $branchTrans->name = $request->input('name.'.$lang->locale);
                $branchTrans->branch_id = $branch->id;
                $branchTrans->locale = $lang->locale;
                $branchTrans->save();
            }
            DB::commit();
            return redirect()->back()->with(['success'=>__(
                'auth.successNewSetting',
                ['var'=>__('layouts.branch')]
            )]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error'=>__('auth.errorNewSetting')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::query()->findOrFail($id);
        return view(self::BRANCH_VIEW.'edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, $id)
    {
        $branch = Branch::query()->findOrFail($id);

        try {
            DB::beginTransaction();
            $branch->update([
                'address'=> $request->input('address'),
                'lat'=> $request->input('lat'),
                'lng'=> $request->input('lng'),
            ]);
            foreach ($this->languages as $lang) {
                $branchTrans = BranchTranslation::query()->where([
                    'branch_id' => $branch->id,
                    'locale' => $lang->locale,
                ])->first();

                if (!$branchTrans) {
                    $branchTrans = new BranchTranslation();
                }
                $branchTrans->name = $request->input('name.'.$lang->locale);
                $branchTrans->locale = $lang->locale;
                $branchTrans->save();
            }
            DB::commit();
            return redirect()->back()->with(['success'=>__('auth.successSetting')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error'=>__('auth.errorSetting')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::query()->find($id);
        if ($branch) {
            $count = $branch->products->count();
            if ($count > 0) {
                return response()->json(['message'=>__('layouts.branchErrProducts', ['count'=>$count,'var'=>__('layouts.tBranch')])], 401);
            }
            try {
                DB::beginTransaction();
                BranchTranslation::query()->where('branch_id', $id)->delete();
                $branch->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return $e->getMessage();
            }
        }
    }

    /**
     * Activate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activation($id)
    {
        $branch = Branch::query()->findOrFail($id);
        try {
            DB::beginTransaction();
            $branch->update(['is_active'=>!$branch->is_active]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('admin.branch.index');
    }
}
