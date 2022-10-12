<div id="account-details-modern" class="content text-start" role="tabpanel" aria-labelledby="account-details-modern-trigger">
    <div class="content-header text-start">
        <h5 class="mb-0">@lang('layouts.productDetails')</h5>
        <small class="text-muted">{{__('layouts.enter', ['var' => __('layouts.productDetails')])}}</small>
    </div>
    <div class="row mb-3">
        @foreach($languages as $locale)
            <div class="mb-1 col-md-6">
                <label class="form-label" for="modern-username">{{__('layouts.lang:var', ['var1' => trans('layouts.productName'), 'var2' => trans("layouts.$locale->name")])}}</label>
                <input type="text" name="name[{{$locale->locale}}]" class="form-control required" value="{{ old("name." . $locale->locale) }}" required maxlength="40">
            </div>
        @endforeach
    </div>
    <div class="row mb-3">
        @foreach($languages as $locale)
            <div class="mb-1 form-password-toggle col-md-6">
                <label class="form-label" for="description[{{$locale->locale}}]">{{__('layouts.lang:var', ['var1' => trans('layouts.productDescription'), 'var2' => trans("layouts.$locale->name")])}}</label>
                <textarea id="description[{{$locale->locale}}]" name="description[{{$locale->locale}}]" class="form-control summernote" cols="30" rows="10">{{ old("description." . $locale->locale) }}</textarea>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-between">
        <button class="btn btn-outline-secondary btn-prev waves-effect" disabled="" type="button">
            <i class="mb-1" data-feather="arrow-right" width="14" height="14"></i>
            <span class="align-middle d-sm-inline-block d-none">@lang('Previous')</span>
        </button>
        <button class="btn btn-primary btn-next waves-effect waves-float waves-light" type="button">
            <span class="align-middle d-sm-inline-block d-none">@lang('Next')</span>
            <i class="mb-1" data-feather="arrow-left" width="14" height="14"></i>
        </button>
    </div>
</div>
