@extends('root.layouts.app')
@section('stylesheet')
    {{--<link rel="stylesheet" href="{{asset('assets/css/jquery.mobile-1.4.5.min.css')}}">--}}
    <style>
        span.form-select {
            display: none !important;
        }
        li {
            font-size: 1.1rem !important;
        }
        .ui-loader {
            display: none !important;
        }
    </style>
@endsection
@section('content')

    <!-- section start -->
    <section class="section-big-py-space checkout-page b-g-light">
        <div class="custom-container">
            @if(userCart()->isEmpty())
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="success-text">
                                <i class="fa fa-cart-plus" aria-hidden="true"
                                   style="color: #00c139;text-shadow: 0 1px 0 #555;"></i>
                                <h2 class="m-2">{{__('layouts.cartEmptyH2')}}</h2>
                                <p>{{__('layouts.cartEmpty')}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 m-auto">
                            <a href="{{route("products.index")}}" class="btn btn-primary btn-md btn-block font-bold">
                                {{__('layouts.goShopping')}}
                            </a>
                        </div>
                        <div class="col-md-4 m-auto">
                            <a href="{{route("index")}}" class="btn btn-primary btn-md btn-block font-bold">
                                {{__('layouts.backToHome')}}
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="checkout-page contact-page login-page">
                    <div class="checkout-form">
                        <div class="row justify-content-center">

                                @guest
                                <div class="col-lg-5 col-sm-12 col-xs-12">
                                    <div class="accordion theme-accordion" id="accordionExample">
                                        @include('root.auth.loginForm', ['fbUrl' => route('login.facebook', ['fb_callback_redirect' => request()->url()])])
                                        {{--<div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                        details
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                 data-parent="#accordionExample">
                                                <div class="card-body">

                                                </div>
                                            </div>
                                        </div>--}}
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-12 col-xs-12 p-0" style="width: 50px">
                                </div>
                                @else
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="theme-form">
                                        <div class="check-out">
                                            @include('root.message.message')
                                            <form action="{{config('setting.pricing') ===true? route('shipping.order.checkout'): route('cart.order.checkout')}}" method="post">
                                                @csrf
                                                @if(auth()->user()->userAddresses->count() > 0)
                                                    <div id="UserAddressesList">
                                                        <ul>
                                                            @foreach(auth()->user()->userAddresses as $address)
                                                                <li style="display: flex;margin-bottom: 5px;">
                                                                    <div class="radio-option">
                                                                        <input type="radio" name="user_address_id"
                                                                               id="userAddress_{{$loop->index}}"
                                                                               class="m-1" value="{{$address->id}}">
                                                                        <label for="userAddress_{{$loop->index}}">
                                                                            {{$address->full_name}}
                                                                            -
                                                                            {{$address->address}}
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <button class="btn btn-info" type="submit" style="color: #fff;"
                                                                id="NewAddressButton"> {{__('auth.addNewAddress')}}
                                                        </button>
                                                    </div>
                                                @endif
                                                <div class="row" id="NewAddressForm"
                                                     @if(auth()->user()->userAddresses->count() > 0) style="display: none;" @endif>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label for="fName">{{__('auth.fName')}}</label>
                                                        <input id="fName" type="text" class="form-control"
                                                               name="first_name"
                                                               value="{{auth()->user()->first_name??old('first_name')}}">
                                                        @error('first_name')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                        <strong
                                                            style="color: red;font-size: 15px;">{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-6 col-12">
                                                        <label for="lName">{{__('auth.lName')}}</label>
                                                        <input id="lName" type="text" class="form-control" name="last_name"
                                                               value="{{auth()->user()->last_name??old('last_name')}}">
                                                        @error('last_name')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    {{--<div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                        <label for="email">{{__('auth.Email')}}</label>
                                                        <input id="email" type="email" class="form-control"
                                                               name="email"
                                                               value="{{auth()->user()->email??old('email')}}">
                                                        @error('email')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                                                        <strong
                                                                                            style="color: red;font-size: 15px;">{{ $message }}</strong>
                                                                                    </span>
                                                        @enderror
                                                    </div>--}}

                                                    <div class="form-group col-md-6 col-12">
                                                        <label for="phone">{{__('auth.phoneNumber')}}</label>
                                                        <input id="phone" type="text" class="form-control rounded"
                                                               name="phone"
                                                               value="{{auth()->user()->phone??old('phone')}}">
                                                        @error('phone')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-6 col-12">
                                                        <label>{{__('auth.postal_code')}}</label>
                                                        <input type="text" name="postal_code"
                                                               class="form-control rounded"
                                                               value="{{old('postal_code')}}">
                                                        @error('postal_code')
                                                        <span class="invalid-feedback font-85 d-block" role="alert">
                                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <div class="form-group">
                                                            <label for="address">{{__('auth.address')}}</label>
                                                            <input id="address" type="text" class="form-control"
                                                                   name="address"
                                                                   value="{{old('address')}}">
                                                            @error('address')
                                                            <span class="invalid-feedback d-block" role="alert">
                                                            <strong
                                                                style="color: red;font-size: 15px;">{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6 col-12">
                                                        <label>{{__('auth.state')}}</label>
                                                        <select class="form-select state_selector"
                                                                data-city-target="#city_selector"
                                                                data-state-route="{{route('get-sate-cities-onChange')}}"
                                                                data-current_id="{{old('state_id')}}"
                                                                name="state_id" required>
                                                            @if(Auth::guard('web')->check())
                                                                @foreach($states as $state)
                                                                    <option
                                                                        value="{{$state->id}}" {{$state->id == old('state_id') ?'selected':''}}>
                                                                        {{$state->name}}
                                                                    </option>
                                                                @endforeach
                                                            @else
                                                                @foreach($states as $state)
                                                                    <option
                                                                        value="{{$state->id}}" {{$state->id == old('state_id') ? 'selected':''}}>
                                                                        {{$state->name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('state_id')
                                                        <span class="invalid-feedback font-85 d-block" role="alert">
                                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-6 col-12">
                                                        <label>{{__('auth.city')}}</label>
                                                        <select id="city_selector" class="form-select"
                                                                name="city_id" autocomplete="off">
                                                            <option value="0" disabled></option>
                                                            @if(Auth::guard('web')->check())
                                                                @foreach($states->where('id', (old('state_id')??1))->first()->cities as $city)
                                                                    <option
                                                                        value="{{$city->id}}" {{$city->id == (old('city_id')??1) ? 'selected':''}}>
                                                                        {{$city->name}}
                                                                    </option>
                                                                @endforeach
                                                            @else
                                                                @foreach($states->first()->cities as $city)
                                                                    <option
                                                                        value="{{$city->id}}" {{$city->id == old('city_id') ?'selected':''}}>
                                                                        {{$city->city}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('city_id')
                                                        <span class="invalid-feedback font-85 d-block" role="alert">
                                                            <strong
                                                                style="color: red;font-size: 15px;">{{ $message }}
                                                            </strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <button class="btn btn-success w-100" type="submit">
                                                            {{config('setting.pricing') ? __('layouts.checkout')  :__('layouts.priceRequest')}}
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6 col-12" id="NewAddressFormReset"
                                                         style="display: none;">
                                                        <button class="btn btn-outline-secondary w-100"
                                                                type="reset">
                                                            @lang('reset')
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            {{--<div class="checkout-title">
                                <h3>{{__('layouts.BillingDetails')}}</h3>
                            </div>
                            <div class="theme-form">
                                <div class="row check-out ">
                                    @if(Auth::guard('web')->check())
                                        <input type="hidden" name="id" value="{{auth()->user()->id}}">
                                    @else
                                        <a href="{{route('login')}}" data-transition="turn"
                                           class="btn btn-primary btn-block font-bold font-italic mb-3">
                                            <i class="fa fa-user"></i>
                                            {{__('layouts.asUser')}}
                                        </a>
                                    @endif
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label for="fName">{{__('auth.fName')}}</label>
                                        <input id="fName" type="text" class="form-control" name="first_name"
                                               value="{{auth()->user()->userDetails->first_name??old('first_name')}}">
                                        @error('first_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                                <strong
                                                    style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label for="lName">{{__('auth.lName')}}</label>
                                        <input id="lName" type="text" class="form-control" name="last_name"
                                               value="{{auth()->user()->userDetails->last_name??old('last_name')}}">
                                        @error('last_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label for="email">{{__('auth.Email')}}</label>
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{auth()->user()->email??old('email')}}">
                                        @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label for="phone">{{__('auth.phoneNumber')}}</label>
                                        <input id="phone" type="text" class="form-control rounded" name="phone"
                                               minlength="11"
                                               value="{{auth()->user()->contact_number??old('phone')}}">
                                        @error('phone')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="address">{{__('auth.address')}}</label>
                                            <input id="address" type="text" class="form-control" name="address"
                                                   value="{{auth()->user()->userDetails->address??old('address')}}">
                                            @error('address')
                                            <span class="invalid-feedback d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>{{__('auth.state')}}</label>
                                        <select class="form-select state_selector"
                                                data-city-target="#city_selector"
                                                data-state-route="{{route('get-sate-cities-onChange')}}"
                                                data-current_id="{{auth()->user()->userDetails->state_id??old('state_id')}}"
                                                name="state_id" required>
                                            @if(Auth::guard('web')->check())
                                                @foreach($states as $state)
                                                    <option
                                                        value="{{old('state_id')??$state->id}}" {{$state->id == auth()->user()->userDetails->state_id ?'selected':''}}>
                                                        {{$state->name}}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach($states as $state)
                                                    <option
                                                        value="{{$state->id}}" {{$state->id == old('state_id') ?'selected':''}}>
                                                        {{$state->name}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state_id')
                                        <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>{{__('auth.city')}}</label>
                                        <select id="city_selector" class="form-select" name="city_id">
                                            <option value="0" disabled></option>
                                            @if(Auth::guard('web')->check())
                                                @foreach($states->find(auth()->user()->userDetails->state_id??1)->cities as $city)
                                                    <option
                                                        value="{{$city->id}}" {{$city->id == auth()->user()->userDetails->city_id ?'selected':''}}>
                                                        {{$city->city}}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach($states->first()->cities as $city)
                                                    <option
                                                        value="{{$city->id}}" {{$city->id == old('city_id') ?'selected':''}}>
                                                        {{$city->city}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('city_id')
                                        <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>{{__('auth.postal_code')}}</label>
                                        <input type="text" name="postal_code" class="form-control rounded"
                                               value="{{auth()->user()->userDetails->postal_code??old('postal_code')}}">
                                        @error('postal_code')
                                        <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>--}}

                            <div class="col-md-6 col-sm-12 col-xs-12 mt-lg-4 {{auth('web')->check()?'mt-lg-5 pt-lg-5':''}}">
                                <div class="checkout-details theme-form">
                                    <div class="order-box">
{{--                                        <div class="title-box">--}}
{{--                                            <div>{{__('layouts.products')}} <span>{{config('setting.pricing')? __('layouts.price'):__('layouts.quantity')}}</span></div>--}}
{{--                                        </div>--}}
                                        <ul class="qty product-list">
                                            @foreach(userCart()->getContent() as $item)
                                                <li>
                                                    <div class="row d-ruby">
                                                        @include('root.components.lazy-image', [
                                                            'default' => 'storage/uploads/100x100/default.png',
                                                            'url' => $item->associatedModel->images->count() > 0 ?  $item->associatedModel->images->first()->image_url(100, 100) : null,
                                                            'alt' => 'product',
                                                            'class' => 'col-2 img-thumbnail rounded',
                                                        ])
                                                        <a class="col-8 text-capitalize d-block"
                                                           href="{{ route('products.show', $item->associatedModel->slug) }}">

                                                            <p>
                                                                {{ $item->associatedModel->name }}
                                                                @if(config('setting.pricing'))
                                                                    @if($item->attributes->count())
                                                                        -  {{ $item->attributes->first()->attribute->parentAttr->name??'' }}
                                                                        {{ $item->attributes->first()->attribute->name??'' }}
                                                                    @endif
                                                                    × {{ $item->quantity }}
                                                                @endif
                                                            </p>
                                                            <p class="badge badge-primary">H&M</p>
                                                        </a>

                                                        <portal class="col-2 text-end float-end mt-xl-4">{{ config('setting.pricing')? $item->price : $item->qunatity}}</portal>

                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <hr />
                                        @if(config('setting.pricing'))

{{--                                            <ul class="sub-total">--}}
{{--                                                <li>{{__('layouts.subTotal')}} <span class="count">{{$totalPrices['sub_total']}} EGP</span></li>--}}
{{--                                                <li>{{__('layouts.texes')}} <span class="count">{{$totalPrices['taxes']}} EGP</span></li>--}}
{{--                                            </ul>--}}

                                            <ul class="total">
                                                <li>{{__('layouts.subTotal')}} <span class="count text-end">{{$totalPrices['sub_total']}} EGP</span></li>
                                                @if($totalPrices['tax'])
                                                    <li>{{__('layouts.texes')}} <span class="count text-end">{{$totalPrices['taxes']}} EGP</span></li>
                                                @endif
                                                <li>{{__('layouts.shippingAmount')}} <span class="count text-end">0 EGP</span></li>
                                                <li class="font-bold pt-2">{{__('layouts.orderTotalPrice')}}  <span class="count text-end font-bold"><u>{{$totalPrices['total']}}</u> EGP</span></li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- section end -->
@endsection
@push('scripts')
    {{--<script src="{{asset('assets/js/jquery.mobile-1.4.5.min.js')}}"></script>--}}
    <script>
        import Portal from "../../../../public/assets/js/bootstrap-vue/bootstrap-vue";
        $(function () {
            $('#NewAddressButton').click(function (e) {
                e.preventDefault();
                $('input[name=user_address_id]').attr('disabled', true);
                $('#UserAddressesList').hide();
                $('#NewAddressForm,#NewAddressFormReset').show();
            });
            $('#NewAddressFormReset').click(function (e) {
                $('input[name=user_address_id]').removeAttr('disabled', true);
                $('#NewAddressForm,#NewAddressFormReset').hide();
                $('#UserAddressesList').show();
            });
        });
        // checkOutLoginForm = $('#checkOutLoginForm'),
        // errorLoginEmil = $('#errorLoginEmil strong');
        // checkOutLoginForm.submit(function (e) {
        //     e.preventDefault();
        //     let route = $(this).attr('action'),
        //     formData = $(this).serializeArray();
        //     console.log(formData)
        //     $.ajax({
        //         url:route,
        //         method:'POST',
        //         data:formData,
        //         success:function (data) {
        //             if(data.tag){
        //                 document.location.replace(data.msg);
        //             }else {
        //                 errorLoginEmil.text(data.msg).parent().show();
        //             }
        //         }
        //     })
        // })
        export default {
            components: {Portal}
        }
    </script>
@endpush
