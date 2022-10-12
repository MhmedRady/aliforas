@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset

<!DOCTYPE html>
@php $configData = Helper::applyClasses(); @endphp

<html class="loading {{ ($configData['theme'] === 'light') ? '' : $configData['layoutTheme'] }}"
lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{$configData['defaultLanguage']}}@endif"
data-textdirection="{{ getPageDir() }}"
@if($configData['theme'] === 'dark') data-layout="dark-layout"@endif>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@lang(env('APP_NAME'))@hasSection('title') – @yield('title')@endif</title>
  <link rel="icon" href="{{ env('FAVICON_PATH') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ env('FAVICON_PATH') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
  {{-- Include core + vendor Styles --}}
  @include('seller.panels.styles')

    @if(app()->getLocale() == 'ar')
        <style>
            @font-face {
                font-family: Cairo;
                src: url({{asset('assets/fonts/Cairo-Regular.ttf')}});
            }
            body {
                font-family: Cairo !important;
                font-size: 1rem;
            }
            label{
                font-size: 1rem !important;
                font-weight: bold;
            }
        </style>
    @endif
</head>
<body class="vertical-layout vertical-menu-modern {{ $configData['bodyClass'] }} {{($configData['theme'] === 'dark') ? 'dark-layout' : ''}} {{ $configData['blankPageClass'] }} blank-page"
data-menu="vertical-menu-modern"
data-col="blank-page"
data-framework="laravel"
data-asset-path="{{ asset('admin-asset//')}}">

  <!-- BEGIN: Content-->
  <div class="app-content content {{ $configData['pageClass'] }}">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">
      <div class="content-body">

        {{-- Include Startkit Content --}}
        @yield('content')

      </div>
    </div>
  </div>
  <!-- End: Content-->

  {{-- include default scripts --}}
  @include('seller.panels.scripts')

  <script type="text/javascript">
    $(window).on('load', function() {
      if (feather) {
        feather.replace({
          width: 22,
          height: 22
        });
      }
    });
  </script>

<script src="{{asset('admin-asset/js/script.js')}}"></script>

</body>

</html>
