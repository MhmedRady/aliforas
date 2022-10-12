@include('base.table')
@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">List Sellers</h4>
            </div>
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
    </div>
    <section class="container ">
        <div class="container bg-white table-responsive">
            <table id="table_data" class="table table-hover">
                <thead>
                <th>#</th>
                <th>name</th>
                <th>email</th>
                <th>contact_number</th>
                <th>gender</th>
                <th>state</th>
                <th>option</th>
                </thead>
                <tbody>
                @foreach($sellers as $index => $item)
                 @if($item->id !== auth()->id())
                    <tr class="{{!$item->is_active?'text-danger':''}}">
                        <td>{{++$index}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->contact_number}}</td>
                        <td>{{$item->gender}}</td>
                        <td>
                            @if ($item->is_active)
                                <i class="far text-success fa-check-circle"></i> Active
                            @else
                                <i class="fas fa-times text-danger"></i> deactive
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.showSeller',$item->id)}}" class="btn btn-info"> Edit </a>
                            <a class="btn btn-primary" href="{{route('admin.seller.change_state',[$item->id])}}">
                                @if (!$item->is_active)
                                    <i class="far text-success fa-check-circle"></i> Active
                                @else
                                    <i class="fas fa-times text-danger"></i> deactive
                                @endif
                            </a>
                        </td>
                    </tr>
                  @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@section('page-style')
    <style>
        input {
            max-width: 150px;
        }
    </style>
@endsection
@section('page-script')
    <script src="{{asset('admin-asset/assets/node_modules/datatables/datatables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script>
      $('#table_data').DataTable();
        $('#table_data tbody button[data-edit="edit"]').click(function () {
            let tr = $(this).parentsUntil('tr').parent();
            tr.find('input').removeAttr('readonly');
            tr.find('input').removeClass('d-none');
            tr.find('button').toggleClass('d-none');
        });
    </script>
@endsection
