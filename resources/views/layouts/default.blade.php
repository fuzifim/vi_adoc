<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title')</title>
    @if (View::hasSection('setCanonical'))
    <link rel="canonical" href="@yield('setCanonical')" />
    @endif
    @if (View::hasSection('description'))
        <meta name="description" content="@yield('description')">
        <meta property="og:description" content="@yield('description')">
    @endif
    @if (View::hasSection('title'))
        <meta property="og:title" content="@yield('title')">
    @endif
    @if (View::hasSection('image'))
        <meta property="og:image" content="@yield('image')" />
    @endif
    <link rel="icon" href="{{ asset('favicon.png') }}" />
    @if(!empty($channel['siteConfig']->webmaster_tools))
        <meta name="google-site-verification" content="{!! $channel['siteConfig']->webmaster_tools !!}" />
    @endif
    @section('header_css')
    @show
    @yield('ads')
</head>
<body>
@yield('content')
@section('footer')
@show
@section('footer_script')
@show
</body>
</html>