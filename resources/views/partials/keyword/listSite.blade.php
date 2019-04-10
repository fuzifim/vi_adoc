<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Site relate for {!! $keyword['keyword'] !!}</h2>
    </div>
    <ul class="list-group">
        @foreach($keyword['site_relate'] as $siteRelate)
            <?php
            $site=DB::connection('mongodb')->collection('mongo_site')
                ->where('_id', (string)$siteRelate)->first();
            ?>
            @if(!empty($site['title']))
                <li class="list-group-item">
                    <h4><a class="siteLink" id="linkContinue" href="#" rel="nofollow" target="blank">{!! $site['title'] !!}</a></h4>
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
                    <i class="glyphicon glyphicon-globe"></i> <a href="http://{!! $site['domain'] !!}.d.{!! config('app.url') !!}" target="blank">{!! WebService::renameBlacklistWord($site['domain']) !!}</a>
                </li>
            @endif
        @endforeach
    </ul>

</div>