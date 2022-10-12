@extends('root.layouts.app')

@section('stylesheet')
<link href="{{asset('sweetalert.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')

    <!--home slider start-->
    {{--<section class="tools-slide home-slide">
        <div class="slide-1 no-arrow">
            <div>
                <div class="slide-main backanimat">
                    <img src="{{asset('assets/images/slider/back.jpg')}}" class="img-fluid bg-img" alt="tools-slider">
                    <div class="animat-block">
                        <img id="img-1" src="{{asset('assets/images/slider/1.png')}}" class="img-fluid animat1"
                             alt="tools-slider">
                    </div>
                    <div class="custom-container">
                        <div class="row">
                            <div class="col-12 p-0 position-relative">
                                <div class="slide-contain">
                                    <div>
                                        <h2>high quality</h2>
                                        <h3>bigdeal power tools</h3>
                                        <p>In addition to
                                            genuine tool parts, we also supply a wide range of high quality tool parts
                                            from after makers.
                                        </p>
                                        <a href="product-page(left-sidebar).html" class="btn btn-rounded"> Shop Now </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="slide-main backanimat">
                    <img src="{{asset('assets/images/slider/back.jpg')}}" class="img-fluid bg-img" alt="tools-slider">
                    <div class="animat-block">
                        <img id="img-2" src="{{asset('assets/images/slider/2.png')}}" class="img-fluid animat1"
                             alt="tools-slider">
                    </div>
                    <div class="custom-container">
                        <div class="row">
                            <div class="col-12 p-0">
                                <div class="slide-contain">
                                    <div>
                                        <h2>high quality</h2>
                                        <h3>bigdeal power tools</h3>
                                        <p>In addition to
                                            genuine tool parts, we also supply a wide range of high quality tool parts
                                            from after makers.
                                        </p>
                                        <a href="product-page(left-sidebar).html" class="btn btn-rounded"> Shop Now </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="slide-main backanimat">
                    <img src="{{asset('assets/images/slider/back.jpg')}}" class="img-fluid bg-img" alt="tools-slider">
                    <div class="animat-block">
                        <img id="img-3" src="{{asset('assets/images/slider/3.png')}}" class="img-fluid animat1"
                             alt="tools-slider">
                    </div>
                    <div class="custom-container">
                        <div class="row">
                            <div class="col-12 p-0">
                                <div class="slide-contain">
                                    <div>
                                        <h2>high quality</h2>
                                        <h3>bigdeal power tools</h3>
                                        <p>In addition to
                                            genuine tool parts, we also supply a wide range of high quality tool parts
                                            from after makers.
                                        </p>
                                        <a href="product-page(left-sidebar).html" class="btn btn-rounded"> Shop Now </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    <!--home slider end-->

    <!-- services start -->
    {{--<section class="services1 section-pt-space  block">
        <div class="custom-container">
            <div class="row">
                <div class="col-12 pr-0">
                    <div class="services-slide4 no-arrow">
                        <div>
                            <div class="services-box">
                                <div class="media">
                                    <div class="icon-wraper">
                                        <svg enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m23.508.003c-4.685-.084-10.028 2.365-13.41 6.164-3.232.061-6.379 1.386-8.696 3.703-.135.133-.183.332-.124.512.06.181.216.312.404.339l3.854.552-.476.533c-.177.198-.168.499.02.687l6.427 6.427c.097.097.225.146.354.146.119 0 .238-.042.333-.127l.533-.476.552 3.854c.027.188.175.326.354.386.046.015.094.022.143.022.142 0 .287-.062.387-.161 2.285-2.285 3.61-5.432 3.671-8.664 3.803-3.389 6.272-8.73 6.163-13.409-.007-.266-.222-.481-.489-.488zm-4.608 8.632c-.487.487-1.127.731-1.768.731s-1.281-.244-1.768-.731c-.974-.975-.974-2.561 0-3.536.975-.975 2.561-.975 3.536 0s.975 2.562 0 3.536z"/>
                                            <path
                                                d="m2.724 16.905c-1.07 1.07-2.539 5.904-2.703 6.451-.053.176-.004.367.125.497.096.096.223.147.354.147.048 0 .096-.007.144-.021.547-.164 5.381-1.633 6.451-2.703 1.205-1.205 1.205-3.166 0-4.371-1.206-1.205-3.166-1.204-4.371 0z"/>
                                        </svg>
                                    </div>
                                    <div class="media-body">
                                        <h4>free shpping</h4>
                                        <p>Free Shipping World Wide</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="services-box">
                                <div class="media">
                                    <div class="icon-wraper">
                                        <svg viewBox="0 -5 512.00031 512" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m500.21875 277.257812-35.714844-41.15625c-10.683594-12.316406-14.394531-29.199218-9.878906-44.859374l14.304688-49.515626c9.074218-31.441406-15.230469-62.585937-47.9375-61.414062l-54.304688 1.949219c-15.957031.570312-31.15625-6.8125-40.566406-19.699219l-31.277344-42.828125c-19.207031-26.3125-58.480469-26.3125-77.6875 0l-31.277344 42.828125c-9.410156 12.886719-24.609375 20.269531-40.566406 19.699219l-54.304688-1.949219c-32.707031-1.171875-57.011718 29.972656-47.9375 61.414062l14.304688 49.515626c4.515625 15.660156.804688 32.542968-9.878906 44.859374l-35.714844 41.15625c-21.664062 24.96875-12.253906 63.851563 18.421875 76.164063l47.355469 18.996094c15.515625 6.21875 26.691406 20.050781 29.503906 36.527343l9.003906 52.613282c5.625 32.839844 42.113282 50.160156 71.109375 33.746094l45.121094-25.546876c14.710937-8.328124 32.695313-8.328124 47.40625 0l45.121094 25.546876c28.996093 16.414062 65.484375-.90625 71.109375-33.746094l9.003906-52.613282c2.8125-16.476562 13.988281-30.308593 29.503906-36.527343l47.355469-18.996094c30.675781-12.3125 40.085937-51.195313 18.421875-76.164063zm-245.59375-87.882812 40.828125-72.757812c4.140625-7.363282 13.457031-9.980469 20.820313-5.851563 7.371093 4.136719 9.988281 13.457031 5.851562 20.816406l-28.046875 49.996094h17.882813v-7.117187c0-8.449219 6.839843-15.292969 15.292968-15.292969 8.441406 0 15.289063 6.84375 15.289063 15.292969v7.117187h.492187c8.441406 0 15.289063 6.839844 15.289063 15.292969 0 8.441406-6.847657 15.292968-15.289063 15.292968h-.492187v19.511719c0 8.449219-6.847657 15.292969-15.289063 15.292969-8.453125 0-15.292968-6.84375-15.292968-15.292969v-19.511719h-44.003907c-11.617187 0-19.078125-12.554687-13.332031-22.789062zm-113.429688 31.65625c0-16.882812 9.847657-32.488281 25.078126-39.75l30.75-14.660156c7.378906-3.660156 8.65625-10.765625 7.390624-16.21875-.589843-2.578125-3.355468-11.011719-13.652343-11.011719-10.46875 0-18.980469 8.515625-18.980469 18.984375 0 8.441406-6.839844 15.292969-15.292969 15.292969-8.441406 0-15.292969-6.851563-15.292969-15.292969 0-27.332031 22.234376-49.566406 49.566407-49.566406 21.175781 0 38.640625 13.945312 43.453125 34.683594 4.851562 20.929687-4.710938 41.265624-23.796875 50.625-.039063.019531-.089844.042968-.140625.074218l-30.832032 14.699219c-3.210937 1.519531-5.625 4.261719-6.828124 7.492187h47.515624c8.453126 0 15.292969 6.851563 15.292969 15.292969 0 8.453125-6.839843 15.292969-15.292969 15.292969h-63.644531c-8.441406 0-15.292969-6.839844-15.292969-15.292969zm155.613282 113.183594-28.320313 95.78125c-2.390625 8.078125-10.886719 12.726562-19.003906 10.328125-8.09375-2.394531-12.722656-10.898438-10.324219-19.003907l22.507813-76.144531h-37.945313c-8.449218 0-15.292968-6.851562-15.292968-15.292969 0-8.449218 6.84375-15.292968 15.292968-15.292968h58.417969c10.222656 0 17.558594 9.839844 14.667969 19.625zm98.179687-35.261719h-277.976562c-8.449219 0-15.289063-6.839844-15.289063-15.292969 0-8.441406 6.839844-15.292968 15.289063-15.292968h277.976562c8.449219 0 15.289063 6.851562 15.289063 15.292968 0 8.449219-6.839844 15.292969-15.289063 15.292969zm0 0"/>
                                        </svg>
                                    </div>
                                    <div class="media-body">
                                        <h4>24 services</h4>
                                        <p>Online Service For 24
                                            X 7
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="services-box">
                                <div class="media">
                                    <div class="icon-wraper">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 512.003 512.003"
                                             style="enable-background:new 0 0 512.003 512.003;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path
                                                d="M477.958,262.633c-2.06-4.215-2.06-9.049,0-13.263l19.096-39.065c10.632-21.751,2.208-47.676-19.178-59.023l-38.41-20.38 c-4.144-2.198-6.985-6.11-7.796-10.729l-7.512-42.829c-4.183-23.846-26.241-39.87-50.208-36.479l-43.053,6.09 c-4.647,0.656-9.242-0.838-12.613-4.099l-31.251-30.232c-17.401-16.834-44.661-16.835-62.061,0L193.72,42.859 c-3.372,3.262-7.967,4.753-12.613,4.099l-43.053-6.09c-23.975-3.393-46.025,12.633-50.208,36.479l-7.512,42.827 c-0.811,4.62-3.652,8.531-7.795,10.73l-38.41,20.38c-21.386,11.346-29.81,37.273-19.178,59.024l19.095,39.064 c2.06,4.215,2.06,9.049,0,13.263l-19.096,39.064c-10.632,21.751-2.208,47.676,19.178,59.023l38.41,20.38 c4.144,2.198,6.985,6.11,7.796,10.729l7.512,42.829c3.808,21.708,22.422,36.932,43.815,36.93c2.107,0,4.245-0.148,6.394-0.452 l43.053-6.09c4.643-0.659,9.241,0.838,12.613,4.099l31.251,30.232c8.702,8.418,19.864,12.626,31.03,12.625 c11.163-0.001,22.332-4.209,31.03-12.625l31.252-30.232c3.372-3.261,7.968-4.751,12.613-4.099l43.053,6.09 c23.978,3.392,46.025-12.633,50.208-36.479l7.513-42.827c0.811-4.62,3.652-8.531,7.795-10.73l38.41-20.38 c21.386-11.346,29.81-37.273,19.178-59.024L477.958,262.633z M196.941,123.116c29.852,0,54.139,24.287,54.139,54.139 s-24.287,54.139-54.139,54.139s-54.139-24.287-54.139-54.139S167.089,123.116,196.941,123.116z M168.997,363.886 c-2.883,2.883-6.662,4.325-10.44,4.325s-7.558-1.441-10.44-4.325c-5.766-5.766-5.766-15.115,0-20.881l194.889-194.889 c5.765-5.766,15.115-5.766,20.881,0c5.766,5.766,5.766,15.115,0,20.881L168.997,363.886z M315.061,388.888 c-29.852,0-54.139-24.287-54.139-54.139s24.287-54.139,54.139-54.139c29.852,0,54.139,24.287,54.139,54.139 S344.913,388.888,315.061,388.888z"/>
                                        </g>
                                    </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M315.061,310.141c-13.569,0-24.609,11.039-24.609,24.608s11.039,24.608,24.609,24.608 c13.569,0,24.608-11.039,24.608-24.608S328.63,310.141,315.061,310.141z"/>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M196.941,152.646c-13.569,0-24.608,11.039-24.608,24.608c0,13.569,11.039,24.609,24.608,24.609 c13.569,0,24.609-11.039,24.609-24.609C221.549,163.686,210.51,152.646,196.941,152.646z"/>
                                                </g>
                                            </g>
                                 </svg>
                                    </div>
                                    <div class="media-body">
                                        <h4>festival offer</h4>
                                        <p>New Online
                                            Special Festival Offer
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="services-box">
                                <div class="media">
                                    <div class="icon-wraper">
                                        <svg enable-background="new 0 0 480 480" viewBox="0 0 480 480"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m444.967 360.527c4.432-.022 8.033 3.567 8.033 8v70.973c0 22.091-17.909 40-40 40h-373c-22.091 0-40-17.909-40-40v-298c0-22.091 17.909-40 40-40h373c22.091 0 40 17.909 40 40v71.001c0 4.431-3.595 8.018-8.026 8-8.322-.034-27.356-.001-73.965-.001-26.51 0-48.009 21.49-48.009 48v44.001c0 26.509 21.492 47.999 48.002 47.999 47.302 0 65.816.067 73.965.027zm35.033-92.027v44c0 17.689-14.404 32-31.98 32h-77.02c-17.64 0-32-14.35-32-32v-44c0-17.65 14.36-32 32-32h77c17.64 0 32 14.35 32 32zm-79 22c0-4.418-3.582-8-8-8h-12c-4.418 0-8 3.582-8 8s3.582 8 8 8h12c4.418 0 8-3.582 8-8zm-20.4-239.03-7.457-2.196c-3.139-.924-6.528.156-8.553 2.726-6.074 7.708-10.711 15.693-11.48 24.837-.392 4.663 3.3 8.663 7.979 8.663h34.155c4.987 0 8.837-4.528 7.877-9.422-2.21-11.259-10.493-21.144-22.521-24.608zm-43.585 26.258c.296-9.504 3.407-17.969 8.391-26.157 2.728-4.481.455-10.331-4.577-11.812l-50.727-14.937c-4.913-1.447-10.108 2.115-10.102 7.678v45c0 4.418 3.582 8 8 8h41.025c4.329 0 7.855-3.446 7.99-7.772zm-197.015 7.772h11c4.418 0 8-3.582 8-8v-69c0-4.418-3.582-8-8-8h-11c-4.418 0-8 3.582-8 8v69c0 4.418 3.582 8 8 8zm92-85h-49c-4.418 0-8 3.582-8 8v69c0 4.418 3.582 8 8 8h73c4.418 0 8-3.582 8-8v-45c0-17.65-14.36-32-32-32zm-124 0h-11c-17.673 0-32 14.327-32 32v45c0 4.418 3.582 8 8 8h35c4.418 0 8-3.582 8-8v-69c0-4.418-3.582-8-8-8z"/>
                                        </svg>
                                    </div>
                                    <div class="media-body">
                                        <h4>online payment</h4>
                                        <p>New Online Special
                                            Festival Offer
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="services-box">
                                <div class="media">
                                    <div class="icon-wraper">
                                        <svg viewBox="0 -5 512.00031 512" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m500.21875 277.257812-35.714844-41.15625c-10.683594-12.316406-14.394531-29.199218-9.878906-44.859374l14.304688-49.515626c9.074218-31.441406-15.230469-62.585937-47.9375-61.414062l-54.304688 1.949219c-15.957031.570312-31.15625-6.8125-40.566406-19.699219l-31.277344-42.828125c-19.207031-26.3125-58.480469-26.3125-77.6875 0l-31.277344 42.828125c-9.410156 12.886719-24.609375 20.269531-40.566406 19.699219l-54.304688-1.949219c-32.707031-1.171875-57.011718 29.972656-47.9375 61.414062l14.304688 49.515626c4.515625 15.660156.804688 32.542968-9.878906 44.859374l-35.714844 41.15625c-21.664062 24.96875-12.253906 63.851563 18.421875 76.164063l47.355469 18.996094c15.515625 6.21875 26.691406 20.050781 29.503906 36.527343l9.003906 52.613282c5.625 32.839844 42.113282 50.160156 71.109375 33.746094l45.121094-25.546876c14.710937-8.328124 32.695313-8.328124 47.40625 0l45.121094 25.546876c28.996093 16.414062 65.484375-.90625 71.109375-33.746094l9.003906-52.613282c2.8125-16.476562 13.988281-30.308593 29.503906-36.527343l47.355469-18.996094c30.675781-12.3125 40.085937-51.195313 18.421875-76.164063zm-245.59375-87.882812 40.828125-72.757812c4.140625-7.363282 13.457031-9.980469 20.820313-5.851563 7.371093 4.136719 9.988281 13.457031 5.851562 20.816406l-28.046875 49.996094h17.882813v-7.117187c0-8.449219 6.839843-15.292969 15.292968-15.292969 8.441406 0 15.289063 6.84375 15.289063 15.292969v7.117187h.492187c8.441406 0 15.289063 6.839844 15.289063 15.292969 0 8.441406-6.847657 15.292968-15.289063 15.292968h-.492187v19.511719c0 8.449219-6.847657 15.292969-15.289063 15.292969-8.453125 0-15.292968-6.84375-15.292968-15.292969v-19.511719h-44.003907c-11.617187 0-19.078125-12.554687-13.332031-22.789062zm-113.429688 31.65625c0-16.882812 9.847657-32.488281 25.078126-39.75l30.75-14.660156c7.378906-3.660156 8.65625-10.765625 7.390624-16.21875-.589843-2.578125-3.355468-11.011719-13.652343-11.011719-10.46875 0-18.980469 8.515625-18.980469 18.984375 0 8.441406-6.839844 15.292969-15.292969 15.292969-8.441406 0-15.292969-6.851563-15.292969-15.292969 0-27.332031 22.234376-49.566406 49.566407-49.566406 21.175781 0 38.640625 13.945312 43.453125 34.683594 4.851562 20.929687-4.710938 41.265624-23.796875 50.625-.039063.019531-.089844.042968-.140625.074218l-30.832032 14.699219c-3.210937 1.519531-5.625 4.261719-6.828124 7.492187h47.515624c8.453126 0 15.292969 6.851563 15.292969 15.292969 0 8.453125-6.839843 15.292969-15.292969 15.292969h-63.644531c-8.441406 0-15.292969-6.839844-15.292969-15.292969zm155.613282 113.183594-28.320313 95.78125c-2.390625 8.078125-10.886719 12.726562-19.003906 10.328125-8.09375-2.394531-12.722656-10.898438-10.324219-19.003907l22.507813-76.144531h-37.945313c-8.449218 0-15.292968-6.851562-15.292968-15.292969 0-8.449218 6.84375-15.292968 15.292968-15.292968h58.417969c10.222656 0 17.558594 9.839844 14.667969 19.625zm98.179687-35.261719h-277.976562c-8.449219 0-15.289063-6.839844-15.289063-15.292969 0-8.441406 6.839844-15.292968 15.289063-15.292968h277.976562c8.449219 0 15.289063 6.851562 15.289063 15.292968 0 8.449219-6.839844 15.292969-15.289063 15.292969zm0 0"/>
                                        </svg>
                                    </div>
                                    <div class="media-body">
                                        <h4>24 services</h4>
                                        <p>Online Service For 24
                                            X 7
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    <!-- services end -->

    @if($hotCategories && $hotCategories->count() > 0)
        <!-- category start -->
        <div class="title8 section-big-pt-space">
            <h4>{{__('layouts.trendingCategory')}}</h4>
        </div>

        <!--rounded category start-->
        <section class="rounded-category" style="background-color: #f5f6fb">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="slide-6 no-arrow ">
                            @foreach($hotCategories as $category)
                            <div>
                                <div class="category-contain">
                                    <a href="{{ route('products.index', ['category_id' => $category->id]) }}">
                                        <div class="img-wrapper">
                                            @include('root.components.lazy-image', [
                                                    'url' => $category->icon_url(312, 208),
                                                    'alt' => $category->name,
                                                    'class' => 'img-fluid',
                                                ])
                                        </div>
                                        <div>
                                            <div class="btn-rounded">
                                                {{ $category->name }}
                                            </div>
                                        </div>
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

    <!--collection banner start-->
    {{--<section class="collection-banner section-py-space b-g-white">
        <div class="container-fluid">
            <div class="row
               collection2">
                <div class="col-md-4">
                    <div class="collection-banner-main  p-left text-center banner-style3 banner-13">
                        <div class="collection-img"><img src="{{asset('assets/images/collection-banner/1.jpg')}}"
                                                         class="img-fluid bg-img
                        " alt="banner"></div>
                        <div class="collection-banner-contain ">
                            <div>
                                <h3>best discount </h3>
                                <h4>cordless tools</h4>
                                <a href="product-page(left-sidebar).html" class="btn btn-rounded btn-sm">shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="collection-banner-main banner-style3  p-left text-center banner-13">
                        <div class="collection-img"><img src="{{asset('assets/images/collection-banner/2.jpg')}}"
                                                         class="img-fluid bg-img
                        " alt="banner"></div>
                        <div class="collection-banner-contain ">
                            <div>
                                <h3>up to 50% off</h3>
                                <h4>replaair parts</h4>
                                <a href="product-page(left-sidebar).html" class="btn btn-rounded btn-sm">shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="collection-banner-main banner-style3 p-left text-center banner-13">
                        <div class="collection-img"><img src="{{asset('assets/images/collection-banner/3.jpg')}}"
                                                         class="img-fluid bg-img
                        " alt="banner"></div>
                        <div class="collection-banner-contain ">
                            <div>
                                <h3> great offers</h3>
                                <h4>wood cutter</h4>
                                <a href="product-page(left-sidebar).html" class="btn btn-rounded btn-sm">shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    <!--collection banner end-->

    @if($hotCategories && $hotCategories->count() > 0)
        <!--tab product-->
        <section class="section-py-space">
            <div class="tab-product-main">
                <div class="tab-product-contain">

                    <ul class="tabs tab-title">

                        @foreach($hotCategories as $category)
                            <li @class(['current' => $loop->first])>
                                <a href="#categories-tab-{{$category->id}}"
                                   @if(!$loop->first) data-url="{{ route('categories.tab-view', $category) }}" @endif
                                >{{ $category->name }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </section>
        <section class="ratio_40 section-pb-space ">
            <div class="custom-container product">
                <div class="row">
                    <div class="col pr-0">
                        <div class="theme-tab product ">
                            <div class="tab-content-cls">
                                <button class="btn-light tab-btn-prev">
                                    <i data-feather="chevron-left"></i>
                                </button>
                                @foreach($hotCategories as $category)
                                    <div id="categories-tab-{{$category->id}}"
                                        @class(['active default' => $loop->first, 'tab-content'])>

                                        @if($loop->first)
                                            @include('root.components.category-tab', compact('category'))
                                        @else
                                            <div class="ph-slider product-m">
                                                @for($i = 0; $i< 5; $i++)
                                                    <div>
                                                        <div class="ph-item m-1">
                                                            <div class="ph-col-12">
                                                                <div class="ph-picture"></div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-6 big"></div>
                                                                    <div class="ph-col-4 empty big"></div>
                                                                    <div class="ph-col-2 big"></div>
                                                                    <div class="ph-col-4"></div>
                                                                    <div class="ph-col-8 empty"></div>
                                                                    <div class="ph-col-6"></div>
                                                                    <div class="ph-col-6 empty"></div>
                                                                    <div class="ph-col-12"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        @endif

                                    </div>
                                @endforeach
                                <button class="btn-light tab-btn-next">
                                    <i data-feather="chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--tab product-->
    @endif


    @if($specialProducts && $specialProducts->count() > 0)
        <!--product start-->
        <div class="title8 section-big-pt-space">
            <h4>{{__('layouts.Special_Products')}}</h4>
        </div>
        <section class="product section-big-pb-space">
            <div class="custom-container">
                <div class="row ">
                    <div class="col pr-0 position-relative">
                        <div class="slick-content-class">
                            <button class="btn-light tab-btn-prev">
                                <i data-feather="chevron-left"></i>
                            </button>
                            <div class="product-slider no-arrow">
                                @each('root.components.product-card', $specialProducts, 'product')
                            </div>
                            <button class="btn-light tab-btn-next">
                                <i data-feather="chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--product end-->
    @endif

    @if($topBrands->count())
        <!--title-start-->
        <div class="title8 section-big-pt-space">
            <h4>{{__('layouts.topBrands')}}</h4>
        </div>
        <!--title-end-->

        <!-- brand start -->
        <section class="brand-second section-big-mb-space">
            <div class="container-fluid">
                <div class="row brand-block">
                    <div class="col-12">
                        <div class="brand-slide12 no-arrow mb--5">
                            @foreach($topBrands as $brand)
                                <div>
                                    <div class="brand-box p-2">
                                        @include('root.components.lazy-image', [
                                            'url' => $brand->logo_url(92, 92),
                                            'alt' => $brand->name,
                                            'class' => 'img-fluid',
                                        ])
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- brand start -->

    @endif
    @include('root.components.subscribe')

    <!--title-start-->
    {{--<div class="title8">
        <h4>letest blog</h4>
    </div>--}}
    <!--title-end-->

    <!--blog start-->
    {{--<section class="blog  section-big-pb-space">
        <div class="custom-container">
            <div class="row">
                <div class="col pr-0">
                    <div class="blog-slide-4 no-arrow">
                        <div>
                            <div class="blog-contain">
                                <div class="blog-img">
                                    <a href="{{asset('blog-details.html')}}">
                                        <img src="{{asset('assets/images/blog/1.jpg')}}" alt="blog"
                                             class="img-fluid w-100">
                                    </a>
                                </div>
                                <div class="blog-details-2 text-center">
                                    <a href="{{asset('blog-details.html')}}">
                                        <h4>so you've bought tools ... Now What?</h4>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Curabitur eleifend a massa rhoncus gravida.
                                    </p>
                                    <ul>
                                        <li><a href="javascript:void(0)" tabindex="0"><i class="fa fa-user-md"></i>Donec
                                                lacinia</a></li>
                                        <li><a href="javascript:void(0)" tabindex="0"><i class="fa fa-comments"></i>comants</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="blog-label1">27 <br>nov</div>
                            </div>
                        </div>
                        <div>
                            <div class="blog-contain">
                                <div class="blog-img">
                                    <a href="{{asset('blog-details.html')}}">
                                        <img src="{{asset('assets/images/blog/2.jpg')}}" alt="blog"
                                             class="img-fluid w-100">
                                    </a>
                                </div>
                                <div class="blog-details-2 text-center">
                                    <a href="{{asset('blog-details.html')}}">
                                        <h4>7 Simple Secrets to Totally Rocking Your Tools</h4>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
                                        eleifend a massa rhoncus gravida.
                                    </p>
                                    <ul>
                                        <li><a href="javascript:void(0)" tabindex="0"><i class="fa fa-user-md"></i>Donec
                                                lacinia</a></li>
                                        <li><a href="javascript:void(0)" tabindex="0"><i class="fa fa-comments"></i>comants</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="blog-label1">27 <br>nov</div>
                            </div>
                        </div>
                        <div>
                            <div class="blog-contain">
                                <div class="blog-img">
                                    <a href="{{asset('blog-details.html')}}">
                                        <img src="{{asset('assets/images/blog/3.jpg')}}" alt="blog"
                                             class="img-fluid w-100">
                                    </a>
                                </div>
                                <div class="blog-details-2 text-center">
                                    <a href="{{asset('blog-details.html')}}">
                                        <h4>Meet the Steve Jobs of the Tools Industry</h4>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
                                        eleifend a massa rhoncus gravida.
                                    </p>
                                    <ul>
                                        <li><a href="javascript:void(0)" tabindex="0"><i class="fa fa-user-md"></i>Donec
                                                lacinia</a></li>
                                        <li><a href="javascript:void(0)" tabindex="0"><i class="fa fa-comments"></i>comants</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="blog-label1">27 <br>nov</div>
                            </div>
                        </div>
                        <div>
                            <div class="blog-contain">
                                <div class="blog-img">
                                    <a href="{{asset('blog-details.html')}}">
                                        <img src="{{asset('assets/images/blog/4.jpg')}}" alt="blog"
                                             class="img-fluid w-100">
                                    </a>
                                </div>
                                <div class="blog-details-2 text-center">
                                    <h4>9 Signs You Sell Tools for a Living </h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
                                        eleifend a massa rhoncus gravida.
                                    </p>
                                    <ul>
                                        <li><a href="javascript:void(0)" tabindex="0"><i class="fa fa-user-md"></i>Donec
                                                lacinia</a></li>
                                        <li><a href="javascript:void(0)" tabindex="0"><i class="fa fa-comments"></i>comants</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="blog-label1">27 <br>nov</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    <!--blog end-->
@endsection

@push('scripts')
    <script src="{{asset('/sweetalert.min.js')}}"></script>
    <script async>

        let SendSubscribe  = document.getElementById('sendSubscribe'),
            SubscribeInput = document.getElementById('SubscribeInput'),
            AlertSubscribe = document.getElementById('alertSubscribe')
            SendSubscribe2  = document.getElementById('sendSubscribe2'),
            SubscribeInput2 = document.getElementById('SubscribeInput2'),
            alertSubscribe2 = document.getElementById('alertSubscribe2');

        $('#SubscribeInput').keyup(function() {
            if($(this).val().trim() != '') {
                $('#sendSubscribe').prop('disabled', false);
            }
        });

        $('#SubscribeInput2').keyup(function() {
            if($(this).val().trim() != '') {
                $('#sendSubscribe2').prop('disabled', false);
            }
        });

        const xhr = new XMLHttpRequest();
        SendSubscribe.onclick = function () {
            let val = SubscribeInput.value;
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4){
                    if (xhr.status === 200){
                        let res = JSON.parse(xhr.response);

                        if (res.tag){
                            SubscribeInput.value = null;
                            AlertSubscribe.classList.remove('error');
                            AlertSubscribe.innerText = res.msg;
                            Swal.fire(
                                'Success',
                                'Success',
                                'success'
                            );
                        }else {
                            AlertSubscribe.classList.add('error');
                            AlertSubscribe.innerText = res.msg;
                        }
                        setTimeout(function() {
                            AlertSubscribe.innerText = null;
                        }, 5000);
                    }
                }
            }
            xhr.open('get',`{{route('sendSubscribe')}}?email=${val}`,true);
            xhr.send();
        }

        const xhr2 = new XMLHttpRequest();
        SendSubscribe2.onclick = function () {
            let val = SubscribeInput2.value;
            xhr2.onreadystatechange = function () {
                if (xhr2.readyState === 4){
                    if (xhr2.status === 200){
                        let res = JSON.parse(xhr2.response);

                        if (res.tag){
                            SubscribeInput2.value = null;
                            alertSubscribe2.classList.remove('error');
                            alertSubscribe2.innerText = res.msg;
                        }else {
                            alertSubscribe2.classList.add('error');
                            alertSubscribe2.innerText = res.msg;
                        }
                        setTimeout(function() {
                            alertSubscribe2.innerText = null;
                        }, 5000);
                    }
                }
            }
            xhr2.open('get',`{{route('sendSubscribe')}}?email=${val}`,true);
            xhr2.send();
        }
        // window.onload=function(){

        // };
        $(document).ready(function() {
            // $('.slider-banner').slick({
            //     // centerMode: true,
            //     // centerPadding: '60px',
            //     // dots: false,
            //     infinite: true,
            //     // speed: 300,
            //     // slidesToShow: 4,
            //     // slidesToScroll: 1,
            //     arrows: true
            // });
        });

        $('.tab-btn-prev').on('click', function () {
            const slickParent= $(this).parent().prop('class');
            console.log(slickParent);
            $(`.${slickParent} .slick-prev`).click();
        });

        $('.tab-btn-next').on('click', function () {
            const slickParent= $(this).parent().prop('class');
            console.log(slickParent);
            $(`.${slickParent} .slick-next`).click();
        });

        @if(app()->getLocale() == 'ar')
            $('.slick-next').html(`<img src="{{asset('assets/images/svg/left.svg')}}">`);
            $('.slick-prev').html(`<img src="{{asset('assets/images/svg/right.svg')}}">`);
        @else
            $('.slick-prev').html(`<img src="{{asset('assets/images/svg/left.svg')}}">`);
            $('.slick-next').html(`<img src="{{asset('assets/images/svg/right.svg')}}">`);
        @endif

    </script>
@endpush
