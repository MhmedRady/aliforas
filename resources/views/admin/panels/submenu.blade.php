@if(isset($menu))
    <ul class="menu-content">
        @foreach($menu as $submenu)
            @if(isset($submenu))
            @php
                $submenuSlug = str_replace('admin.', '', str_replace('_', '-', $submenu['slug'])) == 'about-us' ? 'aboutUs-content' : $submenu['slug'];
            @endphp

                <li @class([
                    'active' => (Route::currentRouteName() === optional($submenu)['slug'] || Str::startsWith(Route::currentRouteName(), optional($submenu)['slug']) || str_replace('admin.', '', str_replace('_', '-', $submenu['slug'])) == request()->segment(2) || $submenuSlug == request()->segment(2))
                ])>
                    <a href="{{isset($submenu['url']) ? url($submenu['url']) : 'javascript:void(0)'}}"
                       class="d-flex align-items-center"
                       target="{{isset($submenu['newTab']) && $submenu['newTab'] === true  ? '_blank':'_self'}}">
                        @if(isset($submenu['icon']))
                            <i data-feather="{{$submenu['icon']}}"></i>
                        @endif
                        <span class="menu-item text-truncate">{{ $submenu['name'] }}</span>
                    </a>
                    @if (isset($submenu['submenu']))
                        @include('admin.panels.submenu', ['menu' => $submenu['submenu']])
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
@endif
