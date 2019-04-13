<?php
$i=0;
?>
@foreach($sites as $item)
    @if(!empty($item['title']))
        <?php $i++ ?>
        @if($i==3)
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
        @endif
        <li class="list-group-item">
            <h4><a class="" id="" href="{!! route('site.show',array($item['_id'],str_slug(mb_substr($item['title'], 0, \App\Model\Mongo_site::MAX_LENGTH_SLUG),'-'))) !!}">
                    @if(!empty($item['title_full']))
                        {!! $item['title_full'] !!}
                    @else
                        {!! $item['title'] !!}
                    @endif
                </a>
            </h4>
            <?php
            if ($item['updated_at'] instanceof \MongoDB\BSON\UTCDateTime) {
                $updated_at= $item['updated_at']->toDateTime()->setTimezone(new \DateTimeZone('Asia/Ho_Chi_Minh'))->format('Y-m-d H:i:s');
            }else{
                $updated_at= $item['updated_at'];
            }
            ?>
            <span class="text-muted"><small>{!! $updated_at !!}</small></span><br>
            <span>{!! $item['description'] !!}</span><br>
            <span>{!! $item['link'] !!}</span><br>
            @if($showDomain==true)
                <i class="glyphicon glyphicon-globe"></i> <a href="{!! route('domain.show',$item['domain']) !!}">{!! AppHelper::instance()->renameBlacklistWord($item['domain']) !!}</a>
            @endif
        </li>
    @endif
@endforeach