<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Language;
use App\Models\State;
use App\Models\Translations\CityTranslation;
use Form;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class CitiesController extends Controller
{
    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(\Illuminate\Http\Request $request)
    {

//        return City::query()->orderByDesc('id')->get();
        if ($request->ajax() || $request->has('draw')) {
            $DataTables = DataTables::of(City::query()->orderByDesc('id'));

            return created_at_filter($DataTables)
            ->filterColumn('state', function ($q, $word) {
                $q->whereHas('state.translations', function ($q) use ($word) {
                    $q->where('name', 'like', "%$word%");
                });
            })
            ->filterColumn('name', function ($q, $word) {
                return $q->whereHas('translations', function ($q) use ($word) {
                    $q->where('name', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$word%"]);
                });
            })->addColumn('update_url', function (City $city) {
                return route('admin.cities.edit', $city);
            })->addColumn('state', function (City $city) {
                return $city->state->name;
            })->addColumn('actions', function (City $city) {
                return [
//                    ['url' => route('admin.city.activation', $city), 'icon' => $city->is_active ? 'x-circle' : 'check-circle',]
                ];
            })->only([
                'id', 'name', 'state', 'actions', 'created_at', 'update_url'
            ])->make(true);
        }
        return view('admin.content.cities.index');
    }

    public function data()
    {
        $cities = City::query();
        return DataTables::eloquent($cities)->addColumn('state', function (City $city) {
            return optional($city->state)->name;
        })->addColumn('options', function (City $city) {
            $back = "";
            // $back .= '<a href="'. route('admin.products.show', $product->id) .'" class="btn waves-effect waves-light btn-outline-warning" title="edit">Show</a>';
            $back .= '&nbsp;<a href="' . route('admin.cities.edit', $city->id) . '" class="btn waves-effect waves-light btn-outline-info" title="edit">Edit</a>&nbsp;';
            $back .= Form::open(['url' => route('admin.cities.destroy', $city->id), 'class' => 'd-inline', 'onclick' => 'return confirm("Are you sure?")']);
            $back .= method_field('DELETE');
            $back .= Form::submit('Delete', ['class' => 'btn btn-outline-danger sa-warning']);
            $back .= Form::close();
            return $back;
        })->rawColumns(['options'])->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $states = State::all();
        return view('admin.content.cities.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'state_id' => 'required|max:15|exists:states,id',
            'name' => 'required|array',
            'name.*' => 'required|string',
        ]);
        $city = new City();
        $city->state_id = $request->state_id;
        $city->save();
        foreach ($this->languages as $local) {
            $cityTrans = new CityTranslation();
            $cityTrans->city_id = $city->id;
            $cityTrans->name = $request->input('name.' . $local->locale);
            $cityTrans->locale = $local->locale;
            $cityTrans->save();
            //$cityTrans->meta_title = $request->input('meta_title.'.$local->locale);
            //$cityTrans->meta_keywords = $request->input('meta_keywords.'.$local->locale);
            //$cityTrans->meta_description = $request->input('meta_description.'.$local->locale);
        }
        $logPayload = ['msg' => 'City Added', 'model_id' => $city->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.cities.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param City $city
     * @return Application|Factory|View
     */
    public function edit(City $city)
    {
        $states = State::all();
        $row = $city;
        return view('admin.content.cities.edit', compact('states', 'row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param City $city
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, City $city)
    {
        $this->validate($request, [
            'state_id' => 'required|max:15|exists:states,id',
            'name' => 'required|array',
            'name.*' => 'required|string',
        ]);
        $city->state_id = $request->state_id;
        $city->save();
        foreach ($this->languages as $local) {
            $cityTrans = CityTranslation::where([
                'city_id' => $city->id,
                'locale' => $local->locale,
            ])->first();
            if (!$cityTrans) {
                $cityTrans = new CityTranslation();
            }
            $cityTrans->city_id = $city->id;
            $cityTrans->name = $request->input('name.' . $local->locale);
            $cityTrans->locale = $local->locale;
            $cityTrans->save();
        }
        $logPayload = ['msg' => 'City Updated', 'model_id' => $city->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     * @return RedirectResponse
     */
    public function destroy(City $city)
    {
        $city->delete();
        session()->flash('success');
        return redirect()->route('admin.cities.index');
    }
}
