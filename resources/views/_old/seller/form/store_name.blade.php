<fieldset>
    
    <label class="fieldlabels">{{__("seller.StoreName")}}</label>
    <input class="" type="text" id="documnet_store_name" name="store_name" value="{{old('store_name')}}" />
    <div id="error-documnet_store_name" class="invalid-feedback"></div>

    <button id="step_store" type="button" class="action-button">{{__("seller.saveNext")}}</button>
    <input id="_step_store" type="button" name="submit" id="show_data" class="next action-button hidden"/>
    <input type="button" name="previous" class="previous action-button-previous" value="{{__('seller.savePrev')}}"  />

</fieldset>
