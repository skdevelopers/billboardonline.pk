<!DOCTYPE html>
<html lang="en-US" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="keywords" content="@yield('meta_keywords','billboard, Online, Pakistan')">
    <meta name="description" content="@yield('meta_description','Bill Board Online Pakistan')">
    <title>@yield('title','Billboard Online')</title>
    <link rel="canonical" href="{{url()->current()}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha512-tDXPcamuZsWWd6OsKFyH6nAqh/MjZ/5Yk88T5o+aMfygqNFPan1pLyPFAndRzmOWHKT+jSDzWpJv8krj6x1LMA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='{{ asset('assets/css/style.css') }}' type='text/css' />
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}" type="text/css" />
    <link rel='stylesheet' href='{{ asset('assets/css/jquery.mmenu.css') }}' type='text/css' />
    <link rel='stylesheet' href='{{ asset('assets/css/responsive.css') }}' type='text/css' />
    <link rel="stylesheet" href="{{asset('assets/plugins/revolution/css/settings.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/revolution/css/layers.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/revolution/css/navigation.css')}}">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato:400,700' type='text/css' />
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.11.2/css/all.css?wpfas=true' type='text/css' />
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css?wpfas=true' type='text/css' />
    @yield('styles')
</head>

<body class="archive post-type-archive post-type-archive-gd_place geodir_custom_posts geodir-page geodir-archive geodir_advance_search gd-map-auto">
    <div id="ds-container">
        @include('partials.header')

{{--        @includeWhen(request()->is('/'), 'partials.map')--}}
        @includeWhen(request()->is('/'), 'partials.slider')
        @yield('content')

        @include('partials.footer')
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha512-TqmAh0/sSbwSuVBODEagAoiUIeGRo8u95a41zykGfq5iPkO9oie8IKCgx7yAr1bfiBjZeuapjLgMdp9UMpCVYQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
    <!-- Custom scripts-->
    @yield('scripts')
    <script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>
