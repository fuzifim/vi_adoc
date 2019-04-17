@extends('layouts.default')
@section('title', 'Cài đặt trang')
@include('includes.header.css.css_default')
@section('content')
    <div class="container-scroller">
        @include('partials.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <form method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Site Infomation</h4>
                                <p class="card-description">
                                    Basic form layout
                                </p>
                                <form class="forms-sample">
                                    <div class="form-group">
                                        <label for="site_name">Site Name</label>
                                        <input type="text" class="form-control" name="site_name" id="site_name" placeholder="Site name" @if(!empty($siteConfig->site_name)) value="{!! $siteConfig->site_name!!}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="site_name_short">Site Name Short</label>
                                        <input type="text" class="form-control" name="site_name_short" id="site_name_short" placeholder="Site name short" @if(!empty($siteConfig->site_name_short)) value="{!! $siteConfig->site_name_short !!}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="site_description">Site Description</label>
                                        <input type="text" class="form-control" name="site_description" id="site_description" placeholder="Site description" @if(!empty($siteConfig->site_description)) value="{!! $siteConfig->site_description!!}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="site_domain">Site Domain</label>
                                        <input type="text" class="form-control" name="site_domain" id="site_domain" placeholder="Site Domain" @if(!empty($siteConfig->site_domain)) value="{!! $siteConfig->site_domain !!}"@endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="site_domain">Site Url</label>
                                        <input type="text" class="form-control" name="site_url" id="site_url" placeholder="Site Url" @if(!empty($siteConfig->site_url)) value="{!! $siteConfig->site_url !!}"@endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="lang">Lang</label>
                                        <input type="text" class="form-control" name="site_lang" id="lang" placeholder="lang" value="{!! config('app.locale') !!}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="webmaster_tools">Webmaster tools</label>
                                        <input type="text" class="form-control" name="webmaster_tools" id="webmaster_tools" placeholder="webmaster_tools" @if(!empty($siteConfig->webmaster_tools)) value="{!! $siteConfig->webmaster_tools !!}"@endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="google_analytics_account">Google Analytics Id</label>
                                        <input type="text" class="form-control" name="google_analytics_account" id="google_analytics_account" placeholder="google_analytics_account" @if(!empty($siteConfig->google_analytics_account)) value="{!! $siteConfig->google_analytics_account !!}"@endif>
                                    </div>
                                    <div class="form-check form-check-primary">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="site_ads" class="form-check-input" @if(!empty($siteConfig->site_ads))checked=""@endif>
                                            Kích hoạt quảng cáo
                                            <i class="input-helper"></i></label>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
                @include('includes.footer.footer')
            </div>
        </div>
    </div>
@endsection
@include('includes.footer.script.script_default')
