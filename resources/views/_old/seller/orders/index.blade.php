@extends('seller.layouts.app')
@section('title')
    Order List
@endsection
@section('style')
<link href="{{asset('admin-asset/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<style>
    select{width:60%;height:40px;border-radius:5px}
</style>
@endsection
@section('container')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">{{__("seller.orders")}}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{__("seller.Home")}}</a></li>
                        <li class="breadcrumb-item active">{{__("seller.orders")}}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="getOrder" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="Order">{{__("seller.orderStat")}}</label>
                                    <select name="orderStatus" id="brand" class="form-control">
                                        <option value="">{{__("seller.All")}}</option>
                                        @foreach ($orderStatuses as $orderstatus)
                                            <option value="{{$orderstatus->id}}">{{$orderstatus->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" class="m-t-30 btn btn-success btn-block" value="Filter">
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive m-t-10">
                            <table id="myTable" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("seller.n")}}</th>
                                        <th>{{__("seller.EMAIL")}}</th>
                                        <th>{{__("seller.Phone")}}</th>
                                        <th>{{__("seller.Show")}}</th>
                                        <th>{{__("seller.controles")}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders->count() > 0)
                                        @foreach($orders as $key => $order)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$order->first_name}}</td> 
                                                <td>{{$order->email}}</td> 
                                                <td>{{$order->phone}}</td>
                                                <td>
                                                    <a type="button" href="/seller/orders/{{$order->id}}" class="btn waves-effect waves-light btn-outline-info"><i class="ti-pencil-alt"></i></a>
                                                </td> 
                                                <td>
                                                    <input type="hidden" class="order_id" value="{{$order->id}}">
                                                    <select class="statusChang" name="status_id">
                                                        <option value="{{$order->status_id}}">{{$order->status->name}}</option>
                                                        @foreach ($orderStatuses as $orderstatus)
                                                            @if($orderstatus->id != $order->status_id)
                                                                <option value="{{$orderstatus->id}}">{{$orderstatus->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7">{{__("seller.noProducts")}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p style="position:absoulte">{{__("seller.orders")}}: {{$orders->total()}}</p>
                            </div>
                            <div class="col-md-9">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        {{$orders->links()}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection

@section('scripts')
    <script src="{{asset('admin-asset/assets/node_modules/datatables/datatables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script>
        $(function(){
            $('select[name="grade_id"]').on('change', function() {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "section/classroom/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classroom_id"]').empty();  /*لحذف ما بالبيانات الي بها لوضع البيانات الجديدة*/
                            $.each(data, function (key, value) {
                                $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
                
        });
    </script>
    <script>
        $(function(){
            $index = 0;
            $('select[name="status_id"]').each(function(){
               if($(this).val() == 1){
                    $(this).attr('style','background:#fadcd9');
                }else if($(this).val() == 2) {
                    $(this).attr('style','background:#efe7bc');
                }else if($(this).val() == 3){
                    $(this).attr('style','background:#bcece0');
                }else if($(this).val() == 4){
                    $(this).attr('style','background:#ef7c8e');
                }
            });
            $index++;
            $('.statusChang').on('change', function() {
                var order_id = $(this).siblings('.order_id').val();
                var status_id = $(this).val();
                console.log(order_id, status_id);
                if (status_id) {
                    $.ajax({
                        url: "orderstatus/" + order_id,
                        type: "post",
                        data:{
                            '_token':"{{csrf_token()}}",
                            'id':order_id,
                            'status_id':status_id
                        },
                        success: function (data) {
                            if(data.status == 'success'){
                                toastr.success(data.msg);
                                $index = 0;
                                $('select[name="status_id"]').each(function(){
                                    if($(this).val() == 1){
                                        $(this).attr('style','background:#fadcd9');
                                    }else if($(this).val() == 2) {
                                        $(this).attr('style','background:#efe7bc');
                                    }else if($(this).val() == 3){
                                        $(this).attr('style','background:#bcece0');
                                    }else if($(this).val() == 4){
                                        $(this).attr('style','background:#ef7c8e');
                                    }
                                });
                                $index++;
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
@endsection