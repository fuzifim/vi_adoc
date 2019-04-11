<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <link rel="icon" href="{{ asset('favicon.png') }}" />
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