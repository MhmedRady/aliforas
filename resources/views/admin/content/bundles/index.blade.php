@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Bundles</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Bundles</li>
                    </ol>
                    <a href="{{route('admin.bundles.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i
                            class="fa fa-plus-circle"></i> Create New</a>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="max-width: 150px;" id="table_data_filter" class="float-right">
                            <div class="input-group">
                                <input type='text' id="inputSearch"
                                       style="border-radius: 10px 10px 0px 5px"
                                       data-filter-col="0,1,2,3,4,5"
                                       placeholder='search'
                                       class='form-control font-inherit'>
                            </div>
                        </div>
                        <div class="table-responsive m-t-10">
                            <table id="table_data" class="table sorted table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name / Category</th>

                                    <th>Bundle start</th>
                                    <th>Bundle end</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}} <br> {{($item->categories[0]->name ?? '')}}</td>
                                        <td>{{$item->bundle_start}}</td>
                                        <td>{{$item->bundle_end}}</td>
                                        <td>{!!$item->is_active ? '<span class="label label-info">Active</span>' : '<span class="label label-danger">Inactive</span>'!!}</td>
                                        <td>
                                            @php
                                                $back = "";
                                                $back .= '&nbsp;<a href="'. route('admin.bundles.edit', $item->id) .'" class="btn waves-effect waves-light btn-outline-info" title="edit">Edit</a>&nbsp;';
                                                if($item->is_active == 0){
                                                    $back .= '&nbsp;<a href="'. route('admin.bundles.active', $item->id) .'" class="btn waves-effect waves-light btn-outline-success" title="active">Activate</a>&nbsp;';
                                                }else{
                                                    $back .= '&nbsp;<a href="'. route('admin.bundles.active', $item->id) .'" class="btn waves-effect waves-light btn-outline-danger" title="inactive">InActivate</a>&nbsp;';
                                                }

                                                $back .= \Form::open(['url'=>route('admin.bundles.destroy', $item->id), 'class' => 'd-inline', 'onclick' => 'return confirm("Are you sure?")']);
                                                $back .= method_field('DELETE');
                                                $back .= \Form::submit('Delete', ['class' => 'btn btn-outline-danger sa-warning']);
                                                $back .= \Form::close();
                                                echo $back;
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
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
@section('page-script')
    <script>
        Table.sort();
        Table.filtable();
    </script>
@endsection
