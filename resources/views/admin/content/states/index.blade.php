@extends('admin.layouts.contentLayoutMaster')
@section('page-style')
    <style>
        .dataTables_wrapper{
            max-width: 100%;
            width: 100%;
            overflow: scroll hidden;
        }
    </style>
    {{--@if(config('setting.pricing') === true)--}}

    {{--@else--}}
@section('content')
@section('tableColumns')
    <th>Name</th>
    <th>Country</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'title' => 'States',
    'columns' => ['name', 'Country'],
])
@endsection

{{--@extends('admin.layouts.contentLayoutMaster')--}}
{{--@section('content')--}}
{{--    <div class="container-fluid">--}}
{{--        <!-- ============================================================== -->--}}
{{--        <!-- Bread crumb and right sidebar toggle -->--}}
{{--        <!-- ============================================================== -->--}}
{{--        <div class="row page-titles">--}}
{{--            <div class="col-md-5 align-self-center">--}}
{{--                <h4 class="text-themecolor">States</h4>--}}
{{--            </div>--}}
{{--            <div class="col-md-7 align-self-center text-right">--}}
{{--                <div class="d-flex justify-content-end align-items-center">--}}
{{--                    <ol class="breadcrumb">--}}
{{--                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>--}}
{{--                        <li class="breadcrumb-item active">States</li>--}}
{{--                    </ol>--}}
{{--                    <a href="{{route('admin.states.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i--}}
{{--                            class="fa fa-plus-circle"></i> Create New</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- ============================================================== -->--}}
{{--        <!-- End Bread crumb and right sidebar toggle -->--}}
{{--        <!-- ============================================================== -->--}}
{{--        <!-- ============================================================== -->--}}
{{--        <!-- Start Page Content -->--}}
{{--        <!-- ============================================================== -->--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="table-responsive m-t-10">--}}
{{--                            <table id="myTable" class="table table-bordered table-striped text-center">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>#</th>--}}
{{--                                    <th>State name</th>--}}
{{--                                    <th>Country name</th>--}}
{{--                                    <th>Actions</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- ============================================================== -->--}}
{{--        <!-- End PAge Content -->--}}
{{--        <!-- ============================================================== -->--}}
{{--    </div>--}}
{{--@endsection--}}
{{--@section('page-style')--}}
{{--    <link href="{{asset('admin-asset/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css')}}"--}}
{{--          rel="stylesheet">--}}
{{--@endsection--}}
{{--@section('page-script')--}}
{{--    <script src="{{asset('admin-asset/assets/node_modules/datatables/datatables.min.js')}}"></script>--}}
{{--    <!-- start - This is for export functionality only -->--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>--}}

{{--    <script>--}}
{{--        $('#myTable').DataTable({--}}
{{--            "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",--}}
{{--            "processing": true,--}}
{{--            "serverSide": true,--}}
{{--            // "deferLoading": $('#datatable').attr("data-total"),--}}
{{--            "ajax": {--}}
{{--                url: '{{ route('admin.states.data') }}',--}}
{{--                type: "POST",--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': '{{ csrf_token() }}',--}}
{{--                    'X-Requested-With': 'XMLHttpRequest'--}}
{{--                }--}}
{{--            },--}}
{{--            "columns": [--}}
{{--                {"data": "id"},--}}
{{--                {"data": "name", width: "30%", "class": "text-left"},--}}
{{--                {"data": "country_id", width: "30%", searchable: false, orderable: false, "class": "text-left"},--}}
{{--                {"data": "options", searchable: false, orderable: false, "class": "text-center"}--}}
{{--            ],--}}
{{--            "order": [--}}
{{--                [0, "desc"]--}}
{{--            ],--}}
{{--            "drawCallback": function (settings) {--}}
{{--                $("[data-toggle=tooltip],.tooltips").tooltip();--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}

{{--@endsection--}}
