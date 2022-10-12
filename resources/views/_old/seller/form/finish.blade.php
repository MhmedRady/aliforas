<fieldset>
    
        <div class="row">
            <div class="col">
                <h2 class="fs-title ">{{__("seller.FinReview")}}</h2>
            </div>

        </div>

        <div class="row ">
            <div class="col-12 ">
               <ul class="m-4 finishList" >
                   
                   <li id="append_first_name" data-cont="{{__("seller.FName")}}"></li>
                   <li id="append_last_name" data-cont="{{__("seller.LName")}}"></li>
                   <li id="append_contact_number" data-cont="{{__("seller.ContactNum")}}"></li>
                   <li id="append_store_name" data-cont="{{__("seller.StoreName")}}"></li>
                
                   <li id="append_document_id" data-cont="{{__("seller.DocID")}}"></li>
                   <li id="append_pickup_street" data-cont="{{__("seller.street")}}"></li>
                   <li id="append_pickup_building_number" data-cont="{{__("seller.buildNum")}}"></li>
                   <li id="append_mobile_number" data-cont="{{__("seller.mobileNum")}}"></li>
                
               </ul>
            </div>
        </div>

    <button type="submit" name="next" class="next action-button" style="width: auto; height: 45px" value="submit" >{{__("seller.Submit")}}</button>
    <input type="button" name="previous" class="previous action-button-previous" value="{{__("seller.savePrev")}}" />
</fieldset>
