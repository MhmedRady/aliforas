<div id="product-type-modern" class="content" role="tabpanel" aria-labelledby="product-type-modern-trigger">
    <div class="content-header">
        <h5 class="mb-0">Main Information</h5>
        <small>Select Brand, Category, Company.</small>
    </div>
    <hr>
    <div class="row">


        <div class="mb-1 col-md-6">
            <label class="form-label" for="category_id">Category</label>

            <select class="form-select" name="category_id" id="category_id"onchange="attributesDependOnCategory(this)">
                @foreach($categories as $id => $name)
                    @if(substr_count($name, '-') < substr_count(next($categories), '-') )
                        <option disabled value="{{ $id }}" style="color: #f70000">{{ $name }}</option>
                    @else
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endif
                @endforeach
            </select>

        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="brand_id">Brand</label>
            <select class="form-select" name="brand_id" id="brand_id">
                <option value="0" disabled>Select Product Brand</option>
                @foreach($brands as $id => $brand)
                    <option value="{{ $brand->id }}" {{old('brand_id')==$brand->id?'selected':''}}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">

        <div class="mb-1 col-md-6">
            <label class="form-label" for="manufacturer_id">Company</label>
            <select class="form-select" name="manufacturer_id" id="manufacturer_id">
                <option value="0" disabled>Select Product Company</option>
                @foreach($manufacturers as $manufacturer)
                    <option value="{{ $manufacturer->id }}" {{old('manufacturer_id')==$manufacturer->id?'selected':''}}>{{ $manufacturer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-1 col-md-6">
            <label class="form-label" for="item_id">Item ID</label>
            <input type="text" id="item_id" class="form-control" value="{{old('item_id')}}" name="item_id">
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-4">
            <label class="form-label" for="Barcode">Barcode</label>
            <input type="text" id="Barcode" class="form-control" value="{{old('barcode')}}" name="barcode">
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="weight">weight</label>
            <input type="text" id="weight" class="form-control" value="{{old('weight')}}" name="weight">
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="length">length</label>
            <input type="text" id="length" class="form-control" value="{{old('length')}}" name="length">
        </div>

    </div>
    <div class="row">
        <div class="mb-1 col-md-4">
            <div class="d-flex flex-column">
                <label class="form-check-label mb-50" for="is_active">Product Activate</label>
                <div class="form-check form-switch form-check-success">
                    <input type="checkbox" class="form-check-input" id="is_active" checked name="is_active"/>
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
            <label class="form-label" for="height">height</label>
            <input type="text" id="height" class="form-control" value="{{old('height')}}" name="height">
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="width">width</label>
            <input type="text" id="width" class="form-control" value="{{old('width')}}" name="width">
        </div>
    </div>
    <div class="row">

        <div class="content-header">
            <h5 class="mb-0 fw-bold">SEO Information</h5>
            <small>Keywords, Meta Title, Meta Description</small>
        </div>
        <hr>

        @foreach($languages as $locale)
            <h5>{{$locale->name}} Seo</h5>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="modern-username">Meta Title {{$locale->name}}</label>
                <input type="text" id="modern-username" class="form-control" name="meta_title[{{$locale->locale}}]">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="modern-username">Meta Keywords {{$locale->name}}</label>
                <input type="text" id="modern-username" class="form-control" name="meta_keywords[{{$locale->locale}}]">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="modern-username">Meta Description {{$locale->name}}</label>
                <input type="text" id="modern-username" class="form-control" name="meta_description[{{$locale->locale}}]">
            </div>
            <hr>
        @endforeach
    </div>

    <div class="d-flex justify-content-between">
        <button class="btn btn-primary btn-prev waves-effect waves-float waves-light" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle me-sm-25 me-0"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
        </button>

        <input id="sub_btn" type="submit" class="btn btn-success waves-effect waves-float waves-light" value="Submit"/>
    </div>
</div>
