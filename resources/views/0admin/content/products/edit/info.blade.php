<div id="account-details-modern" class="content" role="tabpanel" aria-labelledby="account-details-modern-trigger">
    <div class="content-header">
        <h5 class="mb-0">Account Details</h5>
        <small class="text-muted">Enter Your Account Details.</small>
        @if(Session::has('success'))
            <small class="text-muted">session success</small>
        @endif
    </div>
    <div class="row">
        @foreach($languages as $locale)
            <div class="mb-1 col-md-6">
                <label class="form-label" for="modern-username">Name {{$locale->name}}</label>
                <input type="text" name="name[{{$locale->locale}}]" class="form-control required" value="{{ old("name." . $locale->locale)??($row->translate($locale->locale)->name??'')}}" required maxlength="40">
            </div>
        @endforeach
    </div>
    <div class="row">
        @foreach($languages as $locale)
            <div class="mb-1 form-password-toggle col-md-6">
                <label class="form-label" for="description[{{$locale->locale}}]">Description  {{$locale->name}}</label>
                <textarea id="description[{{$locale->locale}}]" name="description[{{$locale->locale}}]" class="form-control summernote" cols="30" rows="10">{!! strip_tags(old("description." . $locale->locale) ?? ($row->translate($locale->locale)->description??'')) !!}</textarea>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-between">
        <button class="btn btn-outline-secondary btn-prev waves-effect" disabled="" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle me-sm-25 me-0"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
        </button>
        <button class="btn btn-primary btn-next waves-effect waves-float waves-light" type="button">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right align-middle ms-sm-25 ms-0"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
        </button>
    </div>
</div>
