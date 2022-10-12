@if($HotCategories && $HotCategories->count() > 0)
    <!--rounded category start-->
    <section class="rounded-category rounded-category-inverse">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="slide-6 no-arrow">
                        @foreach($HotCategories as $item)
                            <div>
                                <div class="category-contain">
                                    @if($item->banner)
                                        <div class="img-wrapper">
                                            <a href="{{route('web.products.relation.all',['relation'=>'category_products','relate_id'=>$item->id])}}">
                                                <img src="{{asset('website/images/layout-1/rounded-cat/3.png')}}"
                                                     alt="{{$item->name}}" style="min-height: 100%"
                                                     class="img-fluid">
                                            </a>
                                        </div>
                                    @endif
                                    <a href="{{route('web.products.relation.all',['relation'=>'category_products','relate_id'=>$item->id])}}" class="btn-rounded">
                                        {{$item->name}}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--rounded category end-->
@endif
