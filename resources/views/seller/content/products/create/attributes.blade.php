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


<div id="attributes-details-modern" class="content text-start" role="tabpanel" aria-labelledby="attributes-details-modern-trigger">

    <div class="content-header">
        <h5 class="mb-0">@lang('layouts.product_attributes')</h5>
        <small class="text-muted">@lang('layouts.select') @lang('layouts.product_attributes')</small>
    </div>

    <div class="invoice-repeater mb-4">
        <div data-repeater-list="productAttributes">
            <div data-repeater-item>
                <div class="row d-flex align-items-end">
{{--                    <div class="row"> --}}
{{--                        @foreach($languages as $locale)--}}
{{--                            <div class="col-md-3 col-12">--}}
{{--                                <div class="form-group mb-2">--}}
{{--                                    <div class="mb-1">--}}
{{--                                        <label class="form-label" for="{{"attr.$locale->locale"}}"> Attribute Name <span class="btn badge btn-danger">{{$locale->name}}</span> </label>--}}
{{--                                        <input type="text" class="form-control" id="{{"attr.$locale->locale"}}" aria-describedby="{{"attr.$locale->locale"}}" name="{{"attr[name][$locale->locale]"}}" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}

                    <div class="col-md-5 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="attr[attribute_id]">@lang('layouts.attrType')</label>
                            <select id="attr[attribute_id]" aria-describedby="attrType" name="attr[attribute_id]" class="form-select">
                                <option value="0" selected disabled>@lang('Select') @lang('layouts.attrType') ...</option>
                                @foreach($attributes as $attr)
                                    <option value="{{$attr->id}}">{{$attr->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="attr[price]">@lang('layouts.price')</label>
                            <input type="number" class="form-control" id="attrPrice" aria-describedby="attrPrice" name="attr[price]" value="1" min="1"/>
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="attr[quantity]">@lang('layouts.quantity')</label>
                            <input type="number" class="form-control" id="attr[quantity]" aria-describedby="attr[quantity]" value="1" min="1" name="attr[quantity]"/>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="mb-1">
                            <button class="btn btn-danger text-nowrap font-bold line-height-1 px-1 p-2" data-repeater-delete type="button">
                                <i data-feather="trash-2" class="me-25"></i>
                                @lang('Delete')
                            </button>
                        </div>
                    </div>

                </div>
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-icon btn-primary d-sm-inline-block" type="button" data-repeater-create style="line-height: 1.1;">
                    <i data-feather="plus" class="me-25"></i>
                    <span>@lang('layouts.addNew')</span>
                </button>
            </div>
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
