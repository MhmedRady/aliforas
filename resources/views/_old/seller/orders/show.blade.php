@extends('seller.layouts.app')
@section('title')
    Order Show
@endsection
@section('style')
<style>
    select{width:95%;height:40px;border-radius:5px}
</style>
@endsection
@section('container')
<script>
    function printDiv(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Orders</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <form method="post" id="printMe">
            {{csrf_field()}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Order Information</h3>
                            <div class="table-responsive m-t-10">
                                <table id="myTable" class="table table-bordered table-striped text-center">
                                    <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>User</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>State</th>
                                        <th>Postal Code</th>
                                        <th>Order Date</th>
                                        <th>Order Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>user</td>
                                        <td>{{ $order->first_name}}</td>
                                        <td>{{ $order->last_name}}</td>
                                        <td>{{ $order->phone  }}</td>
                                        <td>{{ $order->address  }}</td>
                                        <td>@if($order->get_state($order->state)) {{ $order->get_state($order->state)['name'] }} @endif</td>
                                        <td>{{ $order->postal_code }}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>
                                            <input type="hidden" class="order_id" value="{{$order->id}}">
                                            <select name="status_id">
                                                <option value="{{$order->status_id}}">{{$order->status->name}}</option>
                                                @foreach ($orderStatuses as $orderstatus)
                                                    @if($orderstatus->id !== $order->status_id)
                                                        <option value="{{$orderstatus->id}}">{{$orderstatus->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!-- <h3>Map Location</h3>
                                <div id="map" style="height: 200px;border: 1px solid #000;"></div> -->
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <h3>Order Products</h3>
                            <div class="table-responsive m-t-10">
                                <table id="myTable" class="table table-bordered table-striped text-center">
                                    <thead>
                                    <tr>
                                        <th>Item No.</th>
                                        <th>Product Name</th>
                                        <th>Dimensions (L x W x H)</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Discounted Price</th>
                                        <th>Inventory</th>
                                        <th>Product Type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $totalDiscount=0; ?>
                                    @foreach($order->products as $key=>$product)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$product->name}}
                                            @if(count($product->get_attr($product->pivot->attribute_id)))
                                            @foreach($product->get_attr($product->pivot->attribute_id) as $attr)
                                                <span class="label label-info">{{$attr->name}}</span>
                                            @endforeach
                                            @endif
                                            </td>
                                            <td>{{ $product->length }} x {{ $product->width }} x {{ $product->height }} </td>
                                            <td>{{ ceil($product->pivot->price) }}</td>
                                            <td>{{$product->pivot->quantity}}</td>
                                            <td>{{ ceil($product->pivot->price * $product->pivot->quantity) }}</td>
                                            <td>{{ $product->getFinalDiscountPriority() }}</td>
                                            <?php
                                            $totalDiscount+=$product->getFinalDiscountPriority(); ?>
                                            <td>
                                                @if(sizeof($product->inventories) > 0)
                                                    <select name="inventory[{{ $product->id }}]" id="inventory" class="form-control" required>
                                                        <option disabled selected>- SELECT INVENTORY</option>
                                                        @foreach($product->inventories as $inventory)
                                                            <option value="{{ $inventory->id }}" @if(in_array($order->state,explode(',',$inventory->areas))) selected @endif>{{ $inventory->name }} ({{ $inventory->pivot->quantity }})</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    NO INVENTORIES
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->is_bundle == 1)
                                                    Bundle
                                                @elseif($product->is_combo == 1)
                                                    Combo
                                                @elseif($product->is_hot == 1)
                                                    Hot Product
                                                @elseif($product->pivot->discount_type == 'bundle')
                                                    Bundle
                                                @else
                                                    Normal
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align:center;padding-right:0;padding-left:0;">
                                            <b>
                                                {{ $total_price }}
                                            </b>
                                        </td>
                                        <td style="text-align:center;padding-right:0;padding-left:0;">
                                            <b>
                                                {{ $totalDiscount }}
                                            </b>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body text-right">
                <button type="button" class="btn btn-danger" style="min-width: 250px" onclick="printDiv('printMe')">Print</button>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection
@section('style')
    <link href="{{asset('admin-asset/assets/node_modules/wizard/steps.css')}}" rel="stylesheet">
    <!--alerts CSS -->
    <link href="{{asset('admin-asset/assets/node_modules/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin-asset/dist/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/assets/node_modules/summernote/dist/summernote-bs4.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('admin-asset/assets/node_modules/wizard/jquery.steps.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/wizard/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/summernote/dist/summernote-bs4.min.js')}}"></script>
    <script>
        $(function(){
            if($('select[name="status_id"]').val() == 2) {
                $('select[name="status_id"]').attr('style','background:#efe7bc');
            }else if($('select[name="status_id"]').val() == 3){
                $('select[name="status_id"]').attr('style','background:#bcece0');
            }else if($('select[name="status_id"]').val() == 4){
                $('select[name="status_id"]').attr('style','background:#ef7c8e');
            }else{
                $('select[name="status_id"]').attr('style','background:#fadcd9');
            }
            $('select[name="status_id"]').on('change', function() {
                var order_id = $('.order_id').val();
                var status_id = $(this).val();
                if (status_id) {
                    $.ajax({
                        url: "/seller/orderstatus/" + order_id,
                        type: "post",
                        data:{
                            '_token':"{{csrf_token()}}",
                            'id':order_id,
                            'status_id':status_id
                        },
                        success: function (data) {
                            if(data.status == 'success'){
                                toastr.success(data.msg);
                                if($('select[name="status_id"]').val() == 2) {
                                    $('select[name="status_id"]').attr('style','background:#efe7bc');
                                }else if($('select[name="status_id"]').val() == 3){
                                    $('select[name="status_id"]').attr('style','background:#bcece0');
                                }else if($('select[name="status_id"]').val() == 4){
                                    $('select[name="status_id"]').attr('style','background:#ef7c8e');
                                }else{
                                    $('select[name="status_id"]').attr('style','background:#fadcd9');
                                }
                            }else{
                                toastr.error(data.msg);
                            }
                        }
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    <script>
    $(document).ready(function(){
        $(document).on('change','select[name="orderline_company_id"]',function(){
            var self = $(this);
            var order = self.data('order');
            var orderline = self.data('orderline');
            var company = self.val();
            $.get('/big-boss/shipping-request/'+company+'/'+order+'/'+orderline,function(res){
                alert(res);
            })
        })
    })
    </script>
    @if(!empty($order->lat) && !empty($order->lng))
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script>
    window.onload = function() {
        var latlng = new google.maps.LatLng({{$order->lat}}, {{$order->lng}});
        var map = new google.maps.Map(document.getElementById('map'), {
            center: latlng,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title: 'Set lat/lon values for this property',
            draggable: true
        });
    };
    </script>
    @endif
@endsection
