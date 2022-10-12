<div id="address-step-modern" class="content ml-0" role="tabpanel" aria-labelledby="address-step-modern-trigger">
    <div class="content-header">
        <h5 class="mb-0">{{__('seller.address')}}</h5>
        <small>{{__('seller.address_shipping')}}</small>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label req class="form-label" for="store">{{__('seller.storeName')}}</label>
                <input type="text" id="store" class="form-control" name="store" value="{{old('store')??$user->seller->store}}"/>
                @error('store')
                <div id="validationStore_name" class="invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label req class="form-label" for="address">{{__('auth.address')}}</label>
                <input type="text" id="address" class="form-control" name="address" value="{{old('address')??$user->userAddress->address}}"/>
                @error('address')
                <div id="validationAddress" class="invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

{{--        <div class="mb-1 col-md-6">--}}
{{--            <div class="form-group">--}}
{{--                <label req class="form-label" for="legal_type">{{__('seller.legal_type')}}</label>--}}
{{--                <select id="legal_type" class="form-control" name="legal_type">--}}
{{--                    <option value="1">{{__('seller.individual_facility')}}</option>--}}
{{--                    <option value="2">{{__('seller.company')}}</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label req class="form-label" for="state">{{__('auth.state')}}</label>
            <select class="select2 state_selector w-100" id="state" data-city-target="#city" name="state" autocomplete="off">
                @foreach($states as $state)
                    <option value="{{$state->id}}" {{$state->id == $user->userAddress->state_id ?'selected':''}}>
                        {{$state->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-1 col-md-6">
            <label req class="form-label" for="city">{{__('auth.city')}}</label>
            <select class="select2 w-100" id="city" name="city" autocomplete="off">

                    @foreach($states->find((old('state')??$user->userAddress->state_id))->cities as $city)
                        <option value="{{$city->id}}" {{$city->id == $user->userAddress->city_id ?'selected':''}}>
                            {{$city->name}}
                        </option>
                    @endforeach

            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label class="form-label" for="store">{{__('auth.street')}}</label>
                <input type="text" id="street" class="form-control" name="street" value="{{old('street')??$user->userAddress->street}}"/>
                @error('street')
                <div id="validationStore_name" class="invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label class="form-label" for="build_number">{{__('auth.build_number')}}</label>
                <input type="text" id="build_number" class="form-control" name="build_number" value="{{old('build_number')??$user->userAddress->build_number}}"/>
                @error('build_number')
                <div id="validationPickup_contact_number" class="invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label class="form-label" for="postal_code">{{__('auth.postal_code')}}</label>
                <input type="text" id="postal_code" class="form-control" name="postal_code" value="{{old('postal_code')??$user->userAddress->postal_code}}"/>
                @error('postal_code')
                <div id="validationStore_name" class="invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label class="form-label" for="pickup_phone">{{__('seller.pickup_phone')}}</label>
                <input type="text" id="pickup_phone" class="form-control" name="pickup_phone" value="{{old('pickup_phone')??$user->userAddress->phone}}"/>
                @error('pickup_phone')
                <div id="validationPickup_contact_number" class="invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <button class="btn btn-primary btn-prev" type="button">
            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">{{__('layouts.prev')}}</span>
        </button>
        <button id="sub_btn" type="submit" class="btn btn-success btn-submit">{{__('auth.Submit')}}</button>
    </div>
</div>
