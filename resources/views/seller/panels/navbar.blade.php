@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
    <nav
        class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}"
        data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span class="brand-logo">
                            <img src="{{ env('LOGO_MINI_PATH') }}" height="32px" alt="{{ env('APP_NAME') }}">
                        </span>
                        <h2 class="brand-text mb-0" style="align-self: center;">{{ env('APP_NAME') }}</h2>
                    </a>
                </li>
            </ul>
        </div>
        @else
            <nav
                class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ $configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType'] === 'navbar-floating' ? 'container-xxl' : '' }}">
                @endif
                <div class="navbar-container d-flex content">
                    <div class="bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav d-xl-none">
                            <li class="nav-item">
                                <a class="nav-link menu-toggle" href="javascript:void(0);">
                                    <i class="ficon" data-feather="menu"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li class="nav-item d-none d-lg-block">
                                <a class="nav-link nav-link-style">
                                    <i class="ficon"
                                       data-feather="{{ $configData['theme'] === 'dark' ? 'sun' : 'moon' }}"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav align-items-center ms-auto">
                        {{--<li class="nav-item dropdown dropdown-language">
                            <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown"
                               aria-haspopup="true">
                                <i class="flag-icon flag-icon-us"></i>
                                <span class="selected-language">English</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                                <a class="dropdown-item" href="{{ url('lang/en') }}" data-language="en">
                                    <i class="flag-icon flag-icon-us"></i> English
                                </a>
                                <a class="dropdown-item" href="{{ url('lang/fr') }}" data-language="fr">
                                    <i class="flag-icon flag-icon-fr"></i> French
                                </a>
                                <a class="dropdown-item" href="{{ url('lang/de') }}" data-language="de">
                                    <i class="flag-icon flag-icon-de"></i> German
                                </a>
                                <a class="dropdown-item" href="{{ url('lang/pt') }}" data-language="pt">
                                    <i class="flag-icon flag-icon-pt"></i> Portuguese
                                </a>
                            </div>
                        </li>--}}
                        <li class="nav-item dropdown dropdown-notification me-1">
                            <a class="nav-link" href="#" data-bs-toggle="dropdown">
                                <i class="ficon" data-feather="bell"></i>
                                @if($notifications->count())
                                    <span id="nBranchesCount" class="badge rounded-pill btn-danger badge-up" style="font-size: .8rem">{{$notifications->count()}}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header d-flex">
                                        <h4 class="notification-title mb-0 me-auto">@lang('layouts.notifications')</h4>
{{--                                        <div class="badge rounded-pill badge-light-primary">6 New</div>--}}
                                    </div>
                                </li>
                                <li class="scrollable-container media-list">
                                    @if($notifications->count())
                                        @foreach($notifications as $item)
                                            @if(is_null($item->from) && is_null($item->to))
                                                <a class="d-flex" href="#">
                                                    <div class="list-item d-flex align-items-start">
                                                        <div class="me-1">
                                                            <div class="avatar bg-light-{{rondColor()}}">
                                                                <div class="avatar-content text-uppercase fw-bolder" style="width: 40px;height: 40px;font-size: 1rem;">{{userNameSplit($item->name)}}</div>
                                                            </div>
                                                        </div>
                                                        <div class="list-item-body flex-grow-1">
                                                            <p class="media-heading">
                                                                {{__('layouts.newBranchView', ['users'=>$item->views - $item->lastViews])}}
                                                                <strong><u>{{$item->name}}</u></strong>
                                                            </p>
                                                            <small class="notification-text fw-bold text-capitalize" style="color: #888888"> {!! __('layouts.newBranchUpdatedView', ['users'=>"<strong><u>{$item->views}</u></strong>"]) !!} </small>
                                                        </div>
                                                    </div>
                                                </a>
                                            @else
                                                <a class="d-flex" href="{{route('seller.complaints.show', $item->from == \auth()->id()?$item->to:$item->from)}}">
                                                    <div class="list-item d-flex align-items-start">
                                                        <div class="me-1">
                                                            <div class="avatar">
                                                                <img src="{{$item->sender->profile_image_url}}" alt="{{$item->sender->name??''}}" width="40" height="40">
                                                            </div>
                                                        </div>
                                                        <div class="list-item-body flex-grow-1">
                                                            <p class="media-heading">
                                                                <span class="fw-bold text-capitalize">{{$item->sender->name}}</span>
                                                            </p>

                                                            <small class="notification-text fw-bold text-capitalize" style="color: #888888"> {{words_limit($item->body, 150)}} </small>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-center fw-bolder text-capitalize mx-auto">@lang('layouts.noDataUpdate')</span>
                                    @endif
                                </li>
                                @if($notifications->count())
                                    <li class="dropdown-menu-footer">
                                        <button id="asRead" type="button" class="btn btn-primary w-100" href="#">@lang('layouts.asRead')</button>
                                    </li>
                                @endif
                            </ul>
                        </li>

                        <li class="nav-item dropdown dropdown-user">
                            <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user"
                               href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true">
                                <div class="user-nav d-sm-flex d-none">
                                    <span class="user-name fw-bolder">{{ Auth::user()->name }}</span>
                                    <span class="user-status">{{ Auth::user()->is_admin ? 'admin' : 'seller' }}</span>
                                </div>
                                <span class="avatar">
                                  <img class="round"
                                       src="{{ asset('admin-asset/images/portrait/small/avatar-s-11.jpg') }}"
                                       alt="avatar" height="40" width="40">
                                  <span class="avatar-status-online"></span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                                <h6 class="dropdown-header">@lang('auth.editSetting')</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                   href="{{ route('seller.profile.edit',auth()->guard('seller')->id() ?? auth()->id()) }}">
                                    <i class="me-50" data-feather="user"></i> @lang('auth.profile')
                                </a>
                                <a class="dropdown-item" href="{{route('seller.change.password')}}">
                                    <i class="me-50" data-feather="lock"></i> {{__('auth.changePass')}}
                                </a>
                                @if (Auth::check())
                                    <a class="dropdown-item" href="javascript:void(0)"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="me-50" data-feather="power"></i> @lang('Logout')
                                    </a>
                                    <form method="POST" id="logout-form" action="{{ route('admin.logout') }}">
                                        @csrf
                                    </form>
                                @else
                                    <a class="dropdown-item"
                                       href="{{ Route::has('admin.login') ? route('admin.login') : 'javascript:void(0)' }}">
                                        <i class="me-50" data-feather="log-in"></i> Login
                                    </a>
                                @endif
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>

            {{-- Search Start Here --}}
            <ul class="main-search-list-defaultlist d-none">
                <li class="d-flex align-items-center">
                    <a href="javascript:void(0);">
                        <h6 class="section-label mt-75 mb-0">Files</h6>
                    </a>
                </li>
                <li class="auto-suggestion">
                    <a class="d-flex align-items-center justify-content-between w-100"
                       href="{{ url('app/file-manager') }}">
                        <div class="d-flex">
                            <div class="me-75">
                                <img src="{{ asset('admin-asset/images/icons/xls.png') }}" alt="png" height="32">
                            </div>
                            <div class="search-data">
                                <p class="search-data-title mb-0">Two new item submitted</p>
                                <small class="text-muted">Marketing Manager</small>
                            </div>
                        </div>
                        <small class="search-data-size me-50 text-muted">&apos;17kb</small>
                    </a>
                </li>
                <li class="auto-suggestion">
                    <a class="d-flex align-items-center justify-content-between w-100"
                       href="{{ url('app/file-manager') }}">
                        <div class="d-flex">
                            <div class="me-75">
                                <img src="{{ asset('admin-asset/images/icons/jpg.png') }}" alt="png" height="32">
                            </div>
                            <div class="search-data">
                                <p class="search-data-title mb-0">52 JPG file Generated</p>
                                <small class="text-muted">FontEnd Developer</small>
                            </div>
                        </div>
                        <small class="search-data-size me-50 text-muted">&apos;11kb</small>
                    </a>
                </li>
                <li class="auto-suggestion">
                    <a class="d-flex align-items-center justify-content-between w-100"
                       href="{{ url('app/file-manager') }}">
                        <div class="d-flex">
                            <div class="me-75">
                                <img src="{{ asset('admin-asset/images/icons/pdf.png') }}" alt="png" height="32">
                            </div>
                            <div class="search-data">
                                <p class="search-data-title mb-0">25 PDF File Uploaded</p>
                                <small class="text-muted">Digital Marketing Manager</small>
                            </div>
                        </div>
                        <small class="search-data-size me-50 text-muted">&apos;150kb</small>
                    </a>
                </li>
                <li class="auto-suggestion">
                    <a class="d-flex align-items-center justify-content-between w-100"
                       href="{{ url('app/file-manager') }}">
                        <div class="d-flex">
                            <div class="me-75">
                                <img src="{{ asset('admin-asset/images/icons/doc.png') }}" alt="png" height="32">
                            </div>
                            <div class="search-data">
                                <p class="search-data-title mb-0">Anna_Strong.doc</p>
                                <small class="text-muted">Web Designer</small>
                            </div>
                        </div>
                        <small class="search-data-size me-50 text-muted">&apos;256kb</small>
                    </a>
                </li>
                <li class="d-flex align-items-center">
                    <a href="javascript:void(0);">
                        <h6 class="section-label mt-75 mb-0">Members</h6>
                    </a>
                </li>
                <li class="auto-suggestion">
                    <a class="d-flex align-items-center justify-content-between py-50 w-100"
                       href="{{ url('app/user/view') }}">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-75">
                                <img src="{{ asset('admin-asset/images/portrait/small/avatar-s-8.jpg') }}" alt="png"
                                     height="32">
                            </div>
                            <div class="search-data">
                                <p class="search-data-title mb-0">John Doe</p>
                                <small class="text-muted">UI designer</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="auto-suggestion">
                    <a class="d-flex align-items-center justify-content-between py-50 w-100"
                       href="{{ url('app/user/view') }}">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-75">
                                <img src="{{ asset('admin-asset/images/portrait/small/avatar-s-1.jpg') }}" alt="png"
                                     height="32">
                            </div>
                            <div class="search-data">
                                <p class="search-data-title mb-0">Michal Clark</p>
                                <small class="text-muted">FontEnd Developer</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="auto-suggestion">
                    <a class="d-flex align-items-center justify-content-between py-50 w-100"
                       href="{{ url('app/user/view') }}">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-75">
                                <img src="{{ asset('admin-asset/images/portrait/small/avatar-s-14.jpg') }}" alt="png"
                                     height="32">
                            </div>
                            <div class="search-data">
                                <p class="search-data-title mb-0">Milena Gibson</p>
                                <small class="text-muted">Digital Marketing Manager</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="auto-suggestion">
                    <a class="d-flex align-items-center justify-content-between py-50 w-100"
                       href="{{ url('app/user/view') }}">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-75">
                                <img src="{{ asset('admin-asset/images/portrait/small/avatar-s-6.jpg') }}" alt="png"
                                     height="32">
                            </div>
                            <div class="search-data">
                                <p class="search-data-title mb-0">Anna Strong</p>
                                <small class="text-muted">Web Designer</small>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>

            {{-- if main search not found! --}}
            <ul class="main-search-list-defaultlist-other-list d-none">
                <li class="auto-suggestion justify-content-between">
                    <a class="d-flex align-items-center justify-content-between w-100 py-50">
                        <div class="d-flex justify-content-start">
                            <span class="me-75" data-feather="alert-circle"></span>
                            <span>No results found.</span>
                        </div>
                    </a>
                </li>
            </ul>
        {{-- Search Ends --}}
        <!-- END: Header-->
    </nav>
