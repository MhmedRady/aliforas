<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Translations\AboutUsTranslation;
use App\Models\Language;
use App\Models\AboutUs;
use Illuminate\Support\Facades\DB;
use Toaster;

class AboutUsController extends Controller
{

    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    public function aboutPage()
    {
        $aboutUs = AboutUs::query()->first();

        return view('admin.content.aboutPage.index',compact('aboutUs'));
    }

    public function store(Request $request)
    {
        $isActive = $request->has('is_active')?'1':'0';

        $aboutUs = AboutUs::query()->first();

            try {

                if ($aboutUs)
                {
                    $aboutUs->update(['is_active'=>$isActive]);

                    foreach ($this->languages as $local)
                    {
                        $aboutTrans =AboutUsTranslation::query()->where(
                            ['about_us_id' => $aboutUs->id, 'locale' => $local->locale])->first()
                            ?? new AboutUsTranslation();

                        $aboutTrans->about_us_id = $aboutUs->id;
                        $aboutTrans->locale = $local->locale;
                        $aboutTrans->document = $request->input('document.' . $local->locale);
                        $aboutTrans->save();
                    }

                }else{

                    $about = AboutUs::query()->create(['is_active'=>$isActive]);

                    foreach ($this->languages as $local)
                    {
                        $aboutTrans = new AboutUsTranslation();
                        $aboutTrans->about_us_id = $about->id;
                        $aboutTrans->locale = $local->locale;
                        $aboutTrans->document = $request->input('document.' . $local->locale);
                        $aboutTrans->save();
                    }
                }

                DB::commit();
                Toaster::Success('Slider Created Successfully','success');
            }catch (\Exception $e){
                Toaster::Error('Error While Saving Data Try again Later','error');
            }
        return redirect()->route('admin.aboutUsContent');
    }
}
