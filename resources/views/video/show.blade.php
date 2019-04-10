@extends('layouts.default')
@section('title', $video['title'])
@section('description', $video['description'])
@include('includes.header.css.css_default')
@section('content')
    <div class="container-scroller">
        @include('partials.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <h1><strong>{!! $video['title'] !!}</strong></h1>
                    <?php
                    if ($video['updated_at'] instanceof \MongoDB\BSON\UTCDateTime) {
                        $updated_at= $video['updated_at']->toDateTime()->setTimezone(new \DateTimeZone(config('app.timezone')))->format('Y-m-d H:i:s');
                    }else{
                        $updated_at= $video['updated_at'];
                    }
                    ?>
                    <small>@lang('base.updated_at') {!! $updated_at !!}</small> @if(!empty($video['view']))<small><strong>@lang('base.views'): {!! $video['view'] !!}</strong></small>@endif
                    @if(!empty($video['parent']))
                        <p>Parent <a href="{!! route('keyword.show',AppHelper::instance()->characterReplaceUrl($video['parent'])) !!}">{!! $video['parent'] !!}</a></p>
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
                            @if(count($videoParent))
                                <div class="card form-group">
                                    <div class="card-body">
                                        <h4 class="card-title">@lang('base.video_relate')</h4>
                                        @foreach(array_chunk(array_slice($videoParent, 0, 12),4) as $chunk)
                                            <div class="row row-pad-5">
                                                @foreach($chunk as $item)
                                                    <div class="col-md-3">
                                                        <p class="text-center"><a href="{!! route('video.show',$item['yid']) !!}"><img class="img-responsive" src="{!! $item['thumb'] !!}" title="{!! $item['title'] !!}" alt="{!! $item['title'] !!}"></a></p>
                                                        <strong><a href="{!! route('video.show',$item['yid']) !!}">{!! $item['title'] !!}</a> </strong>
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
                                <div class="card form-group">
                                    @foreach(array_slice($videoParent, 12, 8) as $item)
                                        <li class="list-group-item">
                                            <p class="text-center"><a href="{!! route('video.show',$item['yid']) !!}"><img src="{!! $item['thumb'] !!}" title="{!! $item['title'] !!}" alt="{!! $item['title'] !!}"></a></p>
                                            <strong><a href="{!! route('video.show',$item['yid']) !!}">{!! $item['title'] !!}</a> </strong>
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
