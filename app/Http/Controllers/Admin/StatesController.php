<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Language;
use App\Models\State;
use App\Models\Translations\StateTranslation;
use Form;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class StatesController extends Controller
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
        if ($request->ajax() || $request->has('draw')) {
            $DataTables = DataTables::of(State::query()->orderByDesc('id'));

            return created_at_filter($DataTables)
            ->filterColumn('name', function ($q, $word) {
                return $q->whereHas('translations', function ($q) use ($word) {
                    $q->where('name', 'like', [(config('datatables.search.smart') === true ? '%' : '') . "$word%"]);
                });
            })
            ->filterColumn('Country', function ($q, $word) {
                $q->whereHas('country.translations', function ($q) use ($word) {
                    $q->where('name', 'like', "%$word%");
                });
            })
            ->addColumn('update_url', function (State $state) {
                return route('admin.states.edit', $state);
            })->editColumn('created_at', function (State $state) {
                return $state->created_at;
            })
            ->addColumn('Country', function (State $state) {
                return $state->country->name;
            })->addColumn('actions', function (State $state) {
                return [
//                    ['url' => route('admin.city.activation', $city), 'icon' => $city->is_active ? 'x-circle' : 'check-circle',]
                ];
            })->only([
                'id', 'name', 'Country', 'actions', 'created_at', 'update_url'
            ])->make(true);
        }
        return view('admin.content.states.index');
    }

    public function data()
    {
        $states = State::query();
        if (!\request()->get('length')) {
            $states->limit(10);
        }
        return DataTables::eloquent($states)->editColumn('country_id', function (State $state) {
            return optional($state->country)->name;
        })->addColumn('options', function (State $state) {
            $back = "";
            //$back .= '<a href="'. route('admin.states.show', $state->id) .'" class="btn waves-effect waves-light btn-outline-warning" title="edit">Show</a>';
            $back .= '&nbsp;<a href="' . route('admin.states.edit', $state->id) . '" class="btn waves-effect waves-light btn-outline-info" title="edit">Edit</a>&nbsp;';
            $back .= Form::open(['url' => route('admin.states.destroy', $state->id), 'class' => 'd-inline', 'onclick' => 'return confirm("Are you sure?")']);
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
        $countries = Country::all();
        return view('admin.content.states.create', compact('countries'));
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
            'country_id' => 'required|max:15|exists:countries,id',
            'name' => 'required|array',
            'name.*' => 'required|string',
        ]);
        $state = new State();
        $state->country_id = $request->country_id;
        $state->save();
        foreach ($this->languages as $local) {
            $countryTrans = new StateTranslation();
            $countryTrans->state_id = $state->id;
            $countryTrans->name = $request->input('name.' . $local->locale);

            $countryTrans->locale = $local->locale;
            $countryTrans->save();
        }
        $logPayload = ['msg' => 'State Added', 'model_id' => $state->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.states.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param State $state
     * @return Application|Factory|View
     */
    public function edit(State $state)
    {
        return view('admin.content.states.edit')->with([
            'row' => $state,
            'countries' => Country::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param State $state
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, State $state)
    {
        $this->validate($request, [
            'country_id' => 'required|max:15|exists:countries,id',
            'name' => 'required|array',
            'name.*' => 'required|string',
        ]);
        $state->country_id = $request->country_id;
        $state->save();
        foreach ($this->languages as $local) {
            $stateTrans = StateTranslation::where([
                'state_id' => $state->id,
                'locale' => $local->locale,
            ])->first();
            if (!$stateTrans) {
                $stateTrans = new StateTranslation();
            }
            $stateTrans->state_id = $state->id;
            $stateTrans->name = $request->input('name.' . $local->locale);
            $stateTrans->save();
        }
        $logPayload = ['msg' => 'State Updated', 'model_id' => $state->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.states.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param State $state
     * @return RedirectResponse
     */
    public function destroy(State $state)
    {
        $state->delete();
        session()->flash('success');
        return redirect()->route('admin.states.index');
    }
}
