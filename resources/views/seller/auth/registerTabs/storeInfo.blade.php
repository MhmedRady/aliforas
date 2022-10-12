<div id="social-links-modern" class="content" role="tabpanel" aria-labelledby="social-links-modern-trigger">
    <div class="content-header">
        <h5 class="mb-0">Social Links</h5>
        <small>Enter Your Social Links.</small>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="r_name">{{__('auth.fName')}}</label>
            <input type="text" id="r_fName" class="Reference" data-input='document_first_name' readonly/>
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="r_name">{{__('auth.lName')}}</label>
            <input type="text" class="Reference" data-input='document_last_name' readonly/>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="r_email">{{__('auth.Email')}}</label>
            <input type="text" class="Reference" data-input='email' readonly/>
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label">{{__('auth.phone')}}</label>
            <input type="text" class="Reference" data-input='phone' readonly/>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="r_email">{{__('auth.NID')}}</label>
            <input type="text" class="Reference" data-input='document_id' readonly/>
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label">{{__('auth.birthDate')}}</label>
            <input type="text" class="Reference" data-input='dob' readonly/>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="r_email">{{__('auth.address')}}</label>
            <input type="text" class="Reference" data-input='address' readonly/>
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label">{{__('auth.pickup_phone')}}</label>
            <input type="text" class="Reference" data-input='pickup_contact_number' readonly/>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="r_email">{{__('auth.state')}}</label>
            <input type="text" class="Reference" data-input='address' readonly/>
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label">{{__('auth.pickup_phone')}}</label>
            <input type="text" class="Reference" data-input='pickup_contact_number' readonly/>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary btn-prev" type="button">
            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
        </button>
        <button id="sub_btn" class="btn btn-success btn-submit">Submit</button>
    </div>
</div>
