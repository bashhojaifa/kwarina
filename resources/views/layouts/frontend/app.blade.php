<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>


    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link href="{{ asset('assets/frontend/css/ionicons.css') }}" rel="stylesheet">

<!-- Bootstrap Core Css -->
    <link href="{{ asset('assets/common/css/bootstrap/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/style/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/common/css/nav.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/footer/footer.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/common/css/toastr/toastr.min.css') }}">
    @stack('css')

</head>
<body class="theme-blue">

@stack('carousel')

<!-- Top Bar -->
@include('layouts.common.header')
<!-- #Top Bar -->


<section class="content">

    @yield('content')

</section>

@include('layouts.frontend.partial.footer')

<!-- Jquery Core Js -->
<script src="{{ asset('assets/common/js/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('assets/common/js/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('assets/common/js/toastr/toastr.min.js') }}"></script>
{!! Toastr::message() !!}

<script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}', 'Error', {
        closeButton:true,
        progressBar:true,
    })
    @endforeach
    @endif
</script>

@stack('js')
</body>
</html>
