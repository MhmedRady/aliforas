@php
    $configData = Helper::applyClasses();
@endphp
{{-- Horizontal Menu --}}
<div class="horizontal-menu-wrapper">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal
  {{$configData['horizontalMenuClass']}}
    {{($configData['theme'] === 'dark') ? 'navbar-dark' : 'navbar-light' }}
        navbar-shadow menu-border
{{ ($configData['layoutWidth'] === 'boxed' && $configData['horizontalMenuType']  === 'navbar-floating') ? 'container-xxl' : '' }}"
         role="navigation"
         data-menu="menu-wrapper"
         data-menu-type="floating-nav">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <span class="brand-logo">
                            <img src="{{ env('LOGO_MINI_PATH') }}" height="32px" alt="{{ env('APP_NAME') }}">
                        </span>
                        <h2 class="brand-text mb-0" style="align-self: center;">{{ env('APP_NAME') }}</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav w-100" id="main-menu-navigation" data-menu="menu-navigation">
                {{-- Foreach menu item starts --}}
                @if(isset($horizontalMenuData))
                    @foreach($horizontalMenuData->menu as $menu)
                        @php($custom_classes = $menu->classlist ?? '')
                        <li class="nav-item @if(isset($menu->submenu)){{'dropdown'}}@endif {{ $custom_classes }} {{ Route::currentRouteName() === $menu->slug ? 'active' : ''}}"
                        @if(isset($menu->submenu)){{'data-menu=dropdown'}}@endif>
                            <a href="{{isset($menu->url)? url($menu->url):'javascript:void(0)'}}"
                               class="nav-link d-flex align-items-center @if(isset($menu->submenu)){{'dropdown-toggle'}}@endif"
                               target="{{isset($menu->newTab) ? '_blank':'_self'}}" @if(isset($menu->submenu)){{'data-bs-toggle=dropdown'}}@endif>
                                <i data-feather="{{ $menu->icon }}"></i>
                                <span>{{ $menu->name }}</span>
                            </a>
                            @if(isset($menu->submenu))
                                @include('admin.panels.horizontalSubmenu', ['menu' => $menu->submenu])
                            @endif
                        </li>
                    @endforeach
                @endif
                {{-- Foreach menu item ends --}}
            </ul>
        </div>
    </div>
</div>
