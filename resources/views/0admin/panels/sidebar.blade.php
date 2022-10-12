@php
    $configData = Helper::applyClasses();
@endphp
<div
    class="main-menu menu-fixed {{(($configData['theme'] === 'dark') || ($configData['theme'] === 'semi-dark')) ? 'menu-dark' : 'menu-light'}} menu-accordion menu-shadow"
    data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{url('/big-boss')}}">
                      <span class="brand-logo">
                          <img src="{{ env('LOGO_MINI_PATH') }}" height="32px" alt="{{ env('APP_NAME') }}">
                      </span>
                    <h2 class="brand-text" style="align-self: center;">{{ env('APP_NAME') }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
                       data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content w-100">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- Foreach menu item starts --}}
            @if(isset($verticalMenuData))
                @php($badgeClasses = "badge rounded-pill badge-light-primary ms-auto me-1")
                @foreach($verticalMenuData['menu'] as $menu)
                    @if($menu !== null)
                        @if(isset($menu['navheader']))
                            <li class="navigation-header">
                                <span>{{ $menu['navheader'] }}</span>
                                <i data-feather="more-horizontal"></i>
                            </li>
                        @else
                            {{-- Add Custom Class with nav-item --}}
                            <li @class([
                                'nav-item', optional($menu)['classList'],
                                'active' => (Route::currentRouteName() === optional($menu)['slug'] || Str::startsWith(Route::currentRouteName(), optional($menu)['slug']))
                            ])>
                                <a href="{{isset($menu['url'])? url($menu['url']):'javascript:void(0)'}}"
                                   class="d-flex align-items-center"
                                   target="{{isset($menu['newTab']) ? '_blank':'_self'}}">
                                    @if (isset($menu['icon']))
                                        <i data-feather="{{ $menu['icon'] }}"></i>
                                    @endif
                                    <span class="menu-title text-truncate">{{ $menu['name'] }}</span>
                                    @if (isset($menu['badge']))
                                        <span
                                            class="{{ $menu['badgeClass'] ?? $badgeClasses }}">{{$menu['badge']}}</span>
                                    @endif
                                </a>
                                @if(isset($menu['submenu']))
                                    @include('admin.panels.submenu', ['menu' => $menu['submenu']])
                                @endif
                            </li>
                        @endif
                    @endif
                @endforeach
            @endif
            {{-- Foreach menu item ends --}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
