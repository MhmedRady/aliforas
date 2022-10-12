@if(isset($menu))
    <ul class="menu-content">
        @foreach($menu as $submenu)
            @if(isset($submenu))
                <li @class([
                    'active' => (Route::currentRouteName() === optional($submenu)['slug'] || Str::startsWith(Route::currentRouteName(), optional($submenu)['slug']))
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
                        @include('seller.panels.submenu', ['menu' => $submenu['submenu']])
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
@endif
