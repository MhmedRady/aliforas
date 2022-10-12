@extends('root.layouts.app')
@section('content')
    <!-- thank-you section start -->
    <section class="section-big-py-space light-layout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(\Request::route()->getName()=='order.success')
                        @section('title',__('layouts.orderSuccess'))
                    <div class="success-text">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <h2>{{__('layouts.thanks')}}</h2>
                        <p>{{__('auth.orderSuccess')}}</p>
                    </div>
                    @else
                        @section('title',__('layouts.orderError'))
                    <div class="success-text error">
                        <i class="fa fa-times-circle" aria-hidden="true" style="color: #f00"></i>
                        <h2>{{__('layouts.sorry')}}</h2>
                        <p>{{__('auth.orderNotFound')}}</p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->
@endsection
