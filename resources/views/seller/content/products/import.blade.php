@extends('seller.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body wizard-content">
                        <div class="row page-titles mb-2">
                            <div class="col-md-5 align-self-center">
                                <h4 class="text-themecolor">Products</h4>
                            </div>
                            <div class="col-md-7 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('seller.home')}}">@lang('Home')</a></li>
                                        <li class="breadcrumb-item active">Products</li>
                                        <li class="breadcrumb-item active">Import</li>
                                    </ol>
                                </div>
                            </div>
                            <hr>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session()->has('failures'))
                            <table class="table table-danger">

                                <tr>
                                    <th>Row</th>
                                    <th>Attribute</th>
                                    <th>Errors</th>
                                </tr>

                                @foreach(session()->get('failures') as $error)
                                    <tr>
                                        <td>
                                            {{$error->row()}}
                                        </td>
                                        <td>
                                            {{$error->attribute()}}
                                        </td>
                                        <td>
                                            {{$error->errors()[0]}}
                                        </td>
{{--                                        <td>--}}
{{--                                            {{$error->values()[0]}}--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach

                            </table>
                        @endif

                        {!! Form::open([
                            "enctype" => "multipart/form-data",
                            'url' => route('seller.products.import'), 'class' => 'tab-wizard vertical wizard-circle', 'id' => 'add_category_form']) !!}


                        <div class="form-group mb-1">
                            <label class="form-label" for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $id => $name)
                                    @if(substr_count($name, '-') < substr_count(next($categories), '-') )
                                        <option disabled value="{{ $id }}" style="color: #f70000">{{ $name }}</option>
                                    @else
                                        <option value="{{ $id }}">{{$name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label class="form-label" for="brand_id">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-control">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label class="form-label" for="manufacturer_id">Company</label>
                            <select name="manufacturer_id" id="manufacturer_id" class="form-control">
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label class="form-label" for="branch_id">Branch</label>
                            <select name="branch_id" id="branch_id" class="form-control">
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <section>
                            <div class="form-group mb-1">
                                <label class="form-label" for="file">Excel file:</label>
                                <input type="file" name="file" id="file" class="form-control required" required>
                            </div>
                            <div class="form-group mb-1">
                                <button type="submit" class="btn btn-success">IMPORT</button>
                                <a href="{{route('seller.products.file')}}" type="button" class="btn btn-primary"> <i data-feather="file-text"></i> Empty File </a>
                            </div>
                        </section>




                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
@section('page-style')
    <link href="{{asset('admin-asset/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('page-script')
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
        $(document).ready(function() {
            const dataTable = $('#myTable').DataTable({
                "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                "processing": true,
                "serverSide": true,
                // "deferLoading": $('#datatable').attr("data-total"),
                "ajax": {
                    url: '{{ route('admin.products.data') }}',
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                },
                "columns": [
                    { "data": "id"},
                    { "data": "product_translations.name", width: "30%", "class": "text-left"},
                    { "data": "brand_manufacturer", width: "30%", searchable: false, orderable: false, "class": "text-left"},
                    { "data": "is_active", width: "10%", searchable: false},
                    { "data": "options", searchable: false, orderable: false, "class": "text-center" }
                ],
                "order" : [
                    [0, "desc"]
                ],
                "drawCallback": function( settings ) {
                    $("[data-toggle=tooltip],.tooltips").tooltip();
                }
            });

            $('#filter').click(function () {
                let url = '{{ route('admin.products.data') }}?';
                if ($('#brand').val()) {
                    url += '&brand=' + $('#brand').val()
                }
                if ($('#manufacturer').val()) {
                    url += '&manufacturer=' + $('#manufacturer').val()
                }
                if ($('#category').val()) {
                    url += '&category=' + $('#category').val()
                }
                dataTable.ajax.url(url).load();
                return false;
            })

        } );
    </script>

@endsection
