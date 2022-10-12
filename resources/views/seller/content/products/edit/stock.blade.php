<div id="personal-info-modern" class="content text-start" role="tabpanel" aria-labelledby="personal-info-modern-trigger">
    <div class="content-header text-start">
        <h5 class="mb-0">@lang('layouts.stockDetails')</h5>
        <small>{{ __('layouts.enter', ['var'=> __('layouts.stockDetails'). ', ' .__('layouts.returns'). ', '.__('layouts.offers')]) }}</small>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="stick">@lang('layouts.stock')</label>
            <input type="number" id="stock" class="form-control" value="{{old('stock')??$row->stock}}" min="1" name="stock">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="minimum_stock">@lang('layouts.lowStock')</label>
            <input type="number" id="minimum_stock" class="form-control" name="minimum_stock" value="{{old('minimum_stock')??$row->minimum_stock}}" min="1">
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="Price"> @lang('Price') <small style="font-size: .857rem;font-weight: lighter; text-transform: capitalize"> (@lang('layouts.currentPrice') </small></label>
            <input type="text" id="Price" class="form-control" value="{{old('price')??$row->price}}" min="1" name="price">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="reward_points">@lang('layouts.rewardPoints')</label>
            <input type="number" id="minimum_stock" class="form-control" name="reward_points"
                   value="{{old('reward_points')??$row->reward_points}}">
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <div class="form-switch">
                <input type="checkbox" class="form-check-input" id="return_allowed" name="return_allowed" {{$row->return_allowed?'checked':''}}/>
                <label class="form-check-label" for="return_allowed" {{isset($issale) && $issale?'checked':''}} >@lang('layouts.allowReturn')</label>
            </div>

            <div class="form-check form-switch" data-show="return_allowed" style="display: {{$row->return_allowed ?'block':'none'}}">
                <label class="form-label" for="return_duration">@lang('layouts.returnDuration')</label>
                <input type="number" id="return_duration" class="form-control" name="return_duration" value="{{old('return_duration')??$row->return_duration}}" max="30">
            </div>
        </div>

        <div class="mb-1 col-md-6">
            <div class="form-switch">
                <input type="checkbox" class="form-check-input" id="on_sale" name="on_sale" {{$row->on_sale?'checked':''}}/>
                <label class="form-check-label" for="on_sale" {{isset($issale) && $issale?'checked':''}} >@lang('layouts.on_sale')</label>
            </div>
            <div class="form-check form-switch" data-show="on_sale" style="display: {{$row->on_sale?'block':'none'}}">
                <label for="before_price">@lang('layouts.beforePrice') <small style="font-size: .857rem;font-weight: lighter; text-transform: capitalize"> {{-- (price Before discount) --}} </small></label>
                <input type="text" class="form-control" min="0" id="before_price" name="before_price" value="{{ old('before_price')??$row->before_price }}">
            </div>
            <div class="form-check form-switch" data-show="on_sale" style="display: {{$row->on_sale?'block':'none'}}">
                <label class="form-label" for="sale_ends_at">@lang('layouts.end_offer')</label>
                <input type="text" id="sale_ends_at" class="form-control" name="sale_ends_at" value="{{old('sale_ends_at')??$row->sale_ends_at}}" min="1" max="30">
            </div>
        </div>

        <div class="mb-1 col-md-6">
            <div class="form-switch">
                <input type="checkbox" class="form-check-input" id="is_hot" name="is_hot" {{$row->is_hot ?'checked':''}}/>
                <label class="form-check-label" for="is_hot" {{isset($issale) && $issale?'checked':''}} > @lang('layouts.is_hot') </label>
            </div>
            <div class="form-check form-switch" data-show="is_hot" style="display: {{$row->is_hot ?'block':'none'}}">
                <label for="hot_starts_at">@lang('layouts.start_offer')</label>
                <input type="text" class="form-control" id="hot_starts_at" name="hot_starts_at" value="{{ old('hot_starts_at')??$row->hot_starts_at }}">
            </div>
            <div class="form-check form-switch" data-show="is_hot" style="display: {{$row->is_hot ?'block':'none'}}">
                <label for="hot_ends_at">@lang('layouts.end_offer')</label>
                <input type="text" class="form-control" id="hot_ends_at" name="hot_ends_at" value="{{ old('hot_ends_at')??$row->hot_ends_at }}">
            </div>
            <div class="form-check form-switch" data-show="is_hot" style="display: {{$row->is_hot ?'block':'none'}}">
                <label for="before_price">@lang('layouts.beforePrice') <small style="font-size: .857rem;font-weight: lighter; text-transform: capitalize"> {{-- (price Before discount) --}} </small></label>
                <input type="number" class="form-control" min="0" id="hot_price" name="hot_price" value="{{ old('hot_price')??$row->hot_price }}">
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-between">
        <button class="btn btn-outline-secondary btn-prev waves-effect" type="button">
            <i class="mb-1" data-feather="arrow-right" width="14" height="14"></i>
            <span class="align-middle d-sm-inline-block d-none">@lang('Previous')</span>
        </button>
        <button class="btn btn-primary btn-next waves-effect waves-float waves-light" type="button">
            <span class="align-middle d-sm-inline-block d-none">@lang('Next')</span>
            <i class="mb-1" data-feather="arrow-left" width="14" height="14"></i>
        </button>
    </div>
</div>
