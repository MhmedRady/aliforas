<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingCompanyRequset;
use App\Models\Country;
use App\Models\Language;
use App\Models\ShippingCompany;
use App\Models\State;
use App\Rules\UniqueCity;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingCompanyController extends Controller
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
        $companies = DataTables::of(ShippingCompany::query());

        if ($request->ajax() && $request->has('draw')) {
            return created_at_filter($companies)->filterColumn('name', function ($q, $word) {
                return $q->where('name', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$word%"]);
            })->addColumn(
                'update_url',
                fn (ShippingCompany $companies) =>
                route('admin.shipping_companies.edit', $companies)
            )->addColumn(
                'delete_url',
                fn (ShippingCompany $companies) =>
                route('admin.shipping_companies.destroy', $companies)
            )->
//            addColumn('fuel',fn(ShippingCompany $companies)=>
//                $companies->fuel
//            )->addColumn('code',fn(ShippingCompany $companies)=>
//                $companies->cod
//            )->addColumn('post',fn(ShippingCompany $companies)=>
//                $companies->post
//            )

            addColumn(
                'sipping_zones',
                fn (ShippingCompany $companies) =>
                $companies->zones->count() ??0
            )->only([
                'id', 'name', 'fuel', 'code', 'post', 'First Kg', 'sipping_zones', 'created_at', 'update_url', 'delete_url'
            ])->make(true);
        }

        return view('admin.content.shipping-companies.index');
    }

    public function data($controller = false)
    {
        $companies = ShippingCompany::query();

        // if (!\request()->get('length')) {
        //     $cities->limit(10);
        // }

        if ($controller) {
            $companies->limit(10)->orderBy('id', 'DESC');
        }

        return DataTables::eloquent($companies)
            ->addColumn('name', function (ShippingCompany $company) {
                return $company->name;
            })
            ->addColumn('fuel', function (ShippingCompany $company) {
                return $company->fuel;
            })
            ->addColumn('post', function (ShippingCompany $company) {
                return $company->post;
            })
            ->addColumn('vat', function (ShippingCompany $company) {
                return $company->vat;
            })
            ->addColumn('cod', function (ShippingCompany $company) {
                return $company->cod;
            })
            ->addColumn('first_kg_number', function (ShippingCompany $company) {
                return $company->first_kg_number;
            })
            ->addColumn('options', function (ShippingCompany $company) {
                $back = "";
                # $back .= '<a href="'. route('admin.products.show', $product->id) .'" class="btn waves-effect waves-light btn-outline-warning" title="edit">Show</a>';
                $back .= '&nbsp;<a href="' . route('admin.shipping_companies.edit', $company->id) . '" class="btn waves-effect waves-light btn-outline-info" title="edit">Edit</a>&nbsp;';

                $back .= \Form::open(['url' => route('admin.shipping_companies.destroy', $company->id), 'class' => 'd-inline', 'onclick' => 'return confirm("Are you sure?")']);
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
        // $dbCity = ShippingCompany::get();
        // $cities = [];
        // $this->getCities($dbCity, $cities);
        $countries = Country::all();
        $states = State::all();

        return view('admin.content.shipping-companies.create', compact('countries', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ShippingCompanyRequset $request)
    {
        try {
            DB::beginTransaction();
            $shipping = new ShippingCompany();
            $shipping->name = $request->input('name');
            $shipping->fuel = $request->input('fuel')??0;
            $shipping->post = $request->post ?? 0;
            $shipping->vat = $request->vat ?? 0;
            $shipping->cod = $request->cod ?? 0;
            $shipping->first_kg_number = $request->first_kg_number??0;
            $shipping->save();
            DB::commit();
            $logPayload = ['msg' => 'Shipping Company Added', 'model_id' => $shipping->id, 'user_id' => auth()->id()];
            logToDatabase($logPayload);
            return redirect()->route('admin.shipping_companies.index')->with(['success'=>'New Sipping Company Created Successfully.!']);
            $logPayload = ['msg' => 'New Shipping Company Created', 'model_id' => $shipping->id, 'user_id' => auth()->id()];
            logToDatabase($logPayload);
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('admin.shipping_companies.index')->with(['error'=>'error while Saving Data, Try again Later.!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingCompany $company, $id)
    {

//        $countries = Country::all();
//        $states = State::all();
        $company = ShippingCompany::findOrFail($id);

        return view('admin.content.shipping-companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ShippingCompanyRequset $request, $id)
    {
        $shipping = ShippingCompany::findOrFail($id);

        try {
            DB::beginTransaction();
            $shipping->name = $request->input('name');
            $shipping->fuel = $request->input('fuel') ?? 0;
            $shipping->post = $request->input('post') ?? 0;
            $shipping->vat = $request->input('vat') ?? 0;
            $shipping->cod = $request->input('cod') ?? 0;
            $shipping->first_kg_number = $request->input('first_kg_number') ?? 0;
            $shipping->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        $logPayload = ['msg' => 'Shipping Company Updated', 'model_id' => $shipping->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        return redirect()->route('admin.shipping_companies.edit', $shipping);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingCompany $company, $id)
    {
        $company = ShippingCompany::find($id);
        $company->delete();
        $logPayload = ['msg' => 'Shipping Company Removed', 'model_id' => $company->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
//        return redirect()->route('admin.shipping_companies.index');
    }
}
