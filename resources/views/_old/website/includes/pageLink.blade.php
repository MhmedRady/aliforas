<!-- Page Links start -->
<div class="breadcrumb-main ">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-contain">
                    <div>
                        <h2>@yield("title")</h2>
                        <ul>
                            <li><a href="{{route("web.webHome")}}">home</a></li>
                            <li><i class="fa fa-angle-double-right"></i></li>
                            @if(isset($slug))
                                <li><a href="{{route("web.products.show",$slug)}}"><u>{{$slug}}</u></a></li>
                            @else
                                <li><a href="{{route(Route::currentRouteName())}}"><u>@yield("title")</u></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Links End -->
