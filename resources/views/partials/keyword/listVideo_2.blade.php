<div class="panel panel-default">
    <div class="panel-body">
        <div class="row row-pad-5">
            @foreach(array_slice($keyword['video_relate'], $from, $to) as $videoRelate)
                <?php
                $video=DB::connection('mongodb')->collection('mongo_video')
                    ->where('_id', (string)$videoRelate)->first();
                ?>
                @if(!empty($video['title']))
                    <div class="col-md-3 col-xs-3">
                        <a href="#"><img class="img-responsive" src="{!! $video['thumb'] !!}" alt="{!! $video['title'] !!}" title="{!! $video['title'] !!}"></a>
                        <?php
                        if ($video['updated_at'] instanceof \MongoDB\BSON\UTCDateTime) {
                            $updated_at= $video['updated_at']->toDateTime()->setTimezone(new \DateTimeZone('Asia/Ho_Chi_Minh'))->format('Y-m-d H:i:s');
                        }else{
                            $updated_at= $video['updated_at'];
                        }
                        ?>
                        <span class="text-muted"><small>{!! $updated_at !!}</small></span><br>
                        <strong><a href="#">Cung cấp video {!! mb_substr($video['title'], 0, \App\Model\Mongo_Image::MAX_LENGTH_TITLE) !!}</a></strong><br>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>