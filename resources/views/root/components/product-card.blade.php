<div>
    <div class="product-box">
        @if($product->on_sale || $product->is_hot)
            <span class="btn-{{$product->is_hot?'danger': 'success'}} type-span">{{$product->percent}}</span>
        @endif
        <div class="product-imgbox">
            <div class="product-front">
                <a href="{{ route('products.show', $product->slug) }}">
                    @include('root.components.lazy-image', [
                            'default' => 'storage/uploads/312x340/default.png',
                            'url' => $product->images->count() > 0 ?  $product->images->first()->image_url(312, 340) : null,
                            'alt' => 'product',
                            'class' => 'img-fluid',
                        ])
                </a>
            </div>
            @if($product->images->count() > 1)
                <div class="product-back">
                    <a href="{{ route('products.show', $product->slug) }}">
                        @include('root.components.lazy-image', [
                            'default' => 'storage/uploads/312x340/default.png',
                            'url' => $product->images->get(1)->image_url(312, 340),
                            'alt' => 'product',
                            'class' => 'img-fluid',
                        ])
                    </a>
                </div>
            @endif

            <div class="product-icon icon-top">
                {{--<a href="javascript:void(0)" class="add-to-wish tooltip-left"
                   data-tippy-content="Add to Wishlist">
                    <i data-feather="heart"></i>
                </a>--}}
                <a href="javascript:void(0)"
                   data-url="{{ route('products.quick-view', $product) }}"
                   class="quick-view tooltip-left" data-tippy-content="Quick View">
                    <i data-feather="eye"></i>
                </a>
                <a href="javascript:void(0)"
                   data-product-id="{{ $product->id }}"
                   class="tooltip-left add-cart" data-tippy-content="Add to cart">
                    <i data-feather="shopping-cart"></i>
                </a>
            </div>
            {{--<button type="button" data-tippy-content="Add to cart" data-product-id="{{ $product->id }}"
                    class="btn btn-outline btn-cart tooltip-top add-cart">
                Add to cart
            </button>--}}
            {{--<div class="new-label">
                <div>hot</div>
            </div>--}}
            <span class="card-brand-name badge btn-primary btn-sm">{{  $product->brand ? $product->brand->name : '' }}</span>
        </div>
        <div class="product-detail product-detail2">
            @if(config('setting.pricing') === true)
                <ul>
                    @for($star = 0; $star < ($product->reward_points>5?5:$product->reward_points); $star++)
                        <li><i class="fa fa-star"></i></li>
                    @endfor

                    @for($star = 0; $star < (5-($product->reward_points>5?5:$product->reward_points)); $star++)
                        <li><i class="fa fa-star-o"></i></li>
                    @endfor

                </ul>
            @endif

            <a href="{{ route('products.show', $product->slug) }}">
                <h3>{{ $product->name }}</h3>
            </a>
            @if(config('setting.pricing'))
                <h5>
                    {{ $product->productAttributesHasQuantity->unique('attribute_id')->count()?
                        $product->productAttributesHasQuantity->unique('attribute_id')->first()->price :$product->price }} EGP
                    @if($product->before_price)
                        <span>{{ $product->before_price }} EGP</span>
                    @endif
                </h5>
            @endif
        </div>
    </div>
</div>
