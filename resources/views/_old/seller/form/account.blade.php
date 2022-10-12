@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<fieldset id="seller_account">
    

        <div class="row">
            <div class="col-12">
                <h3>{{__("seller.ContactInf")}}</h3>
                <p>{{__("seller.ContactInfP")}}</p>
            </div>
        </div> 

        <label requ class="fieldlabels">{{__("seller.Name")}}</label>
        
        <input
        type="text" name="name" id="document_user_name" value="{{old("document_user_name")}}"/>
        
        <div id="error-document_user_name" class="invalid-feedback"></div>

        <label class="fieldlabels">{{__("seller.EMAIL")}}</label>
        <input class="" type="text" name="email" value="{{old("document_user_name")}}"/>
        
        <label requ class="fieldlabels">{{__("seller.ContactNum")}}</label>
        <input
        type="text" id="document_contact_number" name="contact_number" value="{{old("document_user_name")}}" />
        <div id="error-document_contact_number" class="invalid-feedback"></div>

        <label requ class="fieldlabels">{{__("seller.Password")}}</label>
        
        <input class="" 
        type="password" id="password" name="password" value="" placeholder='{{__("seller.Password")}}' />
        <div id="error-password" class="invalid-feedback"></div>

        <label requ class="fieldlabels">{{__("seller.ConfirmPass")}}</label>
        
        <input class="" 
        type="password" id="confirm_password" name="password_confirmation" value="" placeholder='{{__("seller.ConfirmPass")}}' />
        <div id="error-confirm_password" class="invalid-feedback"></div>

        <button id="step_account" type="button" name="next" class="action-button">{{__("seller.saveNext")}}</button>        

        <input id="_step_account" type="button" name="next" class="action-button next hidden"/>
</fieldset>






