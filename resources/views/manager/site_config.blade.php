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