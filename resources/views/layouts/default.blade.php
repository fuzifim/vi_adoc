<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('image')" />
    <link rel="icon" href="{{ asset('favicon.png') }}" />
    <meta name="google-site-verification" content="xVR-3NTFIzHZbeNT_0VJc2a9t3W5dIwrszUBbruFnx8" />
    @section('header_css')
    @show
</head>
<body>
@yield('content')
@section('footer')
@show
@section('footer_script')
@show
</body>
</html>