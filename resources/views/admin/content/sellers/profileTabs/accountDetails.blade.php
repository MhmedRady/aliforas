<div id="account-details-modern" class="content ml-0" role="tabpanel" aria-labelledby="account-details-modern-trigger">
    <div class="content-header mt-2 mb-2">
        <h5 class="mb-0">{{__('seller.accDetails')}}</h5>
        <small class="text-muted">{{__('seller.setAccDetails')}}</small>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label req class="form-label" for="email">{{__('auth.Email')}}</label>
                <input type="email" id="email" class="form-control" name="email" value="{{old('email')??$user->email}}"/>
                @error('email')
                    <div id="validationEmail" class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label req class="form-label" for="phone">{{__('auth.phoneNumber')}}</label>
                <input type="text" id="phone" class="form-control" name="phone" value="{{old('phone')??$user->phone}}"/>
                @error('phone')
                    <div id="validationEmail" class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="mb-1 form-password-toggle col-md-6">--}}
{{--            <div class="form-group">--}}
{{--                <label req class="form-label" for="modern-password">{{__('auth.Password')}}</label>--}}
{{--                <input type="password" id="modern-password" class="form-control" name="password" value="{{old('password')}}"/>--}}
{{--                @error('password')--}}
{{--                    <div id="validationPassword" class="invalid-feedback d-block">--}}
{{--                        {{$message}}--}}
{{--                    </div>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="mb-1 form-password-toggle col-md-6">--}}
{{--            <div class="form-group">--}}
{{--                <label req class="form-label" for="confirm_password">{{__('auth.pwConfirm')}}</label>--}}
{{--                <input type="password" id="confirm_password" class="form-control" name="confirm_password" value="{{old('confirm_password')}}"/>--}}
{{--                @error('confirm_password')--}}
{{--                    <div id="validationConfirm_password" class="invalid-feedback d-block">--}}
{{--                        {{$message}}--}}
{{--                    </div>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="d-flex justify-content-between">
        <button class="btn btn-outline-secondary btn-prev" type="button" disabled>
            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">{{__('layouts.prev')}}</span>
        </button>
        <button class="btn btn-primary btn-next" type="button">
            <span class="align-middle d-sm-inline-block d-none" type="button">{{__('layouts.next')}}</span>
            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
        </button>
    </div>
</div>
