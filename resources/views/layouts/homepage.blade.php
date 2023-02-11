<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {!! settings()->get("scripts_head") !!}

    <title>{{ settings()->get("page_title") }}</title>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ settings()->get("page_description") }}">
    <meta name="robots" content="{{ settings()->get("page_robots") }}">
    <meta name="author" content="{{ settings()->get("page_author") }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/styles.min.css') }}" rel="stylesheet">

    @stack('style')
</head>
<body class="{{ !empty($body_class) ? $body_class : '' }}">
{!! settings()->get("scripts_afterbody") !!}
@include('layouts.partials.header')

@yield('content')

@include('layouts.partials.footer')

@include('layouts.partials.cookies')

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/slick.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/app.min.js') }}" charset="utf-8"></script>

<script src="{{ asset('/js/plan/imagemapster.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/plan/plan.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/plan/floor.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/plan/tip.js') }}" charset="utf-8"></script>

@stack('scripts')

<script type="text/javascript">
    AOS.init();
    $(document).ready(function(){

    });
    $(window).load(function() {

    });
</script>

{!! settings()->get("scripts_beforebody") !!}

</body>
</html>
