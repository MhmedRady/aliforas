<fieldset>

        <div class="row">
            <div class="col">
                <h3>{{__("seller.AccountVer")}}</h3>
                <p>{{__("seller.AccountVerP")}}</p>
            </div>
        </div>
        
        <div class="col-md">
            <p>{{__("seller.AccType")}}</p>
            <div id="radio">
                <input class="" type="radio"  id="individual" name="cat" value="individual">
                <label  for="individual ">{{__("seller.Professional")}}.
                </label><br>
                <input type="radio" id="business" name="cat" value="business">
                <label for="business"> {{__("seller.business")}}.</label>
            </div>

        </div>

        <div class="form-group" id="sellerType">

        </div>

        <label class="fieldlabels ">{{__("seller.DocID")}}</label> 
        <input type="text" id="doc_id" name="document_id" value="{{old('document_id')}}"/>


        <label class="fieldlabels" requ>{{__("seller.FName")}}</label>
        <input class="" type="text" name="document_first_name" id="document_first_name" value="{{old('document_first_name')}}" />
        <div id="error-document_first_name" class="invalid-feedback"></div>

        <label class="fieldlabels" requ>{{__("seller.LName")}}</label>
        <input type="text" name="document_last_name" id="document_last_name" value="{{old('document_last_name')}}" />
        <div id="error-document_last_name" class="invalid-feedback"></div>

        <label class="fieldlabels">{{__("seller.ExpiryDate")}}</label>
        <input class="form-control " name="document_expiry_date"  type="date" value="{{old('document_expiry_date')}}" id="date document_expiry_date">
        
        <p>
            <input id="role" requ class="m-2" type="checkbox"><span class="font-width-bold">{{__("seller.CondsP")}}</span>
        </p>

    <button id="step_verification" type="button" class="action-button">{{__("seller.saveNext")}}</button>
    <input id="_step_verification" type="button" name="next" class="next action-button hidden" value="{{__("seller.saveNext")}}" />
    <input class="previous action-button-previous" type="button" name="previous" class="previous action-button-previous" value="{{__("seller.savePrev")}}" />
</fieldset>
