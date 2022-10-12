<!-- Contact Details -->

    <fieldset>
        <div class="container p-0">
            <div class="row">
                <div class="col-12">
                    <div class="order-address order-tracking-box">
                        <div class="row">
                            <h4 class="tracking-title">contact details</h4>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text"  placeholder="enter your first name" name="first_name"
                                           class="form-control" value="{{old('first_name')??$user->userDetails->first_name}}" required>
                                </div>
                                @error('first_name')
                                <div class="invalid-feedback font-85 d-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text"  placeholder="enter your last name" name="last_name" class="form-control"
                                           value="{{old('last_name')??$user->userDetails->last_name}}" required>
                                </div>
                                @error('last_name')
                                <div class="invalid-feedback font-85 d-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text"  placeholder="enter your Email" name="email" class="form-control" value="{{old('email')??$user->email}}" required>
                                </div>
                                @error('email')
                                <div class="invalid-feedback font-85 d-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text"  placeholder="enter your mobile number" name="phone" class="form-control" value="{{old('phone')??$user->contact_number}}" required>
                                </div>
                                @error('phone')
                                <div class="invalid-feedback font-85 d-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>

                            <hr>

                            <h4 class="tracking-title">address details</h4>

                            <div class="form-group">
                                <select id="state_selector" class="form-control"
                                        data-route="{{route('web.change-state')}}"
                                        data-current_id="{{$user->userDetails->state_id}}"
                                        name="state_id" required>
                                    <option value="0" disabled>Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}" {{$state->id==$user->userDetails->state_id? 'selected':''}}>{{$state->state}}</option>
                                    @endforeach
                                </select>
                                <select id="city_selector" class="form-control" name="city_id" required>
                                    <option value="">select city</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{$city->id==$user->userDetails->city_id? 'selected':''}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text"  placeholder="enter your address" name="address" class="form-control" value="{{old('address')??$user->userDetails->address}}" required>
                                </div>
                                @error('address')
                                    <div class="invalid-feedback font-85 d-block">
                                        <strong>{{$message}}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text"  placeholder="Postal Code" name="postal_code" value="{{old('postal_code')??$user->postal_code}}" class="form-control">
                                </div>
                                @error('postal_code')
                                    <div class="invalid-feedback font-85 d-block">
                                        <strong>{{$message}}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <a href="javascript:void(0)" class="btn btn-dark btn-sm prev font-bold m-2" >previous</a>
                                {{--        <a href="javascript:void(0)" class="btn btn-solid btn-sm next action-button font-bold m-2" >next</a>--}}
                                <button type="submit" class="btn btn-primary btn-sm font-bold m-2">Submit Order</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:void(0)" class="btn btn-dark btn-sm previous prev-order action-button-previous d-none" ></a>
        {{--        <a href="javascript:void(0)" class="btn btn-solid btn-sm next action-button" >next</a>--}}

    </fieldset>

<!-- End Contact Details -->
