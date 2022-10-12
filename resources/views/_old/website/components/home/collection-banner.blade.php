@if($HotCategories && $HotCategories->count() > 0)
    <!--collection banner start-->
    <section class="collection-banner section-py-space bg-white">
        <div class="container-fluid">
            <div class="row collection2">
                @foreach ($HotCategories as $item)
                    <div class="col-md-4">
                        <div class="collection-banner-main p-right banner-9">
                            @if($item->banner)
                                <a href="{{route('web.products.relation.all',['relation'=>'category_products','relate_id'=>$item->id])}}"
                                   class="collection-img">
                                    <img src="{{route("categoryImg", $item->banner)}}" class="img-fluid bg-img"
                                         alt="banner">
                                </a>
                            @endif

                            <div class="collection-banner-contain">
                                <div style="background-color: #fff9;padding: 10px;">
                                    @php
                                        $exName = explode(' ' ,$item->Translate->name,2);
                                    @endphp
                                    <h3>{{array_shift($exName)}}</h3>
                                    <h4>{{array_pop($exName)??""}}</h4>
                                    <div class="shop">
                                        <a href="{{route('web.products.relation.all',['relation'=>'category_products','relate_id'=>$item->id])}}">
                                            shop now
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--collection banner end-->
@endif
