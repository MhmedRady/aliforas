<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\AboutUs;
use App\Http\Requests\ContactMessageRequest;
use App\Models\MainSetting;
use Illuminate\Support\Facades\DB;

class CMSPages extends Controller
{
    //
    private const ViewPath = 'root.layouts.';

    public function contact_us()
    {
        $data = MainSetting::query()->get();
        $mainSetting = [
           'address' => $data->where('key', 'address')->first()->value??false,
           'lat' => (int)$data->where('key', 'lat')->first()->value??false,
           'lng' => $data->where('key', 'lng')->first()->value??false,
           'email' => $data->where('key', 'email')->first()->value??false,
           'phone' => $data->where('key', 'phone')->first()->value??false,
           'fax' => $data->where('key', 'fax')->first()->value??false,
           'whatsapp' => $data->where('key', 'whatsapp')->first()->value??false,
        ];
        return view(self::ViewPath . 'contactUs-page', compact('mainSetting'));
    }

    public function sendContactMessage(ContactMessageRequest $request)
    {
        try {
            DB::beginTransaction();
                Contact::query()->create($request->except(['_token']));
            DB::commit();
            return redirect()->back()->with(['success'=>__('layouts.successMessage')]);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>__('auth.errorSetting   ')]);
        }
    }

    public function about_us()
    {
        $about = AboutUs::query()->where('is_active',1)->first();

        if ($about)
            return view(self::ViewPath . 'about-page',compact('about'));

        return redirect()->route('index');
    }
}
