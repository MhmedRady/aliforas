    <!--collection banner start-->
    <section class="collection-banner section-py-space bg-white">
        <div class="container-fluid">
            <div class="row collection2">
                @foreach ($category as $key => $item)
                    @if($key<6)
                        <div class="col-md-4">
                            <div class="collection-banner-main p-right banner-9">
                                <div class="collection-img">
                                    <img src="{{route("categoryImg",$item->banner)}}" class="img-fluid bg-img"  alt="{{$item->name}}">
                                </div>
                                <div class="collection-banner-contain">
                                    <div>
                                        @php
                                            $exName = explode( " " ,$item->name,2);
                                        @endphp
                                        <h3>{{array_shift($exName)}}</h3>
                                        <h4>{{array_pop($exName)??""}}</h4>
                                        <div class="shop">
                                            <a href="product-page(left-sidebar).html">
                                                shop now
                                                <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>
        </div>
    </section>
    <!--collection banner end-->
