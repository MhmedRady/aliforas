@extends('admin.layouts.contentLayoutMaster')
@section('content')

@section('tableColumns')
    {{--    @if(Session::has('success'))--}}
    {{--        <button class="btn btn-block btn-success m-auto mb-0 mt-1 font-85 d-flex w-auto font-bold" style="font-weight: bold;">--}}
    {{--            {{Session::get('success')}}--}}
    {{--        </button>--}}
    {{--    @endif--}}
    <th>Name</th>
    <th>Image</th>
    <th>Category</th>
    <th>Brand</th>
    <th>Branch</th>
    <th>Manufacturer</th>
    <th>Active</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'title' => __('layouts.is_hot'),
    'columns' => ['name', 'image' ,'category_title', 'brand_title', 'branch_title', 'manufacturer_title', 'status'],
    'createPopup' => false
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
{{--                <h4 class="text-themecolor">Hot Products</h4>--}}
{{--            </div>--}}
{{--            <div class="col-md-7 align-self-center text-right">--}}
{{--                <div class="d-flex justify-content-end align-items-center">--}}
{{--                    <ol class="breadcrumb">--}}
{{--                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>--}}
{{--                        <li class="breadcrumb-item active">Products</li>--}}
{{--                    </ol>--}}
{{--                    <a href="{{route('admin.products.import.show')}}" class="btn btn-cyan d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Import Products</a>--}}
{{--                    <a href="{{route('admin.products.export')}}" class="btn btn-success d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Export</a>--}}
{{--                    <a href="{{route('admin.products.create', ['is_hot'=>'is_hot'])}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</a>--}}
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

{{--                        <div class="row">--}}
{{--                            <div class="col-md-3">--}}
{{--                                <label for="brand">Brand</label>--}}
{{--                                <select name="brand" id="brand" class="form-control">--}}
{{--                                    <option value="">All</option>--}}
{{--                                    @foreach($brands as $brand)--}}
{{--                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <label for="manufacturer">Manufacturer</label>--}}
{{--                                <select name="manufacturer" id="manufacturer" class="form-control">--}}
{{--                                    <option value="">All</option>--}}
{{--                                    @foreach($manufacturers as $manufacturer)--}}
{{--                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <label for="brand">Category</label>--}}
{{--                                <select name="category" id="category" class="form-control">--}}
{{--                                    <option value="">All</option>--}}
{{--                                    @foreach($categories as $id => $name)--}}
{{--                                        <option value="{{ $id }}">{{ $name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <a href="#" id="filter" class="m-t-30 btn btn-success btn-block">Filter</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="table-responsive m-t-10">--}}
{{--                            <table id="myTable" class="table table-bordered table-striped text-center">--}}
{{--                                <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>#</th>--}}
{{--                                        <th>Name / Category</th>--}}
{{--                                        <th>Active</th>--}}
{{--                                        <th>Hot Starts At</th>--}}
{{--                                        <th>Hot Ends At</th>--}}
{{--                                        <th>Price</th>--}}
{{--                                        <th>Discount</th>--}}
{{--                                        <th>Actions</th>--}}
{{--                                    </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                    @forelse($products as$key=> $product)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$key+1}}</td>--}}
{{--                                        <td>{{$product->name}} </td>--}}
{{--                                        <td>--}}
{{--                                            {!!$product->is_active ?'<label class="badge badge-info">Active</label>':'<label class="badge badge-danger">Deactive</label>'!!}--}}
{{--                                        </td>--}}
{{--                                        <td>{{$product->hot_starts_at}}</td>--}}
{{--                                        <td>{{$product->hot_ends_at}}</td>--}}
{{--                                        <td>{{$product->price}}</td>--}}
{{--                                        <td>{{$product->before_price}}</td>--}}
{{--                                        <td>--}}
{{--                                            <a href="{{route('admin.products.show', $product->id)}}" class="btn waves-effect waves-light btn-outline-warning" title="edit">Show</a>--}}
{{--                                            <a href="{{route('admin.products.attribute.index', $product->id)}}" class="btn waves-effect waves-light btn-outline-success" title="inactive">Attribute</a>--}}
{{--                                            <a href="{{route('admin.products.edit', $product->id)}}" class="btn waves-effect waves-light btn-outline-info" title="edit">Edit</a>--}}
{{--                                            {!!$product->on_sale === 1?'<a href="' . route('admin.products.enddeal', $product->id) . '" class="btn waves-effect waves-light btn-outline-info" title="End Deal">End Deal</a>':''!!}--}}
{{--                                            {!!$product->is_active === 0?'<a href="'.route('admin.products.active', $product->id).'" class="btn waves-effect waves-light btn-outline-success" title="active">Activate</a>':'<a href="'.route('admin.products.active', $product->id).'" class="btn waves-effect waves-light btn-outline-danger" title="inactive">InActivate</a>'!!}--}}
{{--                                            <form action="{{route('admin.products.destroy', $product->id)}}" method="POST">--}}
{{--                                                @csrf--}}
{{--                                                <input type="hidden" name="_method" value="DELETE">--}}
{{--                                                <input type="submit" class="btn btn-outline-danger sa-warning" value="Delete">--}}
{{--                                            </form>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    @empty--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="8">There is No product yet !</td>--}}
{{--                                    </tr>--}}
{{--                                    @endforelse--}}
{{--                                </tbody>--}}
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
{{--    <link href="{{asset('admin-asset/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css')}}" rel="stylesheet">--}}
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
{{--        $(document).ready(function() {--}}
{{--            $('#myTable').DataTable();--}}

{{--            $('#filter').click(function () {--}}
{{--                let url = '{{ route('admin.products.data') }}?';--}}
{{--                if ($('#brand').val()) {--}}
{{--                    url += '&brand=' + $('#brand').val()--}}
{{--                }--}}
{{--                if ($('#manufacturer').val()) {--}}
{{--                    url += '&manufacturer=' + $('#manufacturer').val()--}}
{{--                }--}}
{{--                if ($('#category').val()) {--}}
{{--                    url += '&category=' + $('#category').val()--}}
{{--                }--}}
{{--                url +='&kind=is_hot'--}}
{{--                dataTable.ajax.url(url).load();--}}
{{--                return false;--}}
{{--            })--}}

{{--        } );--}}
{{--    </script>--}}

{{--@endsection--}}
