@extends('admin.layouts.contentLayoutMaster')

@section('content')
    <section style="direction: ltr">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-capitalize"><strong>{{optional($order->user_address)->first_name . ' ' . optional($order->user_address)->last_name}}</strong></h4>
                <span class="badge   btn-primary badge-sm" style="direction: ltr">{{$order->created_at->diffForHumans()}}</span>
            </div>
            <hr />
            <div class="card-body">
            {{--                    <p class="card-text mb-2 pb-1">--}}
            {{--                        --}}
            {{--                    </p>--}}
            <!-- single license -->

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-underLine">User Personal Date</h5>
                        <ul class="ps-25 ms-1">
                            <li><strong>username :</strong> {{optional($order->user_address)->first_name . ' ' . optional($order->user_address)->last_name}}</li>
                            <li><strong>Email :</strong> {{$order->user->email??''}}</li>
                            <li><strong>Phone Number :</strong> {{optional($order->user_address)->phone}}</li>

                            {{--                    <li><strong>{{__('auth.workPlace')}} :</strong> {{$order->user->employer??''}}</li>--}}
                            <li><strong>{{__('auth.gender')}} :</strong> {{$order->user->gender??''}}</li>
                            {{--                    <li><strong>{{__('auth.NID')}} :</strong> {{$order->user->national_id??''}}</li>--}}
                            <li><strong>{{__('auth.age')}} :</strong> {{$order->user->age??''}}</li>
                        </ul>
                    </div>

{{--                    <p class="card-text mb-2 pb-75"></p>--}}

                    <div class="col-md-6 d-grid justify-content-end">
                        <h5 class="text-underLine">Order Details</h5>
                        <ul class="ps-25 ms-1">

                            <li><strong>Zone Name :</strong>
                                {{optional(optional(optional($order->user_address)->state)->zone_list)->first()->name?? '-'}}
                            </li>
                            <li><strong>City :</strong> {{optional(optional($order->user_address)->state)->name}}</li>
                            <li><strong>State :</strong> {{optional(optional($order->user_address)->city)->name}}</li>

                            <li><strong>Address :</strong> {{optional($order->user_address)->address}}</li)>
                            <li><strong>Status :</strong> {{$order->status->name??'New'}}</li>

                            <li><strong>Sipping Company :</strong>
                                {{optional(optional(optional($order->user_address)->state)->zone_list)->first()->company->name?? '-'}}
                            </li>
                            @isset($order->shipped_at)
                                <li>
                                    <span class="btn badge btn-info fw-bolder" style="font-size: .95rem;">
                                        <strong>Sipping Date :</strong>
                                        {{$order->shipped_at}}
                                    </span>
                                </li>
                            @endisset
                            <li><strong>Date :</strong> <span class="badge btn-warning" style="color: #222 !important;">{{$order->created_at}}</span> </li>

                        </ul>
                    </div>
                </div>
                <hr />
{{--                <h5 class="text-underLine">Last Order Update</h5>--}}
{{--                <ul class="ps-25 ms-1">--}}

{{--                    <li><strong>Admin Name :</strong> {{$order->admin->name}}</li>--}}
{{--                    <li><strong>Last Update At :</strong> {{$order->viewed_at}}</li>--}}

{{--                </ul>--}}

                <p class="card-text mb-2 pb-75"></p>

                <form action="{{route('admin.update-order',$order)}}" method="post">
                    @csrf
                    <!-- table -->
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Attribute Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Stock</th>
                                <th scope="col">weight</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderProduct as $key => $item)
                                <input type="hidden" name="items[{{$key}}][product_id]" value="{{$item->product_id}}">
                                <tr>
                                    <th scope="row" class="text-center product-name">{{$item->product->name}}</th>
                                    <th scope="row" class="text-center product-name">{{$item->attributeProduct->attribute->name??' - '}}</th>
                                    <td>{{$item->quantity}}<input type="hidden" class="disabled" name="items[{{$key}}][quantity]" readonly value="{{$item->quantity}}" style="max-width: 60px;border: none;text-align: center;"></td>
                                    <td>{{$item->product->stock}}</td>

                                    <td style="max-width: min-content;">
                                        <span>{{ceil($item->quantity * $item->product->weight)}}</span>
                                    </td>

                                    <td style="max-width: min-content;">
                                        <input type="text" name="items[{{$key}}][price]" value="{{$item->price}}"
                                               class="changePrice form-control text-center fw-bold w-100"
                                               data-total="#sub_total_{{$key+1}}" data-items="{{$item->quantity}}" readonly
                                               style="border: none; background-color: #fff">
                                    </td>

                                    <td id="sub_total_{{$key+1}}" class="sub_total fw-bold">{{($item->total)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <thead>
                            <tr style="border-bottom: 2px solid #fff;font-size: 1rem;">

                                <th scope="row" class="table-active align-middle"><strong><u>Sipping Amount</u></strong></th>
                                <th colspan="6" class="text-start" style="padding-right: 0;border-bottom: 2px solid #fff;font-size: 1rem;">
                                    <strong style="float: right">
                                        <u>
                                            <input id="Sipping" class="form-control disabled m-0" type="text" name="prices" value="{{$order->shipping_amount}}" readonly style="padding: 2px">
                                        </u>
                                    </strong>
                                </th>
                            </tr>

                            <tr style="border-bottom: none;font-size: 1rem;">
                                <th scope="row" class="table-active align-middle"><strong><u>Total Prices</u></strong></th>
                                <th colspan="6" class="text-start" style="padding-right: 0;border: 2px solid #f3f2f7;font-size: 1rem;">
                                    <strong style="float: right">
                                        <u>
                                            <input id="Prices" class="form-control disabled m-0" type="text" name="prices" value="{{$order->total}}" readonly style="padding: 2px">
                                        </u>
                                    </strong>
                                </th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                    <!-- / table -->

                    <!-- alert -->
                @if(!isset($order->admin))
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold" for="status" style="font-size: 1rem">Order Status</label>
                                <div class="input-group input-group-merge">
                                    <select id="status" class="form-select" name="status">
                                        @foreach($statuses as $state)
                                            <option class="fw-bold" value="{{$state->id}}" {{$state->id == ($order->status_id?? 5) ?'selected':''}}>{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-primary">
                        <div class="alert-body d-flex align-items-center justify-content-between flex-wrap p-2">
                            <div class="me-1">
                                <h4 class="fw-bolder text-primary">Do you need To Save Changes and Send Prices To User ? 👩🏻‍💻</h4>
                                {{--                            <p class="fw-normal mb-1 mb-lg-0">--}}
                                {{--                                If you’ve mass production demand and other custom use cases than we’re here to help you.--}}
                                {{--                            </p>--}}
                            </div>
                            <button class="btn btn-primary">
                                Save Status
                            </button>
                        </div>
                    </div>

                @endif
                </form>
            </div>
        </div>
    </section>
@endsection

@section('page-style')
    <style>
        li{
            margin-bottom: .5rem;
        }
        .product-name
        {
            text-transform: capitalize;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }
        #Prices, #Sipping
        {
            display: inline-flex;
            max-width: 150px;
            width: max-content;
            text-align: center;
            margin: 0 10px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
@endsection
@section('page-script')
    <script>
        let priceInput = document.querySelectorAll('.changePrice'),
            totalInput = document.getElementById('Prices');

       function getPrices()
        {
            priceInput.forEach((el)=>{
                el.addEventListener('keyup',function (){
                    let inputData = this.dataset;
                    let inputTotal = document.querySelector(inputData.total);
                    inputTotal.innerText = (parseInt(inputData.items) * this.value);
                    getTotalPrices();
                });
            });
        }

        function getTotalPrices()
        {
            let total = [];
            let allTotals = document.querySelectorAll('*[id^="sub_total_"]');
            allTotals.forEach((el)=>{
                total.push(parseInt(el.innerText));
                totalInput.value = total.reduce((el, index) => el + index, 0);
            });
        }
        getPrices();
    </script>
@endsection
