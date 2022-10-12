<style>
    .note-popover.bottom{
        display: none;
    }
    .gallery ul {
        padding: 0;
        margin: 0;
    }
    .gallery ul {
        list-style: none;
    }
    .gallery ul li {
        margin: 5px;
        float: left;
        padding: 3px;
        border: 1px solid #DDD;
        width: 200px;
        height: 200px;
        position: relative;
        overflow: hidden;
        {{--background-image: url({{asset('website/images/logo-2.png')}});--}}
        {{--background-color: #fff;--}}
        {{--opacity: .5;--}}
        {{--background-size: contain;--}}
    }
    .gallery ul li img {
        width: 192px;
        max-height: 192px;
    }
    .gallery ul li .options {
        position: absolute;
        height: 30px;
        left: 3px;
        bottom: 3px;
        right: 3px;
        padding: 0 10px;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .gallery ul li .options a {
        color: white;
        font-size: 14px;
    }
    .gallery ul li .options i {
        font-size: 20px;
    }
    .gallery ul li .options i.delete {
        color: red;
    }
    .gallery .icon {
        display: none;
    }
    .gallery .selected .icon {
        display: block;
        position: absolute;
        font-size: 50px;
        color: green;
        left: 50%;
        top: 50%;
        transform: translateY(-50%) translateX(-50%);
    }
    .add-new {
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .add-new i {
        font-size: 30px;
    }
</style>


<div id="images-details-modern" class="content" role="tabpanel" aria-labelledby="images-details-modern-trigger">

    <div class="content-header text-start">
        <h5 class="mb-0">@lang('layouts.productsImages')</h5>
        <small class="text-muted">@lang('layouts.upload') @lang('layouts.productsImages')</small>
    </div>

    <div class="row">
        <script id="gallery-item" type="text/html">
            <li>
                <img class="thumbnail" src="" alt="">
                <input type="file" name="images[]" accept="image/*" class="file required" />
                <input type="hidden" name="thumbnail[]" class="thumb-input" value="0" />
                <div class="options">
                    <a href="#" class="set-thumbnail"><i class="mdi mdi-checkbox-blank-circle-outline"></i> Thumbnail</a>
                    <a href="#" class="delete-gallery"><i class="delete mdi mdi-delete"></i></a>
                </div>
                <i class="icon mdi mdi-check-circle-outline"></i>
            </li>
        </script>

        <div class="gallery">
            <ul>
                {{--                                    @foreach(range(1, 3) as $a)--}}
                {{--                                        <li>--}}
                {{--                                            <img class="thumbnail" src="https://picsum.photos/{{ rand(190, 220) }}" alt="">--}}
                {{--                                            <div class="options">--}}
                {{--                                                <a href="#" class="set-thumbnail"><i class="mdi mdi-checkbox-blank-circle-outline"></i> Thumbnail</a>--}}
                {{--                                                <a href="#" class="delete-gallery"><i class="delete mdi mdi-delete"></i></a>--}}
                {{--                                            </div>--}}
                {{--                                            <i class="icon mdi mdi-check-circle-outline"></i>--}}
                {{--                                        </li>--}}
                {{--                                    @endforeach--}}
                <li class="add-new">
                    <a href="#"><i class="mdi mdi-plus-box-outline"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <button class="btn btn-outline-secondary btn-prev waves-effect" type="button">
            <i class="mb-1" data-feather="arrow-right" width="14" height="14"></i>
            <span class="align-middle d-sm-inline-block d-none">@lang('Previous')</span>
        </button>
        <button class="btn btn-primary btn-next waves-effect waves-float waves-light" type="button">
            <span class="align-middle d-sm-inline-block d-none">@lang('Next')</span>
            <i class="mb-1" data-feather="arrow-left" width="14" height="14"></i>
        </button>
    </div>
</div>