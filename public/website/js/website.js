
let outQuick_view = $("#product-quick-view");
let wishQuick_view = $("._quick-wishList");
let cartQuick_view = $("._quick-cartList");
let outWishQuick_view = $(".out_wish_list");
let outCartQuick_view = $("._out_cart_list");

let cartForm = $('.productCartFormItem');
let cartFormUrl = cartForm.attr('action');

let searchInput = $(".SearchInput");
let searchForm = $(".SearchForm");
let formUrl = searchForm.attr('action');
let searchList = $(".dropList");
let headerSearchList = $(".headerSearchList");

let orderPrevBtn = $(".order-address .prev");

let state_selector = $('#state_selector');
let city_selector = $('#city_selector');

let qtyDecs = $('.qty-minus');
let qtyIncs = $('.qty-plus');

let nextClick = $('.next-click');

let showAll = $('.show-all-btn');

let emailSubscribe = $('#_email-subscribe');
let formSubscribe = $('#_form-email-subscribe');
let subscribeFeedback = $('#subscribeFeedback');

$("label").each(function(){
    if ($(this).is("[requ]")) {
        $(this).after('<small class="asst">*</small>');
    }
});

orderPrevBtn.on('click',function (){

    $('.prev-order').click();
});

/**** START WISHLIST ****/

function addToItem(open, img, name, price, beforePrice,rate,stock) {

    return `  <li>
                <div class="media">
                  <a href="${open}">
                    <img alt="megastore1" class="me-3"
                    src="${img}">
                  </a>
                  <div class="media-body">
                    <a href="${open}">
                      <h4>${name}</h4>
                    </a>

                    <div class="addit-box">
                    <div class="rating-star">

                    </div>
                    <div class="Quantity">
                    ${stock>0?`<span class="btn badge btn-primary btn-sm font-8" >in stock</span>`
                    :`<span class="btn badge btn-danger btn-sm out-stock font-8">out of stock</span>`}

                    </div>
                      <div class="pro-add">
<!--                        <a href="javascript:void(0)"-->
<!--                             data-bs-toggle="modal"-->
<!--                             data-bs-target="#edit-product">-->
<!--                          <i class="fa fa-pencil-square-o"></i>-->
<!--                        </a>-->
<!--                        <a href="javascript:void(0)">-->
<!--                          <i class="fa fa-trash-o"></i>-->
<!--                        </a>-->
                      </div>
                    </div>
                  </div>
                </div>
               </li>`;

}

function stars(rate) {

    let stars = [];
    if (rate>0){
        if (rate>5){
            for (var i=0;i<5;++i){
                stars.push('<li><i class="fa fa-star"></i></li>');
            }
        }else {

            for (var i=0;i<rate;++i){
                stars.push('<li><i class="fa fa-star"></i></li>');
            }
            for (var i=0;i<parseInt(5-rate);++i){
                stars.push('<li><i class="fa fa-star-o"></i></li>');
            }
        }
    }else {
        for (var i=0;i<5;++i){
            stars.push('<li><i class="fa fa-star-o"></i></li>');
        }
    }
    return stars;
}

function addToList(btn,RemovedClass,getCount) {
    $(btn).on("click",function (){

        if ($(this).hasClass(RemovedClass)){
            return false;
        }else if ($(this).hasClass("_add-to-cart")){
            $(this).removeClass("_add-to-cart");
            $(this).children().last().after("<i class=\"fa fa-check-circle inCartIcon\" aria-hidden=\"true\"></i>");
        }
        $(this).addClass(RemovedClass);
        let url = $(this).data("url");
        let items = [];

        $.ajax({
            url: url,
            method: "GET",
            success: function (data) {
                $(`.${getCount}`).text(data);
            },
            error: function (err) {

            }
        });
    });
}


function getListItems(btn,outView,subPriceTag,totalTag){
    btn.click(function (){

        let route   = $(this).data("url");
        let urlImg  = $(this).data("urlimg");
        let details = $(this).data("details");
        let subPrice = $(`${subPriceTag} span`);
        let totalPrice = $(`${totalTag}`);
        let items = [];
        let price = [];
        if (outView.children().length !==3){

            $.ajax({
                url: route,
                method: "GET",
                success: function (data) {
                    if (data.length>0){
                        outView.html(`<div class="ajax-loader"></div>`);
                        data.forEach((item, key) => {
                            let Product = item.product;
                            // console.log(Product.stock)
                            let open = details.replace("item", Product.slug),
                                img = `${urlImg}/${Product.image.image}`;
                            price.push(Product.price);
                            items.push(addToItem(open, img, Product.name, Product.price, Product.before_price,Product.reward_points,Product.stock));
                        });

                        outView.html(items);
                        let outPrice = price.reduce((a, b) => a + b, 0);
                        subPrice.text(Math.round(outPrice).toFixed(2));

                        let totalSum = Math.round(outPrice + (outPrice * .14)).toFixed(2);

                        totalPrice.text(" " + totalSum + " ");
                    }
                },
                error: function (err) {

                }
            });
        }
    });
}

addToList(".add-to-wish","addedToWish","getWishCount");
getListItems(wishQuick_view,outWishQuick_view,".wishSubPrice","#_wishTotalSum");

$(".removeWishItem").on("click",function () {
    let route = $(this).data("removeRoute");
    let item  = $(this).data("removeWish");

})

/**** END WISHLIST ****/

/**** START CARTLIST ****/

addToList("._add-to-cart","addedToCart","getCartCount");
getListItems(cartQuick_view,outCartQuick_view,".cartSubPrice","#_cartTotalSub");

/**** END CARTLIST ****/


/**** START CITY SELECTOR *****/

state_selector.on('change',function (){
    let currentID = $(this).data('current_id');
    let value = $(this).val();

    if (currentID !== value){
        let url = $(this).data('route')+`${value}`;
        let cities = [];
        $.ajax({
            url: url,
            method: "GET",
            success: function (data) {
                data.forEach((city,key)=>{
                    cities.push(`<option value="${city.id}" ${key == 0 ?'selected':''}> ${city.city} </option>`)
                });
                city_selector.html(cities);
            },
            error: function (err) {

            }
        });
    }
});

/**** END CITY SELECTOR *****/


/**** START PRODUCT QUICK VIEW *****/

$("._quick-view").on("click",function (){

    let route   = $(this).data("url");
    let urlImg  = $(this).data("urlimg");
    let cartUrl = $(this).data("cart-url");
    let details = $(this).data("details");

    let image  = $("#quick-view-img"),
        AjAx   = $("#product-quick-view .ajax-loader"),
        title  = $("#product-quick-view h2"),

        rate   = $("#product-quick-view .revieu-box ul"),
        stock  = $("#product-quick-view .qty-adj"),
        desc   = $("._desc"),

        price  = $("#product-quick-view .pro-price ._price"),
        sale   = $("#product-quick-view .pro-price ._sale"),
        offer  = $("#product-quick-view .pro-price ._offer"),

        cartForm = $("#quickCartFormItem"),
        cartInput  = $("#quickCartFormEffect .qty-adj");

        $("#product-quick-view > div:not(:last-of-type)").hide(100);

        AjAx.show(100);
        image.html('<div class="ajax-loader"></div>');

    $.ajax({
        url:route,
        method:"GET",
        success: function (data) {

            let img = urlImg+"/"+data.image.image;

            AjAx.hide(100);

            $("#product-quick-view > div:not(:last-of-type)").show(100);

            image.html(`<img src="${img}" class="img-fluid bg-img h-80">`);
            title.text(data.name);
            cartForm.attr('action',cartUrl);
            cartInput.attr('max',data.stock);
            // price.text("EGP "+data.price);
            // if (data.before_price>0){
                // sale.html("<span>EGP "+data.before_price+"</span>");
            // }
            // if (data.before_price>0){
                // let val = Math.trunc(data.price/data.before_price);

                // let intvalue = Math.trunc(100-( (data.price/data.before_price)*100 ) );
                // offer.text( -intvalue + "% OFF");
            // }

            stock.val(1);
            stock.attr("max",data.stock);
            rate.html(stars(data.reward_points));
            desc.html(data.translate.description);
            $("#_view-details").attr("href",details);
        },
        error:function (error){

        }
    });
});

/**** END PRODUCT QUICK VIEW *****/


    // qtyDecs.forEach((qtyDec) => {

    qtyDecs.each( function () {
        $(this).click(function (){
            let val = $(this).next().val();
            if (val > 1)
            {
                $(this).next().val((i, val) => val*1-1 );
                if($(this).hasClass('order-quantity-minus')){
                    $($(this).data('item')).text('X ' + (parseInt(val)-1));
                    outQuantities.text(parseInt(outQuantities.text())-1);
                }
            }
        });
    });

let outQuantities = $('#_quantities span');
    qtyIncs.each( function () {
        $(this).click(function (){

            let max = $(this).prev().attr('max');
            let val = $(this).prev().val();
            if (parseInt(val) < parseInt(max))
            {
                $(this).prev().val((i, val) => val*1+1 );
                if($(this).hasClass('order-quantity-plus')){
                    $($(this).data('item')).text(('X ' + (parseInt(val)+1)));
                    outQuantities.text(parseInt(outQuantities.text())+1);
                }
            }

        });
    });

nextClick.on('click',function (){
    $('.next').click();
});

showAll.click(function (){
    let target = $(this).data('target');
    $(target).toggleClass('show-all');
});

function searchItem(name,image,open)
{
    return `<a class="dropdown-item" href="${open}">
                <img class="img-thumbnail" src="${image}" alt=\`${name}\`
                style="width: 60px;height: 50px;margin: 0 5px;">
                ${name}
            </a>`;
}

searchInput.on('keyup',function () {
    let value = $(this).val();
    let open = $(this).data('open-url');
    let list = $(this).data('out-list');
    let formVal = searchForm.serializeArray();

    if (value.length>0 ){
        $.ajax({
            url:formUrl,
            data: formVal,
            method:"POST",
            success:function (data) {

                if (data.length>0){
                    let items = [];
                    data.forEach((item) => {
                        items.push(searchItem(item.name,item.image.image,open.replace('productSlug',item.slug)));
                    });
                    if (data.length===5){
                        items.push('<div class="dropdown-divider"></div> <button class="dropdown-item" onclick="this.form.submit()">See All</button>');
                    }
                    // console.log(searchInput.data('out-list'))
                    if (list === 'page'){
                        searchList.addClass('show').html(items);
                    }else {
                        headerSearchList.addClass('show').html(items);
                    }

                }else {
                    if (list === 'page'){
                        searchList.html('<button disabled class="dropdown-item text-center">Product Not Found ...!</button>');
                    }else {
                        headerSearchList.html('<button disabled class="dropdown-item text-center">Product Not Found ...!</button>');
                    }

                }
            },
            error:function (data) {

            }
        })
        $(document).on('click', function()
        {
            headerSearchList.removeClass('show');
            searchInput.removeClass('show');
        });
    }else {
        searchList.hide();
    }
})

$('#cartFormEffect,#quickCartFormEffect').on('click',function () {
    let formCart = $($(this).data('cart-form'));
    let url = formCart.attr('action');
    let data = formCart.serializeArray();


    $.ajax({
        url:url,
        data: data,
        method:'get',
        success:function (data) {
            $('.getCartCount').text(data);
        }
    })
});

$('.media-tab a').on('click',function () {
    let list = $(this).attr('href');
    $(`#${list}`).removeClass('d-none').addClass('active').siblings().addClass('d-none').removeClass('active');
})

emailSubscribe.click(function () {
    let val = formSubscribe.serializeArray();
    let url = formSubscribe.attr('action');

    $.ajax({
        url:url,
        data:val,
        method:'POST',
        success:function (data) {
            if (data.tag){
                subscribeFeedback.addClass('badge-success').html(`<strong>${data.msg}</strong>`);
            }else {
                subscribeFeedback.addClass('badge-danger').html(`<strong>${data.msg}</strong>`);
            }
        },
    })
})
