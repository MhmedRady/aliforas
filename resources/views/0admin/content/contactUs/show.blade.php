@extends('admin.layouts.contentLayoutMaster')

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body wizard-content ">
                        <div class="row">
                            <h4 class="card-title">
                                Contact Messages
                                <div class="action-icons float-end">
                                    <form action="{{route('admin.contact-messages.destroy',$message)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="badge btn-light rounded-circle border-0 text-body p-1">
                                            <i data-feather="trash" class="font-medium-3"></i>
                                        </button>
                                    </form>
                                </div>
                            </h4>

                        </div>

                        <!-- Two-steps verification -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-50">{{$message->name}}</h4>
                                <span>{{$message->created_at->diffForHumans()}}</span>

                                <div class="d-flex justify-content-between border-bottom mb-1 pb-1">
                                    <div class="row w-100">
                                        <div class="col-md-6">
                                            <h6 class="fw-bolder mt-2">Email</h6>
                                            <span>{{$message->email}}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="fw-bolder mt-2">Phone Number</h6>
                                            <span>{{$message->phone}}</span>
                                        </div>
                                    </div>

                                </div>
                                <p class="mb-0">
                                    {{$message->message}}
                                </p>
                            </div>
                        </div>
                        <!--/ Two-steps verification -->
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection
