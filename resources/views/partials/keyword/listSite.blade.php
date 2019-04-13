<div class="card form-group">
    <div class="card-body">
        <h2 class="card-title">@lang('base.site_relate_for_keyword') {!! $keyword['keyword'] !!}</h2>
    </div>
    <ul class="list-group">
        <?php
            $i=0;
            $setDescription='';
        ?>
        @foreach($keyword['site_relate'] as $siteRelate)
            <?php
            $site=DB::connection('mongodb')->collection('mongo_site')
                ->where('_id', (string)$siteRelate)->first();
            $i++;
            ?>
            @if(!empty($site['title']))
                @if(empty($keyword['description']) && $i<=3)
                    <?php
                        $setDescription=$setDescription.' '.$site['title'];
                    ?>
                @endif
                <li class="list-group-item">
                    <h4><a href="{!! route('site.show',array($site['_id'],str_slug(mb_substr($site['title'], 0, \App\Model\Mongo_site::MAX_LENGTH_SLUG),'-'))) !!}">
                            @if(!empty($site['title_full']))
                                {!! $site['title_full'] !!}
                            @else
                                {!! $site['title'] !!}
                            @endif
                        </a>
                    </h4>
                    <?php
                    if ($site['updated_at'] instanceof \MongoDB\BSON\UTCDateTime) {
                        $updated_at= $site['updated_at']->toDateTime()->setTimezone(new \DateTimeZone('Asia/Ho_Chi_Minh'))->format('Y-m-d H:i:s');
                    }else{
                        $updated_at= $site['updated_at'];
                    }
                    ?>
                    <span class="text-muted"><small>{!! $updated_at !!}</small></span><br>
                    <span>{!! $site['description'] !!}</span><br>
                    <span>{!! $site['link'] !!}</span><br>
                    <i class="glyphicon glyphicon-globe"></i> <a href="{!! route('domain.show',$site['domain']) !!}">{!! AppHelper::instance()->renameBlacklistWord($site['domain']) !!}</a>
                </li>
            @endif
        @endforeach
        @if(empty($keyword['description']) && !empty($setDescription))
           @section('description', $setDescription)
        @endif
    </ul>

</div>