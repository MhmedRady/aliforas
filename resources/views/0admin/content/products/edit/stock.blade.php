<div id="personal-info-modern" class="content" role="tabpanel" aria-labelledby="personal-info-modern-trigger">
    <div class="content-header">
        <h5 class="mb-0">Stock Details</h5>
        <small>Enter Your Product Stock Details.</small>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="stick">Stock</label>
            <input type="number" id="stock" class="form-control" value="{{old('stock')??$row->stock}}" min="1" name="stock">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="minimum_stock">Low Stock Notification</label>
            <input type="number" id="minimum_stock" class="form-control" name="minimum_stock" value="{{old('minimum_stock')??$row->minimum_stock}}" min="1">
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="Price">Price</label>
            <input type="number" id="Price" class="form-control" value="{{old('price')??$row->price}}" min="1" name="price">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="minimum_stock">Low Stock Notification</label>
            <input type="number" id="minimum_stock" class="form-control" name="reward_points"
                   value="{{old('reward_points')??$row->reward_points}}">
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">

            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="return_allowed" name="return_allowed" {{$row->return_allowed?'checked':''}}/>
                <label class="form-check-label" for="return_allowed">Allow Item Return</label>
            </div>

            <div class="form-check form-switch" data-show="return_allowed" style="display: {{$row->return_allowed ?'block':'none'}}">
                <label class="form-label" for="return_duration">Return duration</label>
                <input type="number" id="return_duration" class="form-control" name="return_duration" value="{{old('return_duration')??$row->return_duration}}" max="30">
            </div>
        </div>

        <div class="mb-1 col-md-6">
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="on_sale" name="on_sale" {{$row->on_sale?'checked':''}}/>
                <label class="form-check-label" for="on_sale" > On Sale </label>
            </div>
            <div class="form-check form-switch" data-show="on_sale" style="display: {{$row->on_sale?'block':'none'}}">
                <label for="before_price">Before Price (Before Discount)</label>
                <input type="number" class="form-control" min="0" id="before_price" name="before_price" value="{{ old('before_price')??$row->before_price }}">
            </div>
            <div class="form-check form-switch" data-show="on_sale" style="display: {{$row->on_sale?'block':'none'}}">
                <label class="form-label" for="sale_ends_at">On Sale ends at</label>
                <input type="text" id="sale_ends_at" class="form-control" name="sale_ends_at" value="{{old('sale_ends_at')??$row->sale_ends_at}}" min="1" max="30">
            </div>
        </div>

        <div class="mb-1 col-md-6">
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="is_hot" name="is_hot" {{$row->is_hot ?'checked':''}}/>
                <label class="form-check-label" for="is_hot">Is Hot </label>
            </div>
            <div class="form-check form-switch" data-show="is_hot" style="display: {{$row->is_hot ?'block':'none'}}">
                <label for="hot_starts_at">Hot starts at</label>
                <input type="text" class="form-control" id="hot_starts_at" name="hot_starts_at" value="{{ old('hot_starts_at')??$row->hot_starts_at }}">
            </div>
            <div class="form-check form-switch" data-show="is_hot" style="display: {{$row->is_hot ?'block':'none'}}">
                <label for="hot_ends_at">Hot ends at</label>
                <input type="text" class="form-control" id="hot_ends_at" name="hot_ends_at" value="{{ old('hot_ends_at')??$row->hot_ends_at }}">
            </div>
            <div class="form-check form-switch" data-show="is_hot" style="display: {{$row->is_hot ?'block':'none'}}">
                <label for="hot_price">Before price</label>
                <input type="number" class="form-control" min="0" id="hot_price" name="hot_price" value="{{ old('hot_price')??$row->hot_price }}">
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
