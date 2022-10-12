@extends('root.layouts.app')
@section('title',$page->name??env('APP_NAME'))
@section('stylesheet')
{{--    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">--}}
{{--    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">--}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">
@endsection

@section('content')
    <section class="section-big-py-space ratio_asos b-g-light">
        <div class="collection-wrapper">
            <div class="title8 section-big-pt-space">
                <h4>{{$page->name??env('APP_NAME')}}</h4>
            </div>
            <div class="custom-container">
                {!! $page->body !!}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.js"></script>
@endpush
