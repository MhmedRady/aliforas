<?php

namespace App\Http\Controllers\Admin;

use Toaster;
use App\Models\Slider;
use App\Helpers\Helper;
use App\Models\Product;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Translations\SliderTranslation;

class SliderController extends Controller
{
    private const sliderView = 'admin.content.slider.';

    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */
            $DataTables = DataTables::of(Slider::query()->orderByDesc('id'));

            return created_at_filter($DataTables)->filterColumn('product', function ($query, $word) {
                return $query->whereHas('product', function ($q) use ($word) {
                    return $q->whereHas('translations', function ($q) use ($word) {
                        $q->where('name', 'like', [(config('datatables.search.smart') === true?'%':'') . "$word%"]);
                    });
                });
            })
            ->filterColumn('image', function ($query, $word) {
                return $query->whereHas('product', function ($q) use ($word) {
                    return $q->whereHas('translations', function ($q) use ($word) {
                        $q->where('name', 'like', [(config('datatables.search.smart') === true?'%':'') . "$word%"]);
                    });
                });
            })
            ->filterColumn('type', function ($q, $word) {
                $word = strtolower($word);
                $isBanner = null;
                if (Str::contains('banner', $word)) {
                    $isBanner = 1;
                }
                if (Str::contains('slider', $word) || Str::contains('tab', $word) || Str::startsWith('s', $word) || Str::startsWith('sl', $word) || Str::startsWith('sli', $word) || Str::startsWith('slid', $word) || Str::startsWith('slide', $word) || Str::startsWith('slider', $word)) {
                    $isBanner = 0;
                }
                $q->where('is_banner', 'like', "%$isBanner%");
            })
            ->filterColumn('status', function ($q, $word) {
                $word = strtolower($word);
                $status = null;

                if (Str::contains('active', $word) || Str::startsWith('a', $word) || Str::startsWith('ac', $word) || Str::startsWith('act', $word) || Str::startsWith('acti', $word) || Str::startsWith('activ', $word) || Str::startsWith('active', $word)) {
                    $status = 1;
                }
                if (Str::contains('inactive', $word) || Str::startsWith('i', $word) || Str::startsWith('in', $word) || Str::startsWith('ina', $word) || Str::startsWith('inac', $word) || Str::startsWith('inact', $word) || Str::startsWith('inacti', $word) || Str::startsWith('inactiv', $word) || Str::startsWith('inactive', $word)) {
                    $status = 0;
                }
                $q->where('is_active', 'like', "%$status%");
            })
            ->editColumn('created_at', function (slider $slider) {
                return optional($slider->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (Slider $slider) {
                return route('admin.slider.edit', $slider);
            })->addColumn('delete_url', function (Slider $slider) {
                return route('admin.slider.destroy', $slider);
            })->
            addColumn('product', function (Slider $slider) {
                return $slider->product->name??'_';
            })->
            editColumn('type', function (Slider $slider) {
                return $slider->is_banner
                    ? '<span class="badge btn-dark">Banner</span>'
                    : '<span class="badge btn-success">Slider Tab</span>';
            })->addColumn('status', function (Slider $slider) {
                return $slider->is_active
                    ? '<span class="badge btn-info">Active</span>'
                    : '<span class="badge btn-danger">Inactive</span>';
            })->addColumn('actions', function (Slider $slider) {
                return
                    [
                        ['url' => route('admin.sliderActivation', $slider), 'icon' => $slider->is_active ? 'x-circle' : 'check-circle'],
                    ];
            })->addColumn(
                'image',
                '@isset($image_thumb)
                    <img src="{{$image_thumb}}" style="max-height: 80px;" class="img-thumbnail justify-content-center w-100 m-auto d-flex" alt="">
                @endisset'
            )->only([
                'id', 'product', 'image', 'actions','status', 'created_at', 'update_url', 'delete_url', 'type',
            ])->rawColumns(['image','type','status'])->make(true);
        }
        return view(self::sliderView.'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productsSelector();

        return view(self::sliderView.'create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SliderRequest $request)
    {
        $active = $request->has('is_active')?1:0;
        $isSlider = $request->has('is_banner')?'1':'0';
        $code = 'slider';
        if ($request->has('is_banner')) {
            $code = 'banner';
            $image = upload_file($request->file('image'), 'slider', 1140, 460);
        } else {
            $image = upload_file($request->file('image'), 'slider', 1140, 460);
        }

        try {
            DB::beginTransaction();
            $slider = Slider::query()->create(['product_id'=>$request->input('product_id'),'is_active'=>$active, 'is_banner'=>$isSlider, 'image'=>$image, 'code'=> $code]);

            foreach ($this->languages as $local)
            {
                $sliderTrans = new SliderTranslation();
                $sliderTrans->slider_id = $slider->id;
                $sliderTrans->locale = $local->locale;
                $sliderTrans->title = $request->input('title.' . $local->locale);
                $sliderTrans->sub_title = $request->input('sub_title.' . $local->locale);
                $sliderTrans->description = !$request->has('is_banner')?$request->input('description.' . $local->locale):null;
                $sliderTrans->save();
            }

            DB::commit();
            return redirect()->route('admin.slider.create')->with(['success'=>'Slider Created Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->route('admin.slider.create')->with(['error'=>'Error While Saving Data Try again Later']);
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
        return redirect(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::query()->findOrFail($id);

        $products = $this->productsSelector();

        return view(self::sliderView.'edit', compact('slider', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SliderRequest $request, $id)
    {
        //
        $slider = Slider::query()->findOrFail($id);

        $active = $request->has('is_active')?'1':'0';
        $isBanner = $request->has('is_banner')?'1':'0';
        $code = $slider->code;
        if ($request->has('is_banner')) {
            $code = 'banner';
            $image = $request->has('image')?upload_file($request->file('image'), 'slider', 400, 250):$slider->image;
        } else {
            $image = $request->has('image')?upload_file($request->file('image'), 'slider', 500, 450):$slider->image;
        }
        try {
            DB::beginTransaction();
            $slider->update(['is_active'=>$active, 'image'=>$image, 'is_banner'=>$isBanner,'product_id'=>$request->input('product_id'), 'code'=> $code]);

//            foreach ($this->languages as $local)
//            {
//                $sliderTrans = SliderTranslation::query()->where(
//                    ['slider_id' => $slider->id, 'locale' => $local->locale])->first()
//                    ?? new SliderTranslation();
//
//                $sliderTrans->slider_id = $slider->id;
//                $sliderTrans->locale = $local->locale;
//                $sliderTrans->title = $request->input('title.' . $local->locale);
//                $sliderTrans->sub_title = $request->input('sub_title.' . $local->locale);
//                $sliderTrans->description = $request->input('description.' . $local->locale);
//                $sliderTrans->save();
//            }
            DB::commit();
            return redirect()->route('admin.slider.create')->with(['success'=>'Slider Updated Successfully']);
        } catch (\Exception $e) {
//            return $e->getMessage();
            return redirect()->route('admin.slider.create')->with(['success'=>'Error While Saving Data Try again Later']);
        }
    }

    /**
     * Activate the specified resource from storage.
     *
     * @param int $id
     * @param  \App\Models\Slider  $id
     */
    public function activation(int $id)
    {
        $slider = Slider::query()->findOrFail($id);
        $active = $slider->is_active?'0':'1';
        $slider->update(['is_active'=>$active]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $slider = Slider::query()->find($id);

        if ($slider) {
            SliderTranslation::query()->where(['slider_id'=>$id])->delete();
            $slider->delete();
        }
    }

    public function productsSelector($product = null)
    {
        if (is_null($product)) {
            return Product::query()->where('is_active', 1)
                ->where(function ($q) {
                    $q->where('on_sale', 1)->orWhere('is_hot', 1);
                })->has('translations')->orderByDesc('id')->get();
        } else {
            return Product::query()->where('is_active', 1)
                ->where(function ($q) {
                    $q->where('on_sale', 1)->orWhere('is_hot', 1);
                })->whereHas('translations')->orderByDesc('id')->get();
        }
    }
}
