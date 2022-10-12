<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Language;
use App\Models\Translations\CountryTranslation;
use App\Rules\UniqueCountry;
use DataTables;
use Illuminate\Http\Request;

class CountriesController extends Controller
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
        $countries = Country::all();
        return view('admin.content.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name.*' => 'required',
            'country_code' => 'required|unique:countries',
        ]);

        $country = new Country();
        $country->country_code = $request->country_code;
        $country->save();


        foreach ($this->languages as $local) {
            $countryTrans = new CountryTranslation();
            $countryTrans->country_id = $country->id;
            $countryTrans->name = $request->input('name.' . $local->locale);

            # $countryTrans->meta_title = $request->input('meta_title.'.$local->locale);
            # $countryTrans->meta_keywords = $request->input('meta_keywords.'.$local->locale);
            # $countryTrans->meta_description = $request->input('meta_description.'.$local->locale);
            $countryTrans->locale = $local->locale;
            $countryTrans->save();
        }
        $logPayload = ['msg' => 'Country Added', 'model_id' => $country->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.countries.index');
    }

    public function edit(Country $country)
    {
        $data = [
            'row' => $country,
        ];
        return view('admin.content.countries.edit')->with($data);
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
        $country = Country::find($id);

        $this->validate($request, [
            'name.*' => 'required',
            'country_code' => 'required|unique:countries,country_code,' . $country->id,
        ]);

        $country->country_code = $request->country_code;
        $country->save();

        foreach ($this->languages as $local) {
            $countryTrans = CountryTranslation::where([
                'country_id' => $country->id,
                'locale' => $local->locale,
            ])->first();
            if (!$countryTrans) {
                $countryTrans = new CountryTranslation();
            }
            $countryTrans->country_id = $country->id;
            $countryTrans->name = $request->input('name.' . $local->locale);

            # $countryTrans->meta_title = $request->input('meta_title.'.$local->locale);
            # $countryTrans->meta_keywords = $request->input('meta_keywords.'.$local->locale);
            # $countryTrans->meta_description = $request->input('meta_description.'.$local->locale);
            # $countryTrans->locale = $local->locale;
            $countryTrans->save();
        }

        $logPayload = ['msg' => 'Country Updated', 'model_id' => $country->id, 'user_id' => auth()->id()];
        logToDatabase($logPayload);
        session()->flash('success');
        return redirect()->route('admin.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->translations->each->delete();
        $country->delete();
        session()->flash('success');
        return redirect()->route('admin.countries.index');
    }
}
