<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="description" content="@yield('meta_description')" />
    <meta property="og:title" content="@yield('page_title')" />
    <meta property="og:description" content="@yield('meta_description')" />
    <meta property="og:image" content="@yield('featured_image')" />
    <meta property="og:image:width" content="820" />
    <meta property="og:image:height" content="360" />
    <link rel='icon' href="{{ url('frontend/images/favicon.ico')}}" type='image/x-icon' >
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- Includes header scripts -->
    @include('layouts.frontend.includes.header-script')
</head>
@if(URL::current() == URL::to('/') || URL::current() == URL::to('/demo'))
<body class="home">
@else
<body class="">
@endif
	<div id="wrapper">
        @yield('content')
    </div>
    <!-- Includes footer scripts -->
    @include('layouts.frontend.includes.footer-script')
    @yield('script')
</body>
</html>
