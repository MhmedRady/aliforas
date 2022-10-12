@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Product <b>{{$product->translations[0]['name']}}</b> Attributes</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{route('admin.products.index')}}">Products</a></li>
                        <li class="breadcrumb-item active">Edit Product Attributes</li>
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('has_not_Priority'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{session('has_not_Priority')}}</li>
                </ul>
            </div>
        @endif
    </div>
    <section class="container ">
        <h4> New Attribute </h4>
        <div class="mb-3 bg-white p-3">
            <form action="{{route('admin.products.attribute.store',$product)}}" enctype="multipart/form-data" class="" method="post">
                @csrf
                <div class="row no-gutters text-center">
                    <select name="attribute_id" class="col-2 custom-select mr-2" required>
                        @foreach ($attributes as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <input name="qte" type="number" min="1" class="form-control pl-2 col" required placeholder="Quantity" >
                    <input name="file" type="file" accept="image/*"  class="form-control mx-2 pl-2 col" placeholder="Image" >
                    <input name="price" type="number" required class="form-control pl-2 col" placeholder="Price" >
                    <input name="code" type="number" required class="form-control pl-2 mx-2 col" placeholder="Code" >
                    <button class="btn border-primary form-control col-1">
                        Add
                    </button>
                </div>
            </form>
        </div>
        <h4> Product Attribute </h4>
        <div class="container bg-white table-responsive">
            <table id="table_data" class="table table-hover">
                <thead>
                <th>Attribute</th>
                <th>Qte</th>
                <th>image</th>
                <th>price</th>
                <th>code</th>
                <th>option</th>
                </thead>
                <tbody>
                @foreach($product->attributes as $item)
                    <form class="d-none" id="form_delete_{{$loop->index}}" action="{{route('admin.products.attribute.destroy',['product'=>$product,'attribute'=>$item])}}" method="post">
                        @method('delete')
                        @csrf
                    </form>
                    <form method="post" enctype="multipart/form-data" action="{{route('admin.products.attribute.update',['product'=>$product,'attribute'=>$item])}}">
                        @csrf
                        @method('put')
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>
                                <input type="number" class="form-control" name="qte" value="{{$item->pivot->quantity}}" readonly>
                            </td>
                            <td>
                                <input type="file" accept="image/*" name="file" class="d-none">
                                @if($item->pivot->picture != null)
                                    @php
                                        $product_attribute_image=json_decode($item->pivot->picture);
                                        $product__old_attribute_image=json_encode($item->pivot->picture);
                                        $destinationPath = public_path('upload/products/');
                                    @endphp
                                    <div id="old_picture" style="display:-webkit-flex;">
                                        <img
                                            src="{{ URL::to('/upload/products/') }}/{{$product_attribute_image[0]}}"
                                            style="width:150px; height:50px;">
                                    </div>
                                @endif
                            </td>
                            <td>
                                <input type="number"  class="form-control" name="price" value="{{$item->pivot->price}}" readonly>
                            </td>
                            <td>
                                <input type="number"  class="form-control" name="code" value="{{$item->pivot->code}}" readonly>
                            </td>
                            <td>
                                <button type="button" data-edit="edit" class="btn btn-outline-success">Edit</button>
                                <button type="submit" class="btn d-none btn-outline-success">update</button>
                                <button form="form_delete_{{$loop->index}}" class="btn btn-danger">delete</button>
                            </td>
                        </tr>
                    </form>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@section('page-style')
<style>
    input{
        max-width: 150px;
    }
</style>
@endsection
@section('page-script')
    <script>
        $('#table_data tbody button[data-edit="edit"]').click(function (){
            let tr=$(this).parentsUntil('tr').parent();
            tr.find('input').removeAttr('readonly');
            tr.find('input').removeClass('d-none');
            tr.find('button').toggleClass('d-none');
        });
    </script>
@endsection
