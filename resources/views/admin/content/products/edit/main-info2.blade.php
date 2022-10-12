<div id="product-meta" class="content" role="tabpanel" aria-labelledby="product-meta-trigger">
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
                <input type="text" id="modern-username" class="form-control" name="meta_title[{{$locale->locale}}]" value="{{
                // old('meta_title')??
                ($row->translate($locale->locale)->meta_title??null)
                }}">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="modern-username">Meta Keywords {{$locale->name}}</label>
                <input type="text" id="modern-username" class="form-control" name="meta_keywords[{{$locale->locale}}]" value="{{($row->translate($locale->locale)->meta_keywords??null)}}">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="modern-username">Meta Description {{$locale->name}}</label>
                <input type="text" id="modern-username" class="form-control" name="meta_description[{{$locale->locale}}]" value="{{($row->translate($locale->locale)->meta_description??null)}}">
                <br>
            </div>
            <hr>
        @endforeach
    </div>
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary btn-prev waves-effect waves-float waves-light" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-arrow-left align-middle me-sm-25 me-0"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
        </button>
    </div>
</div>
