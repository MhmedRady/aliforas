<div id="personal-info-modern" class="content" role="tabpanel" aria-labelledby="personal-info-modern-trigger">
    <div class="content-header">
        <h5 class="mb-0">Stock Details</h5>
        <small>Enter Your Product Stock Details.</small>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="stick">Stock</label>
            <input type="number" id="stock" class="form-control" value="{{old('stock')??1}}" min="1" name="stock">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="minimum_stock">Low Stock Notification</label>
            <input type="number" id="minimum_stock" class="form-control" name="minimum_stock" value="{{old('minimum_stock')??1}}" min="1">
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="Price"> Price <small style="font-size: .857rem;font-weight: lighter; text-transform: capitalize"> (current price after discount) </small></label>
            <input type="number" id="Price" class="form-control" value="1" min="1" name="price">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="reward_points">Reward Points</label>
            <input type="number" id="reward_points" class="form-control" name="reward_points"
                   value="{{old('reward_points')??0}}">
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">

            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="return_allowed" name="return_allowed"/>
                <label class="form-check-label" for="return_allowed" {{isset($issale) && $issale?'checked':''}} >Allow Item Return</label>
            </div>

            <div class="form-check form-switch" data-show="return_allowed" style="display: none">
                <label class="form-label" for="return_duration">Return duration</label>
                <input type="number" id="return_duration" class="form-control" name="return_duration" value="{{old('return_duration')??0}}" max="30">
            </div>
        </div>

        <div class="mb-1 col-md-6">
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="on_sale" name="on_sale"/>
                <label class="form-check-label" for="on_sale" {{isset($issale) && $issale?'checked':''}} >On Sale</label>
            </div>
            <div class="form-check form-switch" data-show="on_sale" style="display: none">
                <label for="before_price">Before Price <small style="font-size: .857rem;font-weight: lighter; text-transform: capitalize"> (price Before discount) </small></label>
                <input type="number" class="form-control" min="0" id="before_price" name="before_price" value="{{ old('before_price') }}">
            </div>
            <div class="form-check form-switch" data-show="on_sale" style="display: none">
                <label class="form-label" for="sale_ends_at">On Sale ends at</label>
                <input type="text" id="sale_ends_at" class="form-control" name="sale_ends_at" value="{{old('sale_ends_at')??0}}" min="1" max="30">
            </div>
        </div>

        <div class="mb-1 col-md-6">
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="is_hot" name="is_hot"/>
                <label class="form-check-label" for="is_hot" {{isset($issale) && $issale?'checked':''}} >Is Hot </label>
            </div>
            <div class="form-check form-switch" data-show="is_hot" style="display: none">
                <label for="hot_starts_at">Hot starts at</label>
                <input type="text" class="form-control" id="hot_starts_at" name="hot_starts_at" value="{{ old('hot_starts_at') }}">
            </div>
            <div class="form-check form-switch" data-show="is_hot" style="display: none">
                <label for="hot_ends_at">Hot ends at</label>
                <input type="text" class="form-control" id="hot_ends_at" name="hot_ends_at" value="{{ old('hot_ends_at') }}">
            </div>
            <div class="form-check form-switch" data-show="is_hot" style="display: none">
                <label for="hot_price">Before price <small style="font-size: .857rem;font-weight: lighter; text-transform: capitalize"> (price Before discount) </small></label>
                <input type="number" class="form-control" min="0" id="hot_price" name="hot_price" value="{{ old('hot_price') }}">
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary btn-prev waves-effect waves-float waves-light" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle me-sm-25 me-0"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
        </button>
        <button class="btn btn-primary btn-next waves-effect waves-float waves-light" type="button">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right align-middle ms-sm-25 ms-0"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
        </button>
    </div>
</div>
