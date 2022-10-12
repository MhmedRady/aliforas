<?php

namespace App\Http\Controllers\Seller;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\BranchRequest;

use App\Models\Language;
use App\Models\Seller\Branch;
use App\Models\Translations\BranchTranslation;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

use Toaster;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    private const BRANCH_VIEW = 'seller.content.branches.';

    /**
     * Display a listing of the resource.
     *
     */

    public function index(Request $request)
    {

//        return  Branch::query()->where('seller_id',auth()->guard('seller')->id())
//            ->with('branchWithProduct', function ($q){
//                return $q->selectRaw("HAVING SUM(quantity) > 10");
        ////            return $q->having('SUM(quantity)', '>', 10);
//        })->orderByDesc('id')->first();

        if ($request->ajax() || $request->has('draw')) {
            $DataTables = DataTables::of(Branch::query()->where('seller_id', auth()->guard('seller')->id())->orderByDesc('id'));

            return created_at_filter($DataTables)->filterColumn('name', function ($q, $word) {
                return $q->whereHas('translations', function ($q) use ($word) {
                    $q->where('name', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$word%"]);
                });
            })->filterColumn('status', function ($q, $word) {
                return $q->where('is_active', 'like', Helper::filterActive($word));
            })->editColumn('created_at', function (Branch $Branch) {
                return optional($Branch->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (Branch $Branch) {
                return route('seller.branch.edit', $Branch);
            })->addColumn('delete_url', function (Branch $Branch) {
                return route('seller.branch.destroy', $Branch);
            })->addColumn('views', function (Branch $Branch) {
                return $Branch->views;
            })->addColumn('products', function (Branch $Branch) {
                return $Branch->products->sum('stock');
            })->addColumn('status', function (Branch $Branch) {
                return $Branch->is_active ?
                    '<label class="badge rounded-pill bg-success">'.__('auth.active').'</label>' :
                    '<label class="badge rounded-pill bg-danger">'.__('auth.inActive').'</label>';
            })->addColumn('actions', function (Branch $Branch) {
                return [
                    ['url' => route('seller.branch.activation', $Branch), 'icon' => $Branch->is_active ? 'x-circle' : 'check-circle',]
                ];
            })->only([
                'id', 'name', 'status', 'views', 'actions', 'created_at', 'update_url', 'delete_url', 'products',
            ])->rawColumns(['status'])->make(true);
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
            return redirect()->route('seller.branch.index')->with(['success'=>__(
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
        // return $branch->products->count();
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
            if ($count >0) {
                return response()->json(['message'=>__('layouts.branchErrProducts', ['count'=>$count,'var'=>__('layouts.tBranch')])], 401);
            }
            $branch->translations()->delete();
            $branch->delete();
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
        return redirect()->route('seller.branch.index');
    }

    public function makeAsRead(){
        $branches = Branch::query()->where('shown', false)->get();
        if ($branches->count()){
            $branches->each(function ($branch){
                $branch->update(['shown' => true]);
            });
        }
    }
}
