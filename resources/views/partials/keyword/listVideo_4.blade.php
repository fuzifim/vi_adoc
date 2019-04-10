<div class="card">
    <div class="card-body">
        <h2 class="card-title">@lang('base.video_relate_for') {!! $keyword['keyword'] !!}</h2>
        @foreach(array_chunk($keyword['video_relate'],4) as $chunk)
        <div class="row row-pad-5">
            @foreach($chunk as $videoRelate)
                <?php
                $video=DB::connection('mongodb')->collection('mongo_video')
                    ->where('_id', (string)$videoRelate)->first();
                ?>
                @if(!empty($video['title']))
                    <div class="col-md-3 col-xs-3">
                        <a href="{!! route('video.show',$video['yid']) !!}"><img class="mx-auto d-block" src="{!! $video['thumb'] !!}" alt="{!! $video['title'] !!}" title="{!! $video['title'] !!}"></a>
                        <?php
                        if ($video['updated_at'] instanceof \MongoDB\BSON\UTCDateTime) {
                            $updated_at= $video['updated_at']->toDateTime()->setTimezone(new \DateTimeZone('Asia/Ho_Chi_Minh'))->format('Y-m-d H:i:s');
                        }else{
                            $updated_at= $video['updated_at'];
                        }
                        ?>
                        <span class="text-muted"><small>{!! $updated_at !!}</small></span><br>
                        <strong><a href="{!! route('video.show',$video['yid']) !!}">{!! mb_substr($video['title'], 0, \App\Model\Mongo_Image::MAX_LENGTH_TITLE) !!}</a></strong><br>
                    </div>
                @endif
            @endforeach
        </div>
        @endforeach
    </div>
</div>