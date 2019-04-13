<?php
$ads='true';
?>
@extends('layouts.default')
@section('title', $video['title'])
@section('description', $video['description'])
@section('setCanonical', route('video.show.id',array($video['yid'],str_slug(mb_substr($video['title'], 0, \App\Model\Mongo_video::MAX_LENGTH_SLUG),'-'))))
@include('includes.header.css.css_default')
@section('content')
    @if($ads=='true' && config('app.env')!='local')
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-6739685874678212",
                enable_page_level_ads: true
            });
        </script>
    @endif
    <div class="container-scroller">
        @include('partials.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <h1><strong>{!! $video['title'] !!}</strong></h1>
                    <?php
                    if($video['updated_at'] instanceof \MongoDB\BSON\UTCDateTime) {
                        $updated_at= $video['updated_at']->toDateTime()->setTimezone(new \DateTimeZone(config('app.timezone')))->format('Y-m-d H:i:s');
                    }else{
                        $updated_at= $video['updated_at'];
                    }
                    ?>
                    <small>@lang('base.updated_at') {!! $updated_at !!}</small> @if(!empty($video['view']))<small><strong>@lang('base.views'): {!! $video['view'] !!}</strong></small>@endif
                    @if(!empty($video['parent']))
                        @if(empty($video['parent_id']))
                            <?php
                            $parentKey = DB::connection('mongodb')->collection('mongo_keyword')
                                ->where('base_64', base64_encode($video['parent']))->first();
                            DB::connection('mongodb')->collection('mongo_video')
                                ->where('_id',(string)$video['_id'])
                                ->update(
                                    [
                                        'parent_id'=>(string)$parentKey['_id']
                                    ]
                                );

                            ?>
                            <p>Parent <a href="{!! route('keyword.show.id',array($parentKey['_id'],str_slug(mb_substr($parentKey['keyword'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}">{!! $video['parent'] !!}</a></p>
                        @else
                            <p>Parent <a href="{!! route('keyword.show.id',array($video['parent_id'],str_slug(mb_substr($video['parent'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}">{!! $video['parent'] !!}</a></p>
                        @endif
                    @endif
                    <div class="row row-pad-5">
                        <div class="col-md-8">
                            <div class="card form-group">
                                <div class="card-body">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe width="640" height="320" class="embed-responsive-item" src="https://www.youtube.com/embed/{!! $video['yid'] !!}" allowfullscreen></iframe>
                                    </div>
                                    <p>{!! $video['description'] !!}</p>
                                </div>
                            </div>
                            @if($ads=='true' && config('app.env')!='local')
                                <div class="form-group">
                                    <ins class="adsbygoogle"
                                         style="display:block"
                                         data-ad-client="ca-pub-6739685874678212"
                                         data-ad-slot="7536384219"
                                         data-ad-format="auto"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                </div>
                            @endif
                            @if(count($videoParent))
                                <div class="card form-group">
                                    <div class="card-body">
                                        <h4 class="card-title">@lang('base.video_relate')</h4>
                                        @foreach(array_chunk(array_slice($videoParent, 0, 12),4) as $chunk)
                                            <div class="row row-pad-5">
                                                @foreach($chunk as $item)
                                                    <div class="col-md-3">
                                                        <p class="text-center"><a href="{!! route('video.show.id',array($item['yid'],str_slug(mb_substr($item['title'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}"><img class="img-responsive" src="{!! $item['thumb'] !!}" title="{!! $item['title'] !!}" alt="{!! $item['title'] !!}"></a></p>
                                                        <strong><a href="{!! route('video.show.id',array($item['yid'],str_slug(mb_substr($item['title'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}">{!! $item['title'] !!}</a> </strong>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if(count($videoParent))
                                @if($ads=='true' && config('app.env')!='local')
                                    <div class="form-group">
                                        <ins class="adsbygoogle"
                                             style="display:block"
                                             data-ad-client="ca-pub-6739685874678212"
                                             data-ad-slot="7536384219"
                                             data-ad-format="auto"></ins>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                        </script>
                                    </div>
                                @endif
                                <div class="card form-group">
                                    @foreach(array_slice($videoParent, 12, 8) as $item)
                                        <li class="list-group-item">
                                            <p class="text-center"><a href="{!! route('video.show.id',array($item['yid'],str_slug(mb_substr($item['title'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}"><img src="{!! $item['thumb'] !!}" title="{!! $item['title'] !!}" alt="{!! $item['title'] !!}"></a></p>
                                            <strong><a href="{!! route('video.show.id',array($item['yid'],str_slug(mb_substr($item['title'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}">{!! $item['title'] !!}</a> </strong>
                                        </li>
                                    @endforeach
                                </div>
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
