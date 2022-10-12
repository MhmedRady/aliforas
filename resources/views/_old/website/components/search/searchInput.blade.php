<!-- section start -->
<section class="authentication-page section-big-pt-space b-g-light">
    <div class="custom-containe">
        <section class="search-block">

            <form class="form-header SearchForm" action="{{route('web.view-search-content')}}" method="POST">

                @csrf

                <div class="container">
                    <div class="row g-3">
                        <div class="col-lg-12 offset-lg-12">
                            <div class="row" style="justify-content: space-between;">
                                <div class="col-lg-4 mb-5">
                                    <label for="category" class="form-label search-label">Category</label>
                                    <select class="form-select" id="category" name="category_id">
                                        <option selected disabled value="0">Choose Category...</option>
                                        @if(isset($Categories) && $Categories->count() > 0)
                                            @foreach($Categories->where('parent_id',null) as $item)
                                                <option value="{{$item->id}}"> {{$item->name}} </option>

                                                @if(count($item->children)>0)
                                                    <optgroup label="{{$item->name}}">
                                                        @foreach($Categories as $subCategory)
                                                            @if($item->id == $subCategory->parent_id)
                                                                <option value="{{$subCategory->id}}"> {{$subCategory->name}} </option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                @endif

                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <label for="brand" class="form-label search-label">Brand</label>
                                    <select class="form-select" id="brand" name="brand_id">
                                        <option selected disabled value="0">Choose Brand...</option>
                                        @if( isset($Brands) && $Brands->count() > 0)
                                            @foreach($Brands as $item)
                                                <option value="{{$item->id}}"> {{$item->name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <label for="manufacturer" class="form-label search-label">Company</label>
                                    <select class="form-select" id="manufacturer" name="manufacturer_id">
                                        <option selected disabled value="0">Choose Company...</option>
                                        @if( isset($Categories) && $Categories->count() > 0)
                                            @foreach($Manufacturers as $item)
                                                    <option value="{{$item->id}}"> {{$item->name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6 offset-lg-3">
                            <div class="input-group search-group">
                                <input type="text" class="form-control SearchInput" data-out-list="page" name="content" aria-label="Amount (to the nearest dollar)"
                                       data-open-url="{{route("web.products.show",'productSlug')}}" placeholder="Search Products......">
                                <button class="btn btn-normal" value="post-submit" name="submit"><i class="fa fa-search"></i>Search</button>
                                <div class="dropdown-menu dropList w-100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</section>
<!-- section end -->
