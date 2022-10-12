<body
    class="vertical-layout vertical-menu-modern {{ $configData['verticalMenuNavbarType'] }} {{ $configData['blankPageClass'] }} {{ $configData['bodyClass'] }} {{ $configData['sidebarClass'] }} {{ $configData['footerType'] }} {{$configData['contentLayout']}}"
    data-open="click"
    data-menu="vertical-menu-modern"
    data-col="{{$configData['showMenu'] ? $configData['contentLayout'] : '1-column' }}"
    data-framework="laravel"
    data-asset-path="{{ asset('admin-asset//')}}">

<!-- BEGIN: Header-->
@include('seller.panels.navbar')
<!-- END: Header-->

<!-- BEGIN: Main Menu-->
@if((isset($configData['showMenu']) && $configData['showMenu'] === true))
    @include('seller.panels.sidebar')
@endif
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content {{ $configData['pageClass'] }}">
    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    @if(($configData['contentLayout']!=='default') && isset($configData['contentLayout']))
        <div class="content-area-wrapper {{ $configData['layoutWidth'] === 'boxed' ? 'container-xxl p-0' : '' }}">
            <div class="{{ $configData['sidebarPositionClass'] }}">
                <div class="sidebar">
                    {{-- Include Sidebar Content --}}
                    @yield('content-sidebar')
                </div>
            </div>
            <div class="{{ $configData['contentSidebarClass'] }}">
                <div class="content-wrapper">
                    <div class="content-body">
                        {{-- Include Page Content --}}
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="content-wrapper {{ $configData['layoutWidth'] === 'boxed' ? 'container-xxl p-0' : '' }}">
            {{-- Include Breadcrumb --}}
            @if($configData['pageHeader'] === true && isset($configData['pageHeader']) && isset($breadcrumbs))
                @include('seller.panels.breadcrumb')
            @endif

            <div class="content-body">
                {{-- Include Page Content --}}
                @yield('content')
            </div>
        </div>
    @endif

</div>
<!-- End: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

{{-- include footer --}}
@include('seller.panels.footer')

{{-- include default scripts --}}
@include('seller.panels.scripts')

<script type="text/javascript">
    Object.size = function (obj) {
        let size = 0, key;
        for (key in obj)
            if (obj.hasOwnProperty(key)) size++;
        return size;
    };
    window.dtTableSearcher = function (dtTable, i) {
        if (this.classList.contains('no-search'))
            this.remove()
        else if (this.classList.contains('select-search') && $(this).data('options')) {
            let options = '<option value=""></option>'
            if (Object.size($(this).data('options')) > 0)
                $.each(JSON.parse(JSON.stringify($(this).data('options'))), function (k, v) {
                    options += `<option value="${k}">${v}</option>`;
                })
            let title = $(this).text();
            $(this).html(`<select style="min-width: 100px;" data-placeholder="${title}" dir="rtl" data-minimum-results-for-search="-1" data-allow-clear="1" class="select2 form-control-sm"">${options}</select>`);
            $('select.select2', this).select2({
                theme: 'bootstrap-5',
                dropdownParent: this, // Required for dropdown styling
            });
            $($('.select2', this).data('select2').$container).addClass('select2-container-sm');
            $('.select2', this).on('change.select2', function (e) {
                if (dtTable().column(i).search() !== e.delegateTarget.value)
                    dtTable().column(i).search(e.delegateTarget.value).draw();
            });
        } else {
            let title = $(this).text();
            $(this).html(`<input type="text" autocomplete="disabled" class="form-control form-control-sm" placeholder="${title}" />`);
            $('input', this).on('keyup change', function () {
                if (dtTable().column(i).search() !== this.value)
                    dtTable().column(i).search(this.value).draw();
            });
        }
    };
    window.ReloadButton = {
        text: feather.icons['refresh-cw'].toSvg({class: 'mr-50 font-small-4'}) + ' {{__("layouts.refresh")}}',
        className: 'btn btn-outline-secondary',
        init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
        },
        action: function (e, dt, node, config) {
            dt.ajax.reload(null, false);
        }
    };
    String.prototype.formatUnicorn = String.prototype.formatUnicorn || function () {
        "use strict";
        let str = this.toString();
        if (arguments.length) {
            let t = typeof arguments[0];
            let args = ("string" === t || "number" === t) ? Array.prototype.slice.call(arguments) : arguments[0];

            for (let key in args)
                str = str.replace(new RegExp("\\{" + key + "\\}", "gi"), args[key]);
        }
        return str;
    };
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14, height: 14
            });
        }
    })
</script>
</body>
</html>
