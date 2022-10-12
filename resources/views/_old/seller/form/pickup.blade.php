<fieldset>
    
        <label class="fieldlabels">{{__('seller.city')}}</label>
        @include('seller.address.city')

        <label class="fieldlabels">{{__('seller.street')}}</label>
        <input class="" type="text" id="document_pick_street" name="pickup_street" value="{{old('pickup_street')}}"/>

        <label class="fieldlabels">{{__('seller.buildNum')}}</label>
        <input class="" type="text" id="pickup_building_number" name="pickup_building_number" value="{{old('pickup_building_number')}}"/>

        <label class="fieldlabels" requ>{{__('seller.mobileNum')}}</label>
        <input id="pickup_contact_number" class="form-control " name="pickup_contact_number" value="{{isset($user->contact_number)? $user->contact_number :'' }}" type="tel" id="mobile_number">
        <div id="error-pickup_contact_number" class="invalid-feedback"></div>

        <div class="form-group">
            <label class="fieldlabels" requ>{{__('seller.address')}}</label>
            <div id="error-pac-input" class="invalid-feedback"></div>

            <input type="text" id="pac-input" name="address" 
            class="form-control">
            
            <input type="hidden" id="latitude" name="lat"/>
            <input type="hidden" id="longitude" name="lng"/>
            <div class="map" style="width:100%;min-height:500px;"></div>
            
            <button type="button" class="getLocation btn btn-info mb-3 shadow font-weight-bold">{{__("seller.currentLoc")}}</button>
        </div>

    <button id="step_pickup" type="button" class="action-button">{{__("seller.saveNext")}}</button>
    <input id="_step_pickup" type="button" name="next" class="next action-button hidden"/>
    <input type="button" name="previous" class="previous action-button-previous" value="{{__('seller.savePrev')}}" />
</fieldset>
