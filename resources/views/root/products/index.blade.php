@extends('root.layouts.app')

@section('stylesheet')
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <!-- section start -->
    <section class="section-big-py-space ratio_asos b-g-light">
        <div class="collection-wrapper">
            <div class="custom-container">
                <div class="row" id="filterApp">
                    <div class="col-sm-3 collection-filter category-side category-page-side">
                        <div class="collection-filter-block creative-card creative-inner category-side">
                            <div class="collection-mobile-back">
                                <span class="filter-back">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i> @lang('back')
                                </span>
                            </div>
                            <div v-if="categoryId && categoryId !=0">
                                <div class="collection-collapse-block open">
                                    <h3 class="collapse-block-title mt-0">@lang('layouts.category')</h3>
                                    <div class="collection-collapse-block-content"
                                         style="max-height: 250px;overflow: auto;">
                                        <div class="collection-brand-filter">
                                            <div class="custom-control custom-checkbox form-check collection-filter-checkbox mt-1" style="padding-left: 0">
                                                <a class="fw-bolder d-block" href="{{ route('products.index') }}" style="color: #333"> <i style="height: 20px;" data-feather="{{App::getLocale() == 'ar'? 'arrow-right':'arrow-left'}}"></i> @lang('layouts.all_category') </a>
                                            </div>

                                            <div class="custom-control custom-checkbox form-check collection-filter-checkbox">
                                                <strong>@{{ category_text_name }}</strong>
                                            </div>

{{--                                            <div id="categoriesTree"></div>--}}

                                            {{--<div v-for="category in filterOptions.categories"
                                                 class="custom-control custom-checkbox form-check collection-filter-checkbox">
                                                <input type="checkbox" class="custom-control-input form-check-input"
                                                       @change="refresh" :disabled="isLoading"
                                                       v-model="category.selected" :id="'CategoryFilter_' + category.id">
                                                <label class="custom-control-label form-check-label"
                                                       :for="'CategoryFilter_' + category.id">@{{ category.name }} (@{{
                                                    category.products_count }})</label>
                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="collection-collapse-block open"
                                     v-if="filterOptions.categories && filterOptions.categories.length > 0">
                                    <h3 class="collapse-block-title mt-0">@lang('layouts.category')</h3>
                                    <div class="collection-collapse-block-content"
                                         style="max-height: 250px;overflow: auto;">
                                        <div class="collection-brand-filter">
                                            <div id="categoriesTree"></div>

                                            {{--<div v-for="category in filterOptions.categories"
                                                 class="custom-control custom-checkbox form-check collection-filter-checkbox">
                                                <input type="checkbox" class="custom-control-input form-check-input"
                                                       @change="refresh" :disabled="isLoading"
                                                       v-model="category.selected" :id="'CategoryFilter_' + category.id">
                                                <label class="custom-control-label form-check-label"
                                                       :for="'CategoryFilter_' + category.id">@{{ category.name }} (@{{
                                                    category.products_count }})</label>
                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="collection-collapse-block open mt-4"
                                 v-if="filterOptions.brands && filterOptions.brands.length > 0">
                                <h3 class="collapse-block-title mt-0">@lang('layouts.brand')</h3>
                                <div class="collection-collapse-block-content"
                                     style="max-height: 250px;overflow: auto;">
                                    <div class="collection-brand-filter">
                                        <div v-for="brand in filterOptions.brands"
                                             class="custom-control custom-checkbox form-check collection-filter-checkbox">
                                            <input type="checkbox" class="custom-control-input form-check-input"
                                                   @change="refresh" :disabled="isLoading"
                                                   v-model="brand.selected" :id="'BrandFilter_' + brand.id">
                                            <label class="custom-control-label form-check-label"
                                                   :for="'BrandFilter_' + brand.id">@{{ brand.name }} (@{{
                                                brand.products_count }})</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="collection-collapse-block open mt-4"
                                 v-if="filterOptions.brands && filterOptions.brands.length > 0">
                                <h3 class="collapse-block-title mt-0">@lang('layouts.company')</h3>
                                <div class="collection-collapse-block-content"
                                     style="max-height: 250px;overflow: auto;">
                                    <div class="collection-brand-filter">
                                        <div v-for="company in filterOptions.companies"
                                             class="custom-control custom-checkbox form-check collection-filter-checkbox">
                                            <input type="checkbox" class="custom-control-input form-check-input"
                                                   @change="refresh" :disabled="isLoading"
                                                   v-model="company.selected" :id="'CompanyFilter_' + company.id">
                                            <label class="custom-control-label form-check-label"
                                                   :for="'CompanyFilter_' + company.id">@{{ company.name }} (@{{
                                                company.products_count }})</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(config('setting.pricing'))
                                <div v-if="filterOptions.attributes && filterOptions.attributes.length > 0">
                                    <div class="collection-collapse-block open mt-4"
                                         v-for="attrGroup in filterOptions.attributes"
                                         v-if="attrGroup.childes !== 'undefined'"
                                         v-if="attrGroup.products_count>0">
                                        <h3 class="collapse-block-title mt-0">@{{ attrGroup.name }}</h3>
                                        <div class="collection-collapse-block-content"
                                             style="max-height: 250px;overflow: auto;">
                                            <div class="collection-brand-filter" v-if="attrGroup.childes !== 'undefined'">
                                                <div v-for="attribute in attrGroup.childes"
                                                     v-if="attrGroup.childes.length> 0 && attribute.products_count>0"
                                                     class="custom-control custom-checkbox form-check collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input form-check-input"
                                                           @change="refresh" :disabled="isLoading"
                                                           v-model="attribute.selected" :id="'AttributeFilter_' + attribute.id">
                                                    <label class="custom-control-label form-check-label"
                                                           :for="'AttributeFilter_' + attribute.id">@{{ attribute.name }} (@{{
                                                        attribute.products_count }})</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="collection-collapse-block border-0 open">
                                    <h3 class="collapse-block-title">@lang('layouts.price')</h3>
                                    <div class="collection-collapse-block-content">
                                        <div class="filter-slide">
                                            <input id="prices" class="js-range-slider" type="text" name="my_range" value="" data-type="double"
                                                   v-model="filterOptions.prices" @change="checkPrice" @input="checkPrice" :disabled="isLoading"/>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="collection-product-wrapper">
                                        <div class="product-top-filter">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="filter-main-btn">
                                                        <span class="filter-btn btn btn-theme">
                                                            <i class="fa fa-filter" aria-hidden="true"></i> Filter
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-filter-content">
                                                        <div class="search-count w-50">
                                                            <h5>
                                                                @lang('Showing') @{{ data.length }} @lang('of') @{{ pagination.total }}
                                                                <span v-if="searchName" style="font-size: 1rem"> @lang('layouts.resultsFor') <spane style="color: #f07100">" @{{ searchName }} "</spane></span>
                                                            </h5>
                                                        </div>
                                                        <div class="collection-view">
                                                            <ul>
                                                                <li><i class="fa fa-th grid-layout-view"></i></li>
                                                                <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                            </ul>
                                                        </div>
                                                        {{--<div class="collection-grid-view">
                                                            <ul>
                                                                <li><img
                                                                        src="{{asset('assets/images/category/icon/2.png')}}"
                                                                        alt="" class="product-2-layout-view"></li>
                                                                <li><img
                                                                        src="{{asset('assets/images/category/icon/3.png')}}"
                                                                        alt="" class="product-3-layout-view"></li>
                                                                <li><img
                                                                        src="{{asset('assets/images/category/icon/4.png')}}"
                                                                        alt="" class="product-4-layout-view"></li>
                                                                <li><img
                                                                        src="{{asset('assets/images/category/icon/6.png')}}"
                                                                        alt="" class="product-6-layout-view"></li>
                                                            </ul>
                                                        </div>--}}
                                                        {{--<div class="product-page-per-view">
                                                            <select>
                                                                <option value="High to low">24 Products Par Page
                                                                </option>
                                                                <option value="Low to High">50 Products Par Page
                                                                </option>
                                                                <option value="Low to High">100 Products Par Page
                                                                </option>
                                                            </select>
                                                        </div>--}}
                                                        {{--<div class="product-page-filter">
                                                            <select>
                                                                <option value="High to low">Sorting items</option>
                                                                <option value="Low to High">50 Products</option>
                                                                <option value="Low to High">100 Products</option>
                                                            </select>
                                                        </div>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-wrapper-grid product">
                                            <div class="row">
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box"
                                                     v-for="product in data">
                                                    <div class="product-box">
                                                        <span v-if="product.is_hot|| product.on_sale" class="type-span" :class="product.is_hot? 'btn-danger':'btn-success'">@{{ product.percent }}</span>
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a :href="product.url">
                                                                    <template
                                                                        v-if="product.images && product.images.length > 0">
                                                                        @include('root.components.lazy-image', [
                                                                           'default' => 'storage/uploads/312x340/default.png',
                                                                           'url' => 'product.images[0]',
                                                                           'class' => 'img-fluid', 'vue' => true,
                                                                       ])
                                                                    </template>
                                                                    <template v-else>
                                                                        @include('root.components.lazy-image', [
                                                                            'default' => 'storage/uploads/312x340/default.png',
                                                                            'class' => 'img-fluid', 'vue' => true,
                                                                       ])
                                                                    </template>
                                                                </a>
                                                            </div>
                                                            <div class="product-back"
                                                                 v-if="product.images && product.images.length > 1">
                                                                <a :href="product.url">
                                                                    @include('root.components.lazy-image', [
                                                                      'default' => 'storage/uploads/312x340/default.png',
                                                                      'url' => 'product.images[1]',
                                                                      'class' => 'img-fluid', 'vue' => true,
                                                                    ])
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    @if(config('setting.pricing') === true)
                                                                        <div class="rating-star">
                                                                            <i v-for="star in parseInt(product.stars)"
                                                                               class="fa fa-star"></i><i
                                                                                v-for="star in (5-parseInt(product.stars))"
                                                                                class="fa fa-star-o"></i>
                                                                        </div>
                                                                    @endif
                                                                    {{--<p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>--}}
                                                                    <span class="badge btn-primary btn-sm">@{{ product.brand }}</span>
                                                                    <a :href="product.url">
                                                                        <h6 class="product-title mt-2">
                                                                            @{{ product.name }}
                                                                        </h6>
                                                                    </a>
                                                                </div>
                                                                @if(config('setting.pricing') === true)
                                                                    <div class="detail-right">
                                                                        <div class="price">
                                                                            <div class="price"> @{{ product.price }} EGP </div>
                                                                        </div>
                                                                        <div v-if="product.before_price" class="check-price ps-2"> @{{ product.before_price }} EGP</div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cart"
                                                                        :data-product-id="product.id"
                                                                        data-tippy-content="Add to cart">
                                                                    <i data-feather="shopping-cart"></i>
                                                                </button>
                                                                {{--<a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist">
                                                                    <i data-feather="heart"></i>
                                                                </a>--}}
                                                                <a href="javascript:void(0)"
                                                                   :data-url="product.quickView"
                                                                   class="quick-view tooltip-left"
                                                                   data-tippy-content="Quick View">
                                                                    <i data-feather="eye"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr />

                                        <div class="row pageUrlRow">
                                            <div class="pageUrlBtn col-6">
                                                <button @click="loadMore" class="btn btn-primary fw-bolder" :disabled="pagination.nextUrl == null">
                                                    <i data-feather="{{App::getLocale() == 'ar'? 'arrow-right':'arrow-left'}}"></i>
                                                    @lang('layouts.nextPage')
                                                </button>
                                            </div>
                                            <div class="pageUrlBtn col-6 {{App::getLocale() == 'ar'? 'text-start':'text-end'}}">
                                                <button @click="loadPrev" class="btn btn-primary fw-bolder" :disabled="pagination.prevUrl == null">
                                                    @lang('layouts.prevPage')
                                                    <i data-feather="{{App::getLocale() == 'ar'? 'arrow-left':'arrow-right'}}"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section End -->
@endsection

@push('scripts')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <script>
        Vue.use(VueMask.VueMaskPlugin);
        Vue.directive('mask', VueMask.VueMaskDirective);
        let vueApp = new Vue({
            el: '#filterApp',
            data: {
                isLoading: false,
                fetchRequestController: null,
                categoriesTree: null,
                searchName: '{{ request('searchName') }}',
                categoryId: '{{ request('categoryId') }}',
                category_text_name: null,
                apiUrl: '{{ route('products.api') }}',
                defaultImageUrl: '{{ asset('storage/uploads/312x340/default.png') }}',
                filterOptions: {
                    brands: [],
                    categories: [],
                    companies: [],
                    attributes: [],
                    price_1: 0,
                    price_2: null,
                    prices: 0,
                },
                data: [],
                pagination: {
                    total: 0,
                    nextUrl: null,
                    prevUrl: null,
                }
            },
            created() {
                @if(request()->get('category_id'))
                    this.fetchData(false, false, {
                    categories: [{{ request()->get('category_id') }}]
                })
                @else
                    this.fetchData()
                @endif
            },
            methods: {
                checkPrice(){
                    let prices = (document.querySelector('#prices').value).split(';');
                    this.filterOptions.price_1 = prices[0];
                    this.filterOptions.price_2 = prices[1];
                    this.refresh();
                },
                getSelectedAttributes(){
                    let selected = [];
                    this.filterOptions.attributes.forEach((attr)=>{
                        attr.childes.filter(i => i.selected === true? selected.push(i.id):null);
                    });
                    return selected;
                },
                refresh: function () {
                    this.fetchData()
                },
                loadMore: function () {
                    this.fetchData(true)
                },
                loadPrev: function () {
                    this.fetchData(false, true)
                },
                moreUrl(next = false, prev = false)
                {
                    if (next)
                        return this.pagination.nextUrl
                    else if (prev)
                        return  this.pagination.prevUrl
                    else
                       return  this.apiUrl
                },
                fetchData: function (more = false, prev = false, getData = null) {
                    console.log(this.filterOptions.prices)
                    if (this.isLoading && this.fetchRequestController !== null)
                        this.fetchRequestController.abort()
                    this.fetchRequestController = new AbortController();
                    this.isLoading = true;
                    this.data = [];
                    fetch(this.moreUrl(more, prev), {
                        method: 'POST',
                        signal: this.fetchRequestController.signal,
                        body: JSON.stringify({
                            _token: '{{csrf_token()}}',
                            ...(
                                getData !== null ?
                                    getData : {
                                        brands: this.filterOptions.brands.filter(i => i.selected === true).map(i => i.id),
                                        categories: (this.categoriesTree && 'getCheckedNodes' in this.categoriesTree) ? this.categoriesTree.getCheckedNodes() : [],
                                        companies: this.filterOptions.companies.filter(i => i.selected === true).map(i => i.id),
                                        attributes: this.getSelectedAttributes(),
                                        searchName: '{{ request('searchName') }}',
                                        categoryId: '{{ request('categoryId') }}',
                                        price_1: this.filterOptions.price_1||0,
                                        price_2: this.filterOptions.price_2,
                                    }
                            )
                        }),
                        headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
                    }).then(response => response.json()).then(data => {
                        if ('success' in data) {
                            this.filterOptions = data.filterOptions;
                            if (more) {
                                this.data = this.data.concat(data.data);
                            } else {
                                this.data = data.data;
                            }
                            this.category_text_name = data.category_text_name;
                            this.pagination.nextUrl = data.pagination.next_url;
                            this.pagination.prevUrl = data.pagination.prev_url;
                            this.pagination.total = data.pagination.total;
                        }
                    }).catch((e) => {
                        console.log(e);
                    }).finally(() => {
                        this.isLoading = false;
                        this.fetchRequestController = null;
                        yall();
                        if (!this.categoriesTree)
                            this.categoriesTree = $('#categoriesTree').tree({
                                primaryKey: 'id',
                                dataSource: this.filterOptions.categories,
                                uiLibrary: 'bootstrap4',
                                checkboxes: true
                            });
                    });
                },
            },
            watch: {
                /*'filterOptions.brands': {
                    handler: function (val, oldVal) {
                        console.log(val);
                    },
                    deep: true,
                },
                'filterOptions.data': function () {
                    setTimeout(yall, 1000);
                }*/

            }
        });
        window.vueApp = vueApp;
        $(document).on('change', '#categoriesTree input', function () {
            vueApp.refresh()
        });


    </script>
    <script src="{{asset('assets/js/ion.rangeSlider.js')}}"></script>
    <script>
        $(".js-range-slider").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: 200,
            to: 800,
            prefix: "$",
            onChange: function (data) {
                vueApp.checkPrice()
            },
        });
    </script>

@endpush
