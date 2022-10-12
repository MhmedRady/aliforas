@extends('seller.layouts.app')
@section('title', __("seller.showProducts"))
@section('container')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">{{__("seller.Products")}}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{__("seller.Home")}}</a></li>
                        <li class="breadcrumb-item active">{{__("seller.Products")}}</li>
                    </ol>
                    <a href="{{route('seller.products.import.show')}}" class="btn btn-cyan btn-sm d-block m-l-15" style='margin:5px'><i class="fa fa-plus-circle"></i> {{__("seller.importP")}} </a>
                    <a href="{{route('seller.products.export')}}" class="btn btn-success btn-sm d-block m-l-15" style='margin:5px'><i class="fa fa-plus-circle"></i> {{__("seller.exportP")}}</a>
                    <a href="{{route('seller.products.create')}}" class="btn btn-info btn-sm d-block m-l-15" style='margin:5px'><i class="fa fa-plus-circle"></i> {{__("seller.nCreate",["var"=>__("seller.Product")])}} </a>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        @if (session('rules_validation'))
            <div class="alert alert-danger">
                <ul>
                    @foreach(session('rules_validation') as $validate)
                        <li>{{ $validate }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-3">
                                <label for="brand">{{__("seller.Brand")}}</label>
                                <select name="brand" id="brand" class="form-control">
                                    <option value="">{{__("seller.All")}}</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="manufacturer">{{__("seller.Manufacturer")}}</label>
                                <select name="manufacturer" id="manufacturer" class="form-control">
                                    <option value="">{{__("seller.All")}}</option>
                                    @foreach($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="brand">{{__("seller.Category")}}</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">{{__("seller.All")}}</option>
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <a href="#" id="filter" class="m-t-30 btn btn-success btn-block">{{__("seller.Filter")}}</a>
                            </div>
                        </div>

                        <div class="table-responsive m-t-10">
                            <table id="table_id" class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__("seller.n")}}</th>
                                    <th>{{__("seller.Brand")}}</th>
                                    <th>{{__("seller.Category")}}</th>
                                    <th>{{__("seller.act")}}</th>
                                    <th>item no</th>
                                    <th>{{__("seller.Price")}}</th>
                                    <th>{{__("seller.Discount")}}</th>
                                    <th>{{__("seller.HotPrice")}}</th>
                                    <th>{{__("seller.bPrice")}}</th>
                                    <th>Stock</th>
                                    <th>{{__("seller.controles")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as$key=> $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>

                                        <td>
                                            {{isset($product->brand) ? $product->brand->translate(\Lang::getLocale())->name : ""}}
                                        </td>

                                        <td>{{isset($product->categories[0]) ? $product->categories[0]->translate(\Lang::getLocale())->name : ""}}</td>

                                        <td>
                                            {!!$product->is_active ? '<label class="badge badge-info">Active</label>':'<label class="badge badge-danger">Deactive</label>'!!}
                                        </td>
                                        <td>{{$key+1}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->sale_ends_at}}</td>
                                        <td>{{$product->hot_price}}</td>
                                        <td>{{$product->before_price}}</td>
                                        <td>{{$product->stock}}</td>
                                        <td>
                                            <a href="{{route('seller.products.show', $product->id)}}" class="btn waves-effect waves-light btn-outline-warning" title="edit">Show</a>
                                            <a href="{{route('seller.products.attribute.index', $product->id)}}" class="btn waves-effect waves-light btn-outline-success" title="inactive">Attribute</a>
                                            <a href="{{route('seller.products.edit', $product->id)}}" class="btn waves-effect waves-light btn-outline-info" title="edit">Edit</a>
                                            {!!$product->on_sale === 1?'<a href="' . route('seller.products.enddeal', $product->id) . '" class="btn waves-effect waves-light btn-outline-info" title="End Deal">End Deal</a>':''!!}
                                            {!!$product->is_active ? '<a href="'.route('seller.products.active', $product->id).'" class="btn waves-effect waves-light btn-outline-success" title="active">Activate</a>':'<a href="'.route('seller.products.active', $product->id).'" class="btn waves-effect waves-light btn-outline-danger" title="inactive">InActivate</a>'!!}
                                            <form action="{{route('seller.products.destroy', $product->id)}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" class="btn btn-outline-danger sa-warning" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">{{__("seller.noProducts")}}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
@section('style')
    <link href="{{asset('admin-asset/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
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
        $(document).ready(function() {
            $('#table_id').DataTable();
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
