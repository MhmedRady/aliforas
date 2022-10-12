<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\ShippingCompany;
use App\Models\ShippingZone;
use App\Models\State;
use App\Rules\UniqueCity;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    public function index(\Illuminate\Http\Request $request)
    {
//        return ShippingZone::query()->get()->first()->company->name;
        $area = DataTables::of(ShippingZone::query());
        if ($request->ajax() && $request->has('draw')) {
            return created_at_filter($area)
            ->filterColumn('name', function ($q, $word) {
                return $q->where('name', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$word%"]);
            })
            ->filterColumn('Additional Kg', function ($q, $word) {
                return $q->where('additional_kg', 'like', "%$word%");
            })
            ->filterColumn('First Kg', function ($q, $word) {
                return $q->where('first_kg', 'like', "%$word%");
            })
            ->filterColumn('cod', function ($q, $word) {
                return $q->where('cod_values', 'like', "%$word%");
            })
            ->filterColumn('company', function ($q, $word) {
                $q->whereHas('company', function ($q) use ($word) {
                    $q->where('name', 'like', "%$word%");
                });
            })
            ->addColumn(
                'update_url',
                fn (ShippingZone $shippingZone) =>
            route('admin.shipping_zones.edit', $shippingZone)
            )->addColumn(
                'delete_url',
                fn (ShippingZone $shippingZone) =>
            route('admin.shipping_zones.destroy', $shippingZone)
            )->addColumn(
                'company',
                fn (ShippingZone $shippingZone) =>
            $shippingZone->company->name?? ' - '
            )->editColumn(
                'cod',
                fn (ShippingZone $shippingZone) =>
            $shippingZone->cod_values
            )->editColumn(
                'First Kg',
                fn (ShippingZone $shippingZone) =>
            $shippingZone->first_kg
            )->editColumn(
                'Additional Kg',
                fn (ShippingZone $shippingZone) =>
            $shippingZone->additional_kg
            )->only([
                'id', 'name', 'company', 'cod', 'First Kg', 'Additional Kg', 'created_at', 'update_url', 'delete_url'
            ])->make(true);
        }
        return view('admin.content.shipping-zones.index');
    }

    public function data($controller = false)
    {
        $zones = ShippingZone::query();

        // if (!\request()->get('length')) {
        //     $cities->limit(10);
        // }

        if ($controller) {
            $zones->limit(10)->orderBy('id', 'DESC');
        }

        return DataTables::eloquent($zones)
            ->addColumn('zone_name', function (ShippingZone $zone) {
                return $zone->zone_name;
            })
            // ->addColumn('areas', function (ShippingZone $zone){
            //     return $zone->get_areas();
            // })
            ->addColumn('first_kg', function (ShippingZone $zone) {
                return $zone->first_kg;
            })
            ->addColumn('additional_kg', function (ShippingZone $zone) {
                return $zone->additional_kg;
            })
            ->addColumn('company_id', function (ShippingZone $zone) {
                return $zone->company->name;
            })
            ->addColumn('options', function (ShippingZone $zone) {
                $back = "";
                # $back .= '<a href="'. route('admin.products.show', $product->id) .'" class="btn waves-effect waves-light btn-outline-warning" title="edit">Show</a>';
                $back .= '&nbsp;<a href="' . route('admin.shipping_zones.edit', $zone->id) . '" class="btn waves-effect waves-light btn-outline-info" title="edit">Edit</a>&nbsp;';

                $back .= \Form::open(['url' => route('admin.shipping_zones.destroy', $zone->id), 'class' => 'd-inline', 'onclick' => 'return confirm("Are you sure?")']);
                $back .= method_field('DELETE');
                $back .= \Form::submit('Delete', ['class' => 'btn btn-outline-danger sa-warning']);
                $back .= \Form::close();

                return $back;
            })->rawColumns(['options'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $dbCity = ShippingZone::get();
        // $cities = [];
        // $this->getCities($dbCity, $cities);
        $companies = ShippingCompany::all();
        $areas = State::all();

        return view('admin.content.shipping-zones.create', compact('companies', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request;
        $this->validate($request, [
            'zone_name' => 'required',
            'first_kg' => 'required',
            'additional_kg' => 'required',
            'areas' => 'required',
            'company_id' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $shipping = new ShippingZone();
            $shipping->name = $request->zone_name;
            $shipping->first_kg = $request->first_kg;
            $shipping->additional_kg = $request->additional_kg;
            $shipping->areas = json_encode($request->input('areas'));
            $shipping->company_id = $request->company_id;
            $shipping->cod_values = $request->cod_values ? $request->cod_values : 0;
            $shipping->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        $logPayload = ['msg' => 'Zone Added', 'model_id' => $shipping->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.shipping_zones.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingZone $zone, $id)
    {
        $zone = ShippingZone::query()->findorfail($id);
        $companies = ShippingCompany::all();
        $areas = State::all();

//        $area = $areas->filter(function ($area) use ($zone){
//            return in_array($area->id, $zone->areas);
//        });
//        return $area;
        return view('admin.content.shipping-zones.edit', compact('companies', 'areas', 'zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shipping = ShippingZone::find($id);

        $this->validate($request, [
            'zone_name' => 'required',
            'first_kg' => 'required',
            'additional_kg' => 'required',
            'areas' => 'required',
            'company_id' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $shipping->name = $request->zone_name;
            $shipping->first_kg = $request->first_kg;
            $shipping->additional_kg = $request->additional_kg;
            $shipping->areas = json_encode($request->areas);
            $shipping->company_id = $request->company_id;
            $shipping->cod_values = $request->cod_values;
            $shipping->cod_values = $request->cod_values ? $request->cod_values : 0;
            $shipping->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        $logPayload = ['msg' => 'Zone Updated', 'model_id' => $shipping->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.shipping_zones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingZone $zone, $id)
    {
        $company = ShippingZone::find($id);
        $company->delete();
//        return redirect()->route('admin.shipping_zones.index');
    }
}
