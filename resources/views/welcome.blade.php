@extends('layouts.default')
@section('title', (!empty($channel['siteConfig']->site_name)?$channel['siteConfig']->site_name:''))
@include('includes.header.css.css_default')
@if(!empty($channel['siteConfig']->site_ads) && $channel['siteConfig']->site_ads=='on' && config('app.env')!='local')
    @section('ads')
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-6739685874678212",
                enable_page_level_ads: true
            });
        </script>
    @endsection
@endif
@section('content')
    <div class="container-scroller">
        @include('partials.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-description">
                                @if(!empty($channel['siteConfig']->site_description)){!! $channel['siteConfig']->site_description !!}@endif</p>
                            <h3 class="card-title">@lang('base.keyword_new_update')</h3>
                            @if(count($newKeyword))
                                @foreach($newKeyword as $item)
                                    <a class="badge badge-secondary mb-1" href="{!! route('keyword.show.id',array($item['_id'],str_slug(mb_substr($item['keyword'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}">{!! $item['keyword'] !!}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @include('includes.footer.footer')
            </div>
        </div>
    </div>
@endsection
@include('includes.footer.script.script_default')
