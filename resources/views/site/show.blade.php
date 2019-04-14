@extends('layouts.default')
@section('title', $site['title'])
@section('description', $site['description'])
@section('setCanonical', route('site.show',array($site['_id'],str_slug(mb_substr($site['title'], 0, \App\Model\Mongo_site::MAX_LENGTH_SLUG),'-'))))
@include('includes.header.css.css_default')
@section('content')
    <div class="container-scroller">
        @include('partials.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <h1><strong>
                        @if(!empty($site['title_full']))
                            {!! $site['title_full'] !!}
                        @else
                            {!! $site['title'] !!}
                        @endif
                        </strong>
                    </h1>
                    <p>@lang('base.domain'): <a href="{!! route('domain.show',$site['domain']) !!}">{!! AppHelper::instance()->renameBlacklistWord($site['domain']) !!}</a></p>
                    <?php
                    if($site['updated_at'] instanceof \MongoDB\BSON\UTCDateTime) {
                        $updated_at= $site['updated_at']->toDateTime()->setTimezone(new \DateTimeZone(config('app.timezone')))->format('Y-m-d H:i:s');
                    }else{
                        $updated_at= $site['updated_at'];
                    }
                    ?>
                    <small>@lang('base.updated_at') {!! $updated_at !!}</small> @if(!empty($site['view']))<small><strong>@lang('base.views'): {!! $site['view'] !!}</strong></small>@endif
                    <div class="card form-group">
                        <div class="card-body">
                            <div class="card-title">
                                @lang('base.infomation_for') {!! $site['domain'] !!}: {!! $site['title'] !!}
                            </div>
                            <span>{!! $site['description'] !!}</span><br>
                            <span>{!! $site['link'] !!}</span><br>
                            <a class="btn btn-primary btn-block" id="" href="{!! route('go.to.url',urlencode($site['link'])) !!}" rel="nofollow" target="_blank">
                                @lang('base.visit_to')
                                @if(!empty($site['title_full']))
                                    {!! $site['title_full'] !!}
                                @else
                                    {!! $site['title'] !!}
                                @endif
                                <p><strong>@lang('base.click_here')</strong></p>
                            </a>
                        </div>
                    </div>
                    @if(count($siteRelate))
                        <div class="card form-group">
                            <div class="card-body">
                                <div class="card-title">
                                    @lang('base.site_relate_for_keyword') {!! $site['domain'] !!}
                                </div>
                            </div>
                            <ul class="list-group">
                                @include('partials.site.listSite', ['sites' => $siteRelate,'showDomain'=>false,'ads'=>'false'])
                            </ul>
                        </div>
                    @endif
                @include('includes.footer.footer')
            </div>
        </div>
    </div>
@endsection
@include('includes.footer.script.script_default')
