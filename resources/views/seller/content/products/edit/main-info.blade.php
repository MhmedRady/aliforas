<div id="product-type-modern" class="content text-start" role="tabpanel" aria-labelledby="product-type-modern-trigger">
    <div class="content-header">
        <h5 class="mb-0">@lang('layouts.mainInfo')</h5>
        <small>@lang('Select') @lang('layouts.category'), @lang('layouts.company'), @lang('layouts.brand')</small>
    </div>
    <hr>

    <div class="row">
        <div class="mb-1 col-md-4">
            <label class="form-label" for="category_id">@lang('layouts.category')</label>

            <select class="form-select" name="category_id" id="category_id"onchange="attributesDependOnCategory(this)">
                @foreach($categories as $id => $name)

                    @if(substr_count($name, '-') < substr_count(next($categories), '-') )
                        <option disabled value="{{ $id }}" style="color: #f70000">{{ $name }}</option>
                    @else
                        <option value="{{ $id }}" {{ (old('category_id')??($row->categories->first()->id??array_key_last($categories))) == $id?'selected':''}}>{{ $name }}</option>
                    @endif
                @endforeach
            </select>

        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="brand_id">@lang('layouts.brand')</label>
            <select class="form-select" name="brand_id" id="brand_id">
                <option value="0" disabled>Select Product Brand</option>
                @foreach($brands as $id => $brand)
                    <option value="{{ $brand->id }}" {{(old('brand_id')??$row->brand->id)==$brand->id?'selected':''}}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="brand_id">@lang('layouts.branch')</label>
            <select class="form-select" name="branch_id" id="branch_id">
                @foreach($branches as $id => $branch)
                    <option value="{{ $branch->id }}" {{(old('branch_id')??$row->branch->first()->id)==$row->branch->first()->id?'selected':''}}>{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">

        <div class="mb-1 col-md-6">
            <label class="form-label" for="manufacturer_id">@lang('layouts.company')</label>
            <select class="form-select" name="manufacturer_id" id="manufacturer_id">
                <option value="0" disabled>Select Product Company</option>
                @foreach($manufacturers as $manufacturer)
                    <option value="{{ $manufacturer->id }}" {{(old('manufacturer_id')??$row->manufacturer->id)==$manufacturer->id?'selected':''}}>{{ $manufacturer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-1 col-md-6">
            <label class="form-label" for="item_id">@lang('layouts.itemID')</label>
            <input type="text" id="item_id" class="form-control" value="{{old('item_id')??$row->item_id}}" name="item_id">
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label class="form-label" for="Barcode">@lang('layouts.barcode')</label>
            <input type="text" id="Barcode" class="form-control" value="{{old('barcode')??$row->barcode}}" name="barcode">
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="weight">@lang('layouts.weight')</label>
            <input type="text" id="weight" class="form-control" value="{{old('weight')??$row->weight}}" name="weight">
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="length">@lang('layouts.length')</label>
            <input type="text" id="length" class="form-control" value="{{old('length')??$row->length}}" name="length">
        </div>

    </div>
    <div class="row">
        <div class="mb-1 col-md-4">
            <div class="d-flex flex-column">
                <label class="form-check-label mb-50" for="is_active">{{__('layouts.varActive', ['var'=> __('layouts.product')])}}</label>
                <div class="form-switch form-check-success">
                    <input type="checkbox" class="form-check-input" id="is_active" {{$row->is_active?'checked':''}} name="is_active"/>
                    <label class="form-check-label" for="is_active">
                        <span class="switch-icon-left">
                            <i data-feather="check"></i>
                        </span>
                        <span class="switch-icon-right">
                            <i data-feather="x"></i>
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="height">@lang('layouts.height')</label>
            <input type="text" id="height" class="form-control" value="{{old('height')??$row->height}}" name="height">
        </div>

        <div class="mb-1 col-md-4">
            <label class="form-label" for="width">@lang('layouts.width')</label>
            <input type="text" id="width" class="form-control" value="{{old('width')??$row->width}}" name="width">
        </div>
    </div>

    <div class="content-header">
        <h5 class="mb-0">@lang('layouts.SEO_Info')</h5>
        <small>Keywords, Meta Title, Meta Description</small>
    </div>
    <hr>

    <div class="row">

        @foreach($languages as $locale)
            <h5>{{$locale->name}} Seo</h5>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="modern-username">Meta Title {{$locale->name}}</label>
                <input type="text" id="modern-username" class="form-control" name="meta_title[{{$locale->locale}}]" value="{{old('meta_title')??($row->translate($locale->locale)->meta_title??null)}}">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="modern-username">Meta Keywords {{$locale->name}}</label>
                <input type="text" id="modern-username" class="form-control" name="meta_keywords[{{$locale->locale}}]" value="{{old('meta_keywords')??($row->translate($locale->locale)->meta_keywords??null)}}">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="modern-username">Meta Description {{$locale->name}}</label>
                <input type="text" id="modern-username" class="form-control" name="meta_description[{{$locale->locale}}]" value="{{old('meta_description')??($row->translate($locale->locale)->meta_description??null)}}">
            </div>
            <hr>
        @endforeach
    </div>

    <div class="d-flex justify-content-between">
        <button class="btn btn-outline-secondary btn-prev waves-effect" type="button">
            <i class="mb-1" data-feather="arrow-right" width="14" height="14"></i>
            <span class="align-middle d-sm-inline-block d-none">@lang('Previous')</span>
        </button>

        <input id="sub_btn" type="submit" class="btn btn-success waves-effect waves-float waves-light" value="Submit"/>
    </div>
</div>
