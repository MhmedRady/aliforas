@extends('root.layouts.app')
@section('title',__('layouts.aboutUs'))
@section('stylesheet')
{{--    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">
@endsection



@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-main ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-contain">
                        <div>
                            <ul>
                                <li><a href="{{route('index')}}">{{__('layouts.home')}}</a></li>
                                <li><i class="fa fa-angle-double-right"></i></li>
                                <li><a href="javascript:void(0)">{{__('layouts.aboutUs')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->
    <section class="section-big-py-space ratio_asos b-g-light">
        <div class="collection-wrapper">
            <div class="title8 section-big-pt-space">
                <h4>{{__('layouts.aboutUs')}}</h4>
            </div>
            <div class="custom-container">
                {!! $about->document !!}
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.js"></script>
@endpush
