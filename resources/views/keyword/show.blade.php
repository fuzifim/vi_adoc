<?php
    $showListImage=0;
    if(!empty($keyword['site_relate']) && count($keyword['site_relate'])>0 && !empty($keyword['image_relate']) && count($keyword['image_relate'])>0){
        $showListImage=1;
    }else if(!empty($keyword['image_relate']) && count($keyword['image_relate'])>0){
        $showListImage=2;
    }
    $showListVideo=0;
    if(!empty($keyword['site_relate']) && count($keyword['site_relate'])>0 && !empty($keyword['video_relate']) && count($keyword['video_relate'])>0){
        $showListVideo=1;
    }else if(!empty($keyword['video_relate']) && count($keyword['video_relate'])>0){
        $showListVideo=2;
    }
    $showEmpty=false;
    if(empty($keyword['site_relate']) && empty($keyword['image_relate']) && empty($keyword['video_relate'])){
        $showEmpty=true;
    }
?>
@extends('layouts.default')
@section('title', $keyword['keyword'])
@if(!empty($keyword['description']))
    @section('description', $keyword['description'])
@endif
@include('includes.header.css.css_default')
@section('content')
    <div class="container-scroller">
        @include('partials.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="pageheader form-group">
                        <h1 class="display-4"><strong>{!! $keyword['keyword'] !!}</strong></h1>
                        <?php
                        if ($keyword['updated_at'] instanceof \MongoDB\BSON\UTCDateTime) {
                            $updated_at= $keyword['updated_at']->toDateTime()->setTimezone(new \DateTimeZone(config('app.timezone')))->format('Y-m-d H:i:s');
                        }else{
                            $updated_at= $keyword['updated_at'];
                        }
                        ?>
                        <small>@lang('base.updated_at') {!! $updated_at !!}</small> @if(!empty($keyword['view']))<small><strong>@lang('base.views'): {!! $keyword['view'] !!}</strong></small>@endif
                        @if(!empty($keyword['parent']))
                            <p>Parent <a href="{!! route('keyword.show',AppHelper::instance()->characterReplaceUrl($keyword['parent'])) !!}">{!! $keyword['parent'] !!}</a></p>
                        @endif
                    </div>
                    <div class="row row-pad-5">
                        <div class="col-md-12">
                            @if($showEmpty==true)
                                <div class="alert alert-info">
                                    Từ khóa {!! $keyword['keyword'] !!} chưa có bất kỳ thông tin trang web, hình ảnh, video nào!
                                </div>
                            @endif
                            @if($showListImage==1)
                                @include('partials.keyword.listImage', ['keyword' => $keyword])
                            @endif
                            @if($showListVideo==0)
                                @if(!empty($keyword['site_relate']) && count($keyword['site_relate'])>0)
                                    @include('partials.keyword.listSite', ['keyword' => $keyword])
                                @endif
                            @endif
                            @if($showListVideo==1)
                                <div class="row row-pad-5">
                                    <div class="col-md-9">
                                        @include('partials.keyword.listSite', ['keyword' => $keyword])
                                        @include('partials.keyword.listVideo_1', ['keyword' => $keyword,'from'=>0,'to'=>4])
                                        @include('partials.keyword.listVideo_2', ['keyword' => $keyword,'from'=>4,'to'=>4])
                                    </div>
                                    <div class="col-md-3">
                                        @include('partials.keyword.listVideo_3', ['keyword' => $keyword,'from'=>8,'to'=>12])
                                    </div>
                                </div>
                            @elseif($showListVideo==2)
                                @include('partials.keyword.listVideo_4', ['keyword' => $keyword])
                            @endif
                            @if($showListImage==2)
                               @include('partials.keyword.listImage', ['keyword' => $keyword])
                            @endif
                            @if(!empty($keyword['keyword_relate']) && count($keyword['keyword_relate'])>0)
                                <div class="form-group">
                                    <p><strong>@lang('base.keyword_relate_for') {!! $keyword['keyword'] !!}</strong></p>
                                    @foreach($keyword['keyword_relate'] as $keywordRelate)
                                        <?php
                                        $keywordRe=DB::connection('mongodb')->collection('mongo_keyword')
                                            ->where('_id', (string)$keywordRelate)->first();
                                        ?>
                                        <span><a class="badge" href="{!! route('keyword.show',AppHelper::instance()->characterReplaceUrl($keywordRe['keyword'])) !!}">{!! $keywordRe['keyword'] !!}</a></span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @include('includes.footer.footer')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@endsection
@include('includes.footer.script.script_default')
