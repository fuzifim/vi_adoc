<div class="card">
    <div class="list-group">
        @foreach(array_slice($keyword['video_relate'], $from, $to) as $videoRelate)
            <?php
            $video=DB::connection('mongodb')->collection('mongo_video')
                ->where('_id', (string)$videoRelate)->first();
            ?>
            @if(!empty($video['title']))
                <li class="list-group-item">
                    <a href="{!! route('video.show.id',array($video['yid'],str_slug(mb_substr($video['title'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}"><img class="mx-auto d-block" src="{!! $video['thumb'] !!}" alt="{!! $video['title'] !!}" title="{!! $video['title'] !!}"></a>
                    <?php
                    if ($video['updated_at'] instanceof \MongoDB\BSON\UTCDateTime) {
                        $updated_at= $video['updated_at']->toDateTime()->setTimezone(new \DateTimeZone('Asia/Ho_Chi_Minh'))->format('Y-m-d H:i:s');
                    }else{
                        $updated_at= $video['updated_at'];
                    }
                    ?>
                    <span class="text-muted"><small>{!! $updated_at !!}</small></span><br>
                    <strong><a href="{!! route('video.show.id',array($video['yid'],str_slug(mb_substr($video['title'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}">{!! mb_substr($video['title'], 0, \App\Model\Mongo_Image::MAX_LENGTH_TITLE) !!}</a></strong><br>
                </li>
            @endif
        @endforeach
    </div>
</div>