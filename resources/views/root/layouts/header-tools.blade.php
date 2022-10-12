<!--header start-->
<header id="stickyheader" class="header-style2">
    <div class="mobile-fix-option"></div>
    <div class="top-header2">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="top-header-left">
                        <ul>
                            <li><a href="javascript:void(0)">bigdeal ecommerce always
                                    free delevery</a>
                            </li>
                            <li><a href="javascript:void(0)">
                                    <i class="fa fa-phone"></i>Call Us:
                                    123 - 456 - 7890</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="top-header-right">
                        <ul>
                            <li onclick="openWishlist()">
                                <a href="javascript:void(0)"><i class="fa fa-heart"></i> wishlist</a>
                            </li>
                            <li onclick="openAccount()"><a href="javascript:void(0)"><i class="fa fa-user"></i> my
                                    profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header7">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="header-contain">
                        <div class="logo-block">
                            <div class="mobilecat-toggle"><i class="fa fa-bars sidebar-bar"></i></div>
                            <div class="brand-logo logo-sm-center">
                                <a href="{{ route('index') }}">
                                    <img src="{{ env('LOGO_PATH') }}" class="img-fluid" alt="logo" style="max-height: 60px;">
                                </a>
                            </div>
                        </div>
                        <div class="header-search ajax-search the-basics">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <select>
                                        <option>all category</option>
                                        <option>hand tools</option>
                                        <option>kitchen</option>
                                        <option>baby products</option>
                                        <option>Gardening Tools</option>
                                        <option>Fireplace tools</option>
                                        <option>Gutter cleaning</option>
                                    </select>
                                </div>
                                <input type="search" class="form-control typeahead" placeholder="Search a Product">
                                <div class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                        </div>
                        <div class="icon-block">
                            <ul class="theme-color">
                                <li class="mobile-search icon-md-block">
                                    <svg enable-background="new 0 0 512.002 512.002"
                                         viewBox="0 0 512.002 512.002" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path d="m495.594
                                          416.408-134.086-134.095c14.685-27.49 22.492-58.333 22.492-90.312
                                          0-50.518-19.461-98.217-54.8-134.31-35.283-36.036-82.45-56.505-132.808-57.636-1.46-.033-2.92-.054-4.392-.054-105.869
                                          0-192 86.131-192 192s86.131 192 192 192c1.459 0 2.93-.021 4.377-.054
                                          30.456-.68 59.739-8.444 85.936-22.436l134.085 134.075c10.57 10.584 24.634
                                          16.414 39.601 16.414s29.031-5.83 39.589-16.403c10.584-10.577 16.413-24.639
                                          16.413-39.597s-5.827-29.019-16.407-39.592zm-299.932-64.453c-1.211.027-2.441.046-3.662.046-88.224
                                          0-160-71.776-160-160s71.776-160 160-160c1.229 0 2.449.019 3.671.046 86.2 1.935
                                          156.329 73.69 156.329 159.954 0 86.274-70.133 158.029-156.338 159.954z"/>
                                            <path d="m192 320.001c-70.58 0-128-57.42-128-128s57.42-128 128-128 128 57.42 128
                                          128-57.42 128-128 128z"/>
                                        </g>
                                    </svg>
                                </li>
                                <li class="mobile-user icon-desk-none" onclick="openAccount()">
                                    <svg version="1.1"
                                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         x="0px" y="0px"
                                         viewBox="0 0 512 512" style="enable-background:new 0 0 512
                                    512;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path
                                                d="M255.999,0c-74.443,0-135,60.557-135,135s60.557,135,135,135s135-60.557,135-135S330.442,0,255.999,0z"/>
                                        </g>
                                    </g>
                                        <g>
                                            <g>
                                                <path
                                                    d="M478.48,398.68C438.124,338.138,370.579,302,297.835,302h-83.672c-72.744,0-140.288,36.138-180.644,96.68l-2.52,3.779V512h450h0.001V402.459L478.48,398.68z"/>
                                            </g>
                                        </g>
                                 </svg>
                                </li>
                                <li class="mobile-wishlist item-count icon-desk-none" onclick="openWishlist()">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         x="0px" y="0px" viewBox="0 0 512
                                    512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M376,30c-27.783,0-53.255,8.804-75.707,26.168c-21.525,16.647-35.856,37.85-44.293,53.268
                                             c-8.437-15.419-22.768-36.621-44.293-53.268C189.255,38.804,163.783,30,136,30C58.468,30,0,93.417,0,177.514
                                             c0,90.854,72.943,153.015,183.369,247.118c18.752,15.981,40.007,34.095,62.099,53.414C248.38,480.596,252.12,482,256,482
                                             s7.62-1.404,10.532-3.953c22.094-19.322,43.348-37.435,62.111-53.425C439.057,330.529,512,268.368,512,177.514
                                             C512,93.417,453.532,30,376,30z"/>
                                        </g>
                                    </g>
                                 </svg>
                                    <div class="item-count-contain inverce"> 1</div>
                                </li>
                                <li class="mobile-cart
                                 item-count" onclick="openCart()">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 512 512" style="enable-background:new 0 0 512
                                    512;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M443.209,442.24l-27.296-299.68c-0.736-8.256-7.648-14.56-15.936-14.56h-48V96c0-25.728-9.984-49.856-28.064-67.936
                                             C306.121,10.24,281.353,0,255.977,0c-52.928,0-96,43.072-96,96v32h-48c-8.288,0-15.2,6.304-15.936,14.56L68.809,442.208
                                             c-1.632,17.888,4.384,35.712,16.48,48.96S114.601,512,132.553,512h246.88c17.92,0,35.136-7.584,47.232-20.8
                                             C438.793,477.952,444.777,460.096,443.209,442.24z
                                             M319.977,128h-128V96c0-35.296,28.704-64,64-64
                                             c16.96,0,33.472,6.784,45.312,18.656C313.353,62.72,319.977,78.816,319.977,96V128z"/>
                                        </g>
                                    </g>
                                 </svg>
                                    <div class="item-count-contain inverce"> 3</div>
                                </li>
                            </ul>
                            <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="searchbar-input">
            <div class="input-group">
                <div class="input-group-append">
                     <span class="input-group-text">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px" width="28.931px" height="28.932px" viewBox="0 0 28.931 28.932"
                             style="enable-background:new 0 0 28.931 28.932;" xml:space="preserve">
                           <g>
                              <path
                                  d="M28.344,25.518l-6.114-6.115c1.486-2.067,2.303-4.537,2.303-7.137c0-3.275-1.275-6.355-3.594-8.672C18.625,1.278,15.543,0,12.266,0C8.99,0,5.909,1.275,3.593,3.594C1.277,5.909,0.001,8.99,0.001,12.266c0,3.276,1.275,6.356,3.592,8.674c2.316,2.316,5.396,3.594,8.673,3.594c2.599,0,5.067-0.813,7.136-2.303l6.114,6.115c0.392,0.391,0.902,0.586,1.414,0.586c0.513,0,1.024-0.195,1.414-0.586C29.125,27.564,29.125,26.299,28.344,25.518z M6.422,18.111c-1.562-1.562-2.421-3.639-2.421-5.846S4.86,7.983,6.422,6.421c1.561-1.562,3.636-2.422,5.844-2.422s4.284,0.86,5.845,2.422c1.562,1.562,2.422,3.638,2.422,5.845s-0.859,4.283-2.422,5.846c-1.562,1.562-3.636,2.42-5.845,2.42S7.981,19.672,6.422,18.111z"/>
                           </g>
                        </svg>
                     </span>
                </div>
                <input type="text" class="form-control" placeholder="search your product">
                <div class="input-group-append">
                     <span class="input-group-text close-searchbar">
                        <svg viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg">
                           <path
                               d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/>
                        </svg>
                     </span>
                </div>
            </div>
        </div>
    </div>
    <div class="category-header7">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="category-contain">
                        <div class="category-left">
                            <div class="header-category3">
                                <a class="category-toggle "><i class="ti-layout-grid2-alt"></i>Shop by category</a>
                                <div class="category-heandle open">
                                    <div class="heandle-left">
                                        <div class="point"></div>
                                    </div>
                                    <div class="heandle-right">
                                        <div class="point"></div>
                                    </div>
                                </div>
                                <ul class="collapse-category open">
                                    <li class="back-btn"><i class="fa fa-angle-left"></i> back</li>
                                    <li class="categoryone cat-toogle">
                                        <a href="javascript:void(0)" class="cat-title">hand tools
                                            <span class="arrow"></span></a>
                                        <ul class="collapse-two sub-collapse">
                                            <li><a href="category-page(left-sidebar).html">ladders</a></li>
                                            <li class="categorytwo cat-toogle">
                                                <a href="javascript:void(0)" class="cat-title">hammers<span
                                                        class="arrow"></span></a>
                                                <ul class="collapse-third sub-collapse">
                                                    <li><a href="category-page(left-sidebar).html">claw hammer</a></li>
                                                    <li><a href="category-page(left-sidebar).html">ball pein</a></li>
                                                    <li><a href="category-page(left-sidebar).html">club hammer</a></li>
                                                    <li><a href="category-page(left-sidebar).html">sledge hammer</a>
                                                    </li>
                                                    <li><a href="category-page(left-sidebar).html"> blocking hammer</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="category-page(left-sidebar).html">wrenches</a></li>
                                            <li><a href="category-page(left-sidebar).html">clamps</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="category-page(left-sidebar).html">beauty</a></li>
                                    <li><a href="category-page(left-sidebar).html">kitchen</a></li>
                                    <li><a href="category-page(left-sidebar).html">sports </a></li>
                                    <li><a href="category-page(left-sidebar).html">toys</a></li>
                                    <li><a href="category-page(left-sidebar).html">baby products</a></li>
                                    <li class="categoryone">
                                        <a href="javascript:void(0)" class="cat-title">Power Tools<span
                                                class="arrow"></span></a>
                                        <div class="collapse-mega">
                                            <div class="mega-box">
                                                <h5>marble cutter<span class="sub-arrow"></span></h5>
                                                <ul>
                                                    <li><a href="category-page(left-sidebar).html">Planet Power Hammer
                                                            Series Cutter</a></li>
                                                    <li><a href="category-page(left-sidebar).html">PowerHouse 110 mm
                                                            Marble Cutter</a></li>
                                                    <li><a href="category-page(left-sidebar).html">IB Basics Combo of 4
                                                            inch Marble Cutter </a></li>
                                                    <li><a href="category-page(left-sidebar).html">Dewalt DW862 Heavy
                                                            Duty Tile cutter 1270 </a></li>
                                                    <li><a href="category-page(left-sidebar).html">Ultrafast Marble
                                                            Cutter</a></li>
                                                </ul>
                                            </div>
                                            <div class="mega-box">
                                                <h5>Drill <span class="sub-arrow"></span></h5>
                                                <ul>
                                                    <li><a href="category-page(left-sidebar).html">Cheston 10mm Powerful
                                                            Drill Machine</a></li>
                                                    <li><a href="category-page(left-sidebar).html">Cheston Rotary Hammer
                                                            Drill Machine</a></li>
                                                    <li><a href="category-page(left-sidebar).html">Golden Bullet HI93
                                                            600W 13mm Reversible Impact Drill</a></li>
                                                    <li><a href="category-page(left-sidebar).html">Goldtech 10Mm
                                                            Powerful Heavy Copper Winding Electric Drill Machine</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="mega-box">
                                                <h5>kids <span class="sub-arrow"></span></h5>
                                                <ul>
                                                    <li><a href="category-page(left-sidebar).html">Rotary Screw
                                                            Compressor</a></li>
                                                    <li><a href="category-page(left-sidebar).html">Reciprocating Air
                                                            Compressor</a></li>
                                                    <li><a href="category-page(left-sidebar).html">Axial Compressor</a>
                                                    </li>
                                                    <li><a href="category-page(left-sidebar).html">Centrifugal
                                                            Compressor</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="category-page(left-sidebar).html">Fasteners</a></li>
                                    <li><a href="category-page(left-sidebar).html">Gardening Tools</a>
                                    </li>
                                    <li><a href="category-page(left-sidebar).html">Tile flooring</a></li>
                                    <li><a href="category-page(left-sidebar).html">Fireplace tools</a></li>
                                    <li><a href="category-page(left-sidebar).html">Drywall tools</a></li>
                                    <li><a href="category-page(left-sidebar).html"> Gutter cleaning</a>
                                    </li>
                                    <li><a href="category-page(left-sidebar).html"> Plumbing tools</a></li>
                                </ul>
                            </div>
                            <div class="logo-block">
                                <div class="mobilecat-toggle"><i class="fa fa-bars sidebar-bar"></i></div>
                                <div class="brand-logo logo-sm-center">
                                    <a href="{{ route('index') }}">
                                        <img src="{{ env('LOGO_PATH') }}" class="img-fluid" alt="logo" style="max-height: 60px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="category-right">
                            <div class="menu-block">
                                <nav id="main-nav">
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                    <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                        <li>
                                            <div class="mobile-back text-right">Back<i class="fa fa-angle-right ps-2"
                                                                                       aria-hidden="true"></i></div>
                                        </li>
                                        <!--HOME-->
                                        <li>
                                            <a class="dark-menu-item" href="javascript:void(0)">Home</a>
                                            <ul>
                                                <li><a href="{{route('index')}}">mega store 1</a></li>
                                                <li><a href="{{asset('layout-2.html')}}">mega store 2</a></li>
                                                <li><a href="{{asset('layout-3.html')}}">mega store 3</a></li>
                                                <li><a href="{{asset('layout-4.html')}}">mega store 4</a></li>
                                                <li><a href="{{asset('megastore.html')}}">mega store 5</a></li>
                                                <li><a href="{{asset('layout-5.html')}}">electronics</a></li>
                                                <li><a href="{{asset('layout-6.html')}}">vegetable</a></li>
                                                <li><a href="{{asset('furniture.html')}}">furniture</a></li>
                                                <li><a href="{{asset('cosmetic.html')}}">cosmetic</a></li>
                                                <li><a href="{{asset('kids.html')}}">kids</a></li>
                                                <li><a href="{{asset('tools.html')}}">tools</a></li>
                                                <li><a href="{{asset('grocery.html')}}">grocery</a></li>
                                                <li><a href="{{asset('pets.html')}}">pets</a></li>
                                                <li><a href="{{asset('farming.html')}}">farming</a></li>
                                                <li><a href="{{asset('digital-marketplace.html')}}">digital
                                                        marketplace</a></li>
                                            </ul>
                                        </li>
                                        <!--HOME-END-->
                                        <!--SHOP-->
                                        <li>
                                            <a class="dark-menu-item" href="javascript:void(0)">shop</a>
                                            <ul>
                                                <li><a href="category-page(left-sidebar).html">left sidebar</a></li>
                                                <li><a href="category-page(right-sidebar).html">right sidebar</a></li>
                                                <li><a href="category-page(no-sidebar).html">no sidebar</a></li>
                                                <li><a href="category-page(sidebar-popup).html">sidebar popup</a></li>
                                                <li><a href="category-page(metro).html">metro </a></li>
                                                <li><a href="category-page(full-width).html">full width </a></li>
                                                <li><a href="category-page(infinite-scroll).html">infinite scroll</a>
                                                </li>
                                                <li><a href=category-page(3-grid).html>3 grid</a></li>
                                                <li><a href="category-page(6-grid).html">6 grid</a></li>
                                                <li><a href="category-page(list-view).html">list view</a></li>
                                            </ul>
                                        </li>
                                        <!--SHOP-END-->
                                        <!--product-meu start-->
                                        <li class="mega"><a class="dark-menu-item" href="javascript:void(0)">product
                                            </a>
                                            <ul class="mega-menu full-mega-menu ">
                                                <li>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col mega-box">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <h5>sidebar</h5>
                                                                    </div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="product-page(left-sidebar).html">left
                                                                                    sidebar</a></li>
                                                                            <li>
                                                                                <a href="product-page(right-sidebar).html">right
                                                                                    sidebar</a></li>
                                                                            <li><a href="product-page(no-sidebar).html">non
                                                                                    sidebar</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col mega-box">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <h5>bonus layout</h5>
                                                                    </div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                            <li><a href="product-page(bundle).html">bundle</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="product-page(image-swatch).html">image
                                                                                    swatch</a></li>
                                                                            <li>
                                                                                <a href="product-page(vertical-tab).html">vertical
                                                                                    tab</a></li>
                                                                            <li>
                                                                                <a href="product-page(video-thumbnail).html">video
                                                                                    thumbnail</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col mega-box">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <h5>product layout </h5>
                                                                    </div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                            <li><a href="product-page(4-image).html">4
                                                                                    image </a></li>
                                                                            <li><a href="product-page(sticky).html">sticky</a>
                                                                            </li>
                                                                            <li><a href="product-page(accordian).html">accordian</a>
                                                                            </li>
                                                                            <li><a href="product-page(360-view).html">360
                                                                                    view</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col mega-box">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <h5>thumbnail image</h5>
                                                                    </div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                            <li><a href="product-page(left-image).html">left
                                                                                    image</a></li>
                                                                            <li>
                                                                                <a href="product-page(right-image).html">right
                                                                                    image</a></li>
                                                                            <li>
                                                                                <a href="product-page(image-outside).html">image
                                                                                    outside</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col mega-box">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <h5>3 column</h5>
                                                                    </div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                            <li><a href="product-page(3-col-left).html">thumbnail
                                                                                    left</a></li>
                                                                            <li>
                                                                                <a href="product-page(3-col-right).html">thumbnail
                                                                                    right</a></li>
                                                                            <li><a href="product-page(3-column).html">thubnail
                                                                                    bottom</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col mega-box">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <h5>product element</h5>
                                                                    </div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="{{asset('element-productbox.html')}}">product
                                                                                    box</a></li>
                                                                            <li>
                                                                                <a href="{{asset('element-product-slider.html')}}">product
                                                                                    slider</a></li>
                                                                            <li><a href="element-no_slider.html">no
                                                                                    slider</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row menu-banner">
                                                            <div class="col-lg-6">
                                                                <div>
                                                                    <img
                                                                        src="{{asset('assets/images/menu-banner/1.jpg')}}"
                                                                        alt="menu-banner" class="img-fluid">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div>
                                                                    <img
                                                                        src="{{asset('assets/images/menu-banner/2.jpg')}}"
                                                                        alt="menu-banner" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <!--product-meu end-->

                                        <!--mega-meu start-->
                                        <li class="mega">
                                            <a class="dark-menu-item" href="javascript:void(0)">features</a>
                                            <ul class="mega-menu full-mega-menu ratio_landscape">
                                                <li>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col mega-box">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <h5>portfolio</h5></div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                            <li><a href="{{asset('grid-2-col.html')}}">portfolio
                                                                                    grid
                                                                                    2</a></li>
                                                                            <li><a href="{{asset('grid-3-col.html')}}">portfolio
                                                                                    grid
                                                                                    3</a></li>
                                                                            <li><a href="{{asset('grid-4-col.html')}}">portfolio
                                                                                    grid
                                                                                    4</a></li>
                                                                            <li><a href="{{asset('grid-6-col.html')}}">portfolio
                                                                                    grid
                                                                                    6</a></li>
                                                                            <li>
                                                                                <a href="{{asset('masonary-2-grid.html')}}">mesonary
                                                                                    grid 2</a></li>
                                                                            <li>
                                                                                <a href="{{asset('masonary-3-grid.html')}}">mesonary
                                                                                    grid 3</a></li>
                                                                            <li>
                                                                                <a href="{{asset('masonary-4-grid.html')}}">mesonary
                                                                                    grid 4</a></li>
                                                                            <li>
                                                                                <a href="{{asset('masonary-fullwidth.html')}}">mesonary
                                                                                    full width</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col mega-box">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <h5>add to cart</h5></div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                            <li><a href="{{asset('layout-5.html')}}">cart
                                                                                    modal
                                                                                    popup</a></li>
                                                                            <li><a href="{{asset('layout-6.html')}}">qty.
                                                                                    counter </a></li>
                                                                            <li><a href="{{route('index')}}">cart
                                                                                    top</a></li>
                                                                            <li><a href="{{asset('layout-2.html')}}">cart
                                                                                    bottom</a>
                                                                            </li>
                                                                            <li><a href="{{asset('layout-3.html')}}">cart
                                                                                    left</a>
                                                                            </li>
                                                                            <li><a href="{{asset('layout-4.html')}}">cart
                                                                                    right</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col mega-box">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <h5>shortcodes</h5></div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="{{asset('element-title.html')}}">title</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{asset('element-banner.html')}}">collection
                                                                                    banner</a></li>
                                                                            <li>
                                                                                <a href="{{asset('element-category.html')}}">category</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{asset('element-service.html')}}">service</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{asset('element-image-ratio.html')}}">image
                                                                                    size ratio</a></li>
                                                                            <li><a href="{{asset('element-tab.html')}}">tab</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{asset('element-counter.html')}}">counter</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{asset('element-pricingtable.html')}}">pricing
                                                                                    table</a></li>
                                                                            <li>
                                                                                <a href="{{asset('element-team.html')}}">team</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{asset('element-testimonial.html')}}">testimonial</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col mega-box">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <h5>email template</h5>
                                                                    </div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="{{asset('../email-template/email-order-success.html')}}">order
                                                                                    success</a></li>
                                                                            <li>
                                                                                <a href="{{asset('../email-template/email-order-success-tow.html')}}">order
                                                                                    success 2</a></li>
                                                                            <li>
                                                                                <a href="{{asset('../email-template/email-template.html')}}">email
                                                                                    template</a></li>
                                                                            <li>
                                                                                <a href="{{asset('../email-template/email-template-tow.html')}}">email
                                                                                    template 2</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="menu-title menu-secon-title">
                                                                        <h5>Easy to use</h5>
                                                                    </div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                            <li><a href="{{asset('button.html')}}">element
                                                                                    button</a>
                                                                            </li>
                                                                            <li><a href="{{asset('instagram.html')}}">element
                                                                                    instagram</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col mega-box product ">
                                                                <div class="mega-img">
                                                                    <img
                                                                        src="{{asset('assets/images/menu-banner/3.jpg')}}"
                                                                        alt="menu-banner" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <!--mega-meu end-->

                                        <!--pages meu start-->
                                        <li>
                                            <a class="dark-menu-item" href="javascript:void(0)">pages</a>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">invoice<span class="new-tag">new</span></a>
                                                    <ul>
                                                        <li>
                                                            <a href="{{asset('../invoice-template/element-invoice.html')}}">invoice
                                                                one</a></li>
                                                        <li>
                                                            <a href="{{asset('../invoice-template/element-invoice2.html')}}">invoice
                                                                two</a></li>
                                                        <li>
                                                            <a href="{{asset('../invoice-template/element-invoice3.html')}}">invoice
                                                                three</a></li>
                                                        <li>
                                                            <a href="{{asset('../invoice-template/element-invoice4.html')}}">invoice
                                                                four</a></li>
                                                        <li>
                                                            <a href="{{asset('../invoice-template/element-invoice5.html')}}">invoice
                                                                five</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">account</a>
                                                    <ul>
                                                        <li><a href="{{asset('wishlist.html')}}">wishlist</a></li>
                                                        <li><a href="{{asset('cart.html')}}">cart</a></li>
                                                        <li><a href="{{asset('dashboard.html')}}">Dashboard</a></li>
                                                        <li><a href="{{asset('login.html')}}">login</a></li>
                                                        <li><a href="{{asset('register.html')}}">register</a></li>
                                                        <li><a href="{{asset('contact.html')}}">contact</a></li>
                                                        <li><a href="{{asset('forget-pwd.html')}}">forget password</a>
                                                        </li>
                                                        <li><a href="{{asset('profile.html')}}">profile </a></li>
                                                        <li>
                                                            <a href="javascript:void(0)">checkout</a>
                                                            <ul>
                                                                <li><a href="{{asset('checkout.html')}}">checkout 1</a>
                                                                </li>
                                                                <li><a href="{{asset('checkout2.html')}}">checkout
                                                                        2<span
                                                                            class="new-tag">new</span></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{asset('about-page.html')}}">about us</a></li>
                                                <li><a href="{{asset('search.html')}}">search</a></li>
                                                <li><a href="{{asset('typography.html')}}">typography </a></li>
                                                <li><a href="{{asset('review.html')}}">review </a></li>
                                                <li><a href="{{asset('order-success.html')}}">order success</a></li>
                                                <li><a href="{{asset('order-history.html')}}">order history</a></li>
                                                <li><a href="{{asset('order-tracking.html')}}">order tracking</a></li>
                                                <li>
                                                    <a href="javascript:void(0)">compare</a>
                                                    <ul>
                                                        <li><a href="{{asset('compare.html')}}">compare</a></li>
                                                        <li><a href="{{asset('compare-2.html')}}">compare-2</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{asset('collection.html')}}">collection</a></li>
                                                <li><a href="{{asset('look-book.html')}}">lookbook</a></li>
                                                <li><a href="{{asset('404.html')}}">404</a></li>
                                                <li><a href="{{asset('coming-soon.html')}}">coming soon </a></li>
                                                <li><a href="{{asset('faq.html')}}">FAQ</a></li>
                                            </ul>
                                        </li>
                                        <!--product-end end-->

                                        <!--blog-meu start-->
                                        <li>
                                            <a class="dark-menu-item" href="javascript:void(0)">blog</a>
                                            <ul>
                                                <li><a href="blog(left-sidebar).html">left sidebar</a></li>
                                                <li><a href="blog(right-sidebar).html">right sidebar</a></li>
                                                <li><a href="blog(no-sidebar).html">no sidebar</a></li>
                                                <li><a href="{{asset('blog-details.html')}}">blog details</a></li>
                                                <li><a href="blog-creative(left-sidebar).html">creative left sidebar</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <!--blog-meu end-->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="icon-block">
                            <ul class="theme-color">
                                <li class="mobile-search icon-md-block">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 612.01 612.01" style="enable-background:new 0 0 612.01 612.01;"
                                         xml:space="preserve">
                          <g>
                              <g id="_x34__4_">
                                  <g>
                                      <path d="M606.209,578.714L448.198,423.228C489.576,378.272,515,318.817,515,253.393C514.98,113.439,399.704,0,257.493,0
                                  C115.282,0,0.006,113.439,0.006,253.393s115.276,253.393,257.487,253.393c61.445,0,117.801-21.253,162.068-56.586
                                  l158.624,156.099c7.729,7.614,20.277,7.614,28.006,0C613.938,598.686,613.938,586.328,606.209,578.714z M257.493,467.8
                                  c-120.326,0-217.869-95.993-217.869-214.407S137.167,38.986,257.493,38.986c120.327,0,217.869,95.993,217.869,214.407
                                  S377.82,467.8,257.493,467.8z"/>
                                  </g>
                              </g>
                          </g>
                        </svg>
                                </li>
                                <li class="mobile-user icon-desk-none" onclick="openAccount()">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 480 480" style="enable-background:new 0 0 480 480;"
                                         xml:space="preserve">
                          <g>
                              <g>
                                  <path d="M386.816,323.456l-69.984-14.016c-7.424-1.472-12.832-8.064-12.832-15.68v-16.064c4.608-6.4,8.928-14.944,13.408-23.872
                                c3.424-6.752,8.576-16.928,10.88-19.328c13.568-13.28,28.032-29.76,32.448-51.232c4-19.456,0-29.568-4.64-37.568
                                c0-15.648,0-44.288-5.44-64.928c-0.544-24.928-5.12-39.008-16.608-51.552c-8.128-8.768-20.096-10.816-29.696-12.448
                                c-3.808-0.64-9.024-1.536-10.848-2.528C276.896,5.056,260.032,0.512,239.392,0c-42.24,1.6-94.08,28.384-111.424,76.544
                                c-5.28,14.624-4.768,38.624-4.384,57.92l-0.448,11.232c-4.064,8-8.064,18.112-4.032,37.536
                                c4.416,21.568,18.88,38.016,32.384,51.232c2.336,2.432,7.552,12.672,11.008,19.424c4.544,8.896,8.896,17.44,13.504,23.84v16.032
                                c0,7.616-5.408,14.208-12.864,15.68l-69.984,14.016C48.448,332.384,16,371.968,16,417.568V448c0,17.632,14.368,32,32,32h384
                                c17.632,0,32-14.368,32-32v-30.432C464,371.968,431.552,332.384,386.816,323.456z M432,448H48v-30.432
                                c0-30.4,21.632-56.8,51.456-62.752l69.952-14.016C191.776,336.384,208,316.576,208,293.76V272c0-4.288-1.728-8.416-4.768-11.392
                                c-2.752-2.688-8.672-14.336-12.224-21.28c-6.016-11.776-11.2-21.952-17.12-27.712c-10.624-10.368-20.768-21.76-23.456-34.816
                                c-2.08-10.112-0.64-12.96,1.216-16.576c1.632-3.2,4.064-8,4.064-14.528l-0.16-11.872c-0.288-13.984-0.768-37.408,2.496-46.432
                                C170.464,52.96,209.856,33.152,239.584,32c14.656,0.384,26.176,3.424,38.4,10.24c6.592,3.648,14.272,4.928,21.024,6.08
                                c3.808,0.64,10.176,1.728,11.488,2.56c4.32,4.704,7.904,10.368,8.16,32.384c0,1.44,0.224,2.88,0.64,4.288
                                c4.768,16.352,4.768,44.576,4.768,58.144c0,6.528,2.464,11.328,4.064,14.528c1.856,3.616,3.296,6.464,1.216,16.608
                                c-2.656,12.992-12.864,24.416-23.456,34.784c-5.952,5.824-11.104,16-17.056,27.808c-3.456,6.912-9.312,18.496-12.032,21.152
                                c-3.072,3.008-4.8,7.136-4.8,11.424v21.76c0,22.816,16.224,42.624,38.592,47.072l69.984,14.016
                                c29.792,5.92,51.424,32.32,51.424,62.72V448z"/>
                              </g>
                          </g>
                        </svg>
                                </li>
                                <li class="mobile-wishlist item-count icon-desk-none" onclick="openWishlist()">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                         xml:space="preserve">
                          <g>
                              <g>
                                  <path d="M474.644,74.27C449.391,45.616,414.358,29.836,376,29.836c-53.948,0-88.103,32.22-107.255,59.25
                                c-4.969,7.014-9.196,14.047-12.745,20.665c-3.549-6.618-7.775-13.651-12.745-20.665c-19.152-27.03-53.307-59.25-107.255-59.25
                                c-38.358,0-73.391,15.781-98.645,44.435C13.267,101.605,0,138.213,0,177.351c0,42.603,16.633,82.228,52.345,124.7
                                c31.917,37.96,77.834,77.088,131.005,122.397c19.813,16.884,40.302,34.344,62.115,53.429l0.655,0.574
                                c2.828,2.476,6.354,3.713,9.88,3.713s7.052-1.238,9.88-3.713l0.655-0.574c21.813-19.085,42.302-36.544,62.118-53.431
                                c53.168-45.306,99.085-84.434,131.002-122.395C495.367,259.578,512,219.954,512,177.351
                                C512,138.213,498.733,101.605,474.644,74.27z M309.193,401.614c-17.08,14.554-34.658,29.533-53.193,45.646
                                c-18.534-16.111-36.113-31.091-53.196-45.648C98.745,312.939,30,254.358,30,177.351c0-31.83,10.605-61.394,29.862-83.245
                                C79.34,72.007,106.379,59.836,136,59.836c41.129,0,67.716,25.338,82.776,46.594c13.509,19.064,20.558,38.282,22.962,45.659
                                c2.011,6.175,7.768,10.354,14.262,10.354c6.494,0,12.251-4.179,14.262-10.354c2.404-7.377,9.453-26.595,22.962-45.66
                                c15.06-21.255,41.647-46.593,82.776-46.593c29.621,0,56.66,12.171,76.137,34.27C471.395,115.957,482,145.521,482,177.351
                                C482,254.358,413.255,312.939,309.193,401.614z"/>
                              </g>
                          </g>
                          </svg>
                                    <div class="item-count-contain inverce"> 1</div>
                                </li>
                                <li class="mobile-cart item-count" onclick="openCart()">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 511.999 511.999"
                                         style="enable-background:new 0 0 511.999 511.999;" xml:space="preserve">
                                          <g>
                                              <g>
                                                  <path d="M435.099,29.815h-71.361V0H148.262v29.814H76.901L40.464,181.549H0.008v103.359h30.969l34.508,227.091h381.029
                                                l34.509-227.091h30.968V181.55h-40.456L435.099,29.815z M178.261,29.999h155.477v29.629H178.261V29.999z M100.549,59.813h47.714
                                                v29.814h215.475V59.813h47.714l29.233,121.736H71.316L100.549,59.813z M420.73,482.001H91.27L61.32,284.909h389.36L420.73,482.001
                                                z M481.993,254.91H30.007v-43.361h451.986V254.91z"/>
                                              </g>
                                          </g>
                                        <g>
                                            <g>
                                                <rect x="241.002" y="326.38" width="29.999" height="114.156"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="143.436" y="326.38" width="29.999" height="114.156"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="338.559" y="326.38" width="29.999" height="114.156"/>
                                            </g>
                                        </g>
                        </svg>
                                    <div class="item-count-contain inverce"> 3</div>
                                </li>
                            </ul>
                            <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="searchbar-input ajax-search the-basics">
            <div class="input-group">
           <span class="input-group-text">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                   y="0px" width="28.931px" height="28.932px" viewBox="0 0 28.931 28.932"
                   style="enable-background:new 0 0 28.931 28.932;" xml:space="preserve">
                 <g>
                    <path
                        d="M28.344,25.518l-6.114-6.115c1.486-2.067,2.303-4.537,2.303-7.137c0-3.275-1.275-6.355-3.594-8.672C18.625,1.278,15.543,0,12.266,0C8.99,0,5.909,1.275,3.593,3.594C1.277,5.909,0.001,8.99,0.001,12.266c0,3.276,1.275,6.356,3.592,8.674c2.316,2.316,5.396,3.594,8.673,3.594c2.599,0,5.067-0.813,7.136-2.303l6.114,6.115c0.392,0.391,0.902,0.586,1.414,0.586c0.513,0,1.024-0.195,1.414-0.586C29.125,27.564,29.125,26.299,28.344,25.518z M6.422,18.111c-1.562-1.562-2.421-3.639-2.421-5.846S4.86,7.983,6.422,6.421c1.561-1.562,3.636-2.422,5.844-2.422s4.284,0.86,5.845,2.422c1.562,1.562,2.422,3.638,2.422,5.845s-0.859,4.283-2.422,5.846c-1.562,1.562-3.636,2.42-5.845,2.42S7.981,19.672,6.422,18.111z"/>
                 </g>
              </svg>
           </span>
                <input type="search" class="form-control typeahead" placeholder="Search a Product">
                <span class="input-group-text close-searchbar">
                <svg viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg">
                   <path
                       d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/>
                </svg>
             </span>
            </div>
        </div>
    </div>
</header>
<!--header end-->
