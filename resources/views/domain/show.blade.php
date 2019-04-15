<?php
    if(!empty($domain['attribute']['whois'])){
        $decodeWhois=json_decode($domain['attribute']['whois']);
    }
    $description='';
    $description.=$domain['domain'];
    if(!empty($decodeWhois->creationDate)){
        $description.=' '.__('base.created_at').' '.$decodeWhois->creationDate;
    }
    if(!empty($decodeWhois->expirationDate)){
        $description.=' '.__('base.expiration_date').' '.$decodeWhois->expirationDate;
    }
    if(!empty($decodeWhois->registrar)){
        $description.=' '.__('base.registrar').' '.$decodeWhois->registrar;
    }
    if(!empty($decodeWhois->nameServer) && !empty($decodeWhois->nameServer[0])){
        $description.=' '.__('base.name_server').' '.$decodeWhois->nameServer[0];
    }
    if(!empty($decodeWhois->nameServer[1])){
        $description.=', '.$decodeWhois->nameServer[1];
    }
    if(!empty($domain['attribute']['rank'])){
        $description.=' '.__('base.have_rank').' '.$domain['attribute']['rank'].' '.__('base.in_global_rank');
    }
    if(!empty($domain['attribute']['country_code']) && !empty($domain['attribute']['rank_country'])){
        $description.=' '.__('base.rank_at').' '.$domain['attribute']['country_code'].' '.__('base.is').' '.$domain['attribute']['rank_country'];
    }
    if(!empty($domain['attribute']['content'])){
        $domainContent=json_decode($domain['attribute']['content']);
    }else{
        $domainContent=array();
    }
    $ads='false';
    if(!empty($channel['siteConfig']->site_ads) && $channel['siteConfig']->site_ads=='on'){
        $ads='true';
    }
    if(!empty($domain['attribute']['ads']) && $domain['attribute']['ads']=='disable'){
        $ads='false';
    }else if($domain['status']=='blacklist' && $domain['status']=='disable' && $domain['status']=='delete'){
        $ads='false';
    }

?>
@extends('layouts.default')
@section('title', $domain['domain'].' '.mb_substr(AppHelper::instance()->renameBlacklistWord($domain['title']),0,150))
@section('description', mb_substr(AppHelper::instance()->renameBlacklistWord($domain['description']),0,320).' - '.$description)
@include('includes.header.css.css_default')
@if($ads=='true' && config('app.env')!='local')
    @section('ads')
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-6739685874678212",
                enable_page_level_ads: true
            });
        </script>
    @endsection
@endif
@section('content')
    <div class="container-scroller">
        @include('partials.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <h1><strong>{!! $domain['domain'] !!}</strong></h1>
                    <?php
                    if ($domain['updated_at'] instanceof \MongoDB\BSON\UTCDateTime) {
                        $updated_at= $domain['updated_at']->toDateTime()->setTimezone(new \DateTimeZone(config('app.timezone')))->format('Y-m-d H:i:s');
                    }else{
                        $updated_at= $domain['updated_at'];
                    }
                    ?>
                    <small>@lang('base.updated_at') {!! $updated_at !!}</small> @if(!empty($domain['view']))<small><strong>@lang('base.views'): {!! $domain['view'] !!}</strong></small>@endif<br>
                    @if(!empty($domain['title']))<strong>{!! mb_substr(AppHelper::instance()->renameBlacklistWord($domain['title']),0,150) !!}</strong>@endif
                    @if(!empty($domain['description']))<p>{!! mb_substr(AppHelper::instance()->renameBlacklistWord($domain['description']),0,320); !!}</p>@endif
                    @if(empty($domain['title']) && empty($domain['description']))
                        <div class="alert alert-info">
                            @lang('base.this_domain') {!! $domain['domain'] !!} @lang('base.not_infomation_please_access_next_time')
                        </div>
                    @endif
                    <p>
                        @if(!empty($domain['attribute']['rank']))
                            <span class="label label-primary">@lang('base.in_global_rank'): {!! AppHelper::instance()->price($domain['attribute']['rank']) !!}</span>
                            @if(!empty($domain['attribute']['country_code']))
                                <span class="">@lang('base.rank_at') <i class="flag flag-16 flag-{!! mb_strtolower($domain['attribute']['country_code']) !!}"></i> <a href="#">{!! $domain['attribute']['country_code'] !!}</a>@if(!empty($domain['attribute']['rank_country'])): {!! AppHelper::instance()->price($domain['attribute']['rank_country']) !!}@endif
                            </span>
                            @endif
                        @endif
                    </p>
                    <p>
                        @if(!empty($domain['ip']))Ip address: <a href="#">{!! $domain['ip'] !!}</a>@endif
                    </p>
                    <div class="form-group">
                        <?php
                        if(!empty($domain['scheme'])){
                            $scheme=$domain['scheme'];
                        }else{
                            $scheme='http';
                        }
                        ?>
                        <a class="btn btn-primary btn-block siteLink" id="linkContinue" href="{!! route('go.to.url',$scheme.'://'.$domain['domain']) !!}" rel="nofollow" target="blank">@lang('base.visit_to_site')
                            <p><strong>{!! $domain['domain'] !!}</strong></p>
                        </a>
                    </div>
                    @if(!empty($domain['attribute']['whois']))
                        <div class="form-group mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">@lang('base.domain_info') {!! $domain['domain'] !!}</h2>
                                    <strong>{{$domain['domain']}}</strong>@if(!empty($decodeWhois->creationDate)) @lang('base.created_at') {{$decodeWhois->creationDate}}  @endif @if(!empty($decodeWhois->expirationDate)) @lang('base.expiration_date') {{$decodeWhois->expirationDate}}. @endif @if(!empty($decodeWhois->registrar)) @lang('base.registrar') <strong>{!!$decodeWhois->registrar!!}</strong>.@endif @if(!empty($decodeWhois->nameServer)) @lang('base.name_server'): @if(!empty($decodeWhois->nameServer[0])){{$decodeWhois->nameServer[0]}}@endif @if(!empty($decodeWhois->nameServer[1]))and {{$decodeWhois->nameServer[1]}}@endif @endif. @if(!empty($domain['attribute']['rank'])) @lang('base.have_rank') {{$domain['attribute']['rank']}} @lang('base.in_global_rank'), @if(!empty($domain['attribute']['country_code']) && !empty($domain['attribute']['rank_country'])) @lang('base.rank_at') <strong>{{$domain['attribute']['country_code']}}</strong> @lang('base.is') {{$domain['attribute']['rank_country']}}@endif @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(count($siteRelate))
                        <div class="card form-group">
                            <div class="card-body">
                                <div class="card-title">
                                    @lang('base.site_relate_for_keyword') {!! $domain['domain'] !!}
                                </div>
                            </div>
                            <ul class="list-group">
                                @include('partials.site.listSite', ['sites' => $siteRelate,'showDomain'=>false,'ads'=>$ads])
                            </ul>
                        </div>
                    @endif
                    @if(!empty($domainContent->basic_info))
                        <div class="form-group mt-2">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" href="#basicInfo" data-toggle="tab"><strong>Basic</strong></a></li>
                                <li class="nav-item"><a class="nav-link" href="#info" data-toggle="tab"><strong>Website</strong></a></li>
                                <li class="nav-item"><a class="nav-link" href="#SemRush" data-toggle="tab"><strong>SemRush Metrics</strong></a></li>
                                <li class="nav-item"><a class="nav-link" href="#dns" data-toggle="tab"><strong>DNS Report</strong></a></li>
                                <li class="nav-item"><a class="nav-link" href="#ipAddress" data-toggle="tab"><strong>IP</strong></a></li>
                                <li class="nav-item"><a class="nav-link" href="#whois" data-toggle="tab"><strong>Whois</strong></a></li>
                            </ul>
                            <div class="card tab-content mb10">
                                @if(!empty($domainContent->basic_info))
                                    <div class="tab-pane active" id="basicInfo">
                                        @if($ads=='true' && config('app.env')!='local')
                                            <div class="row">
                                                <div class="col-md-4">
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
                                                </div>
                                                <div class="col-md-8">
                                                    {!!$domainContent->basic_info!!}
                                                </div>
                                            </div>
                                        @else
                                            {!!$domainContent->basic_info!!}
                                        @endif
                                    </div>
                                @endif
                                @if(!empty($domainContent->website_info))
                                    <div class="card-body tab-pane" id="info">
                                        {!!$domainContent->website_info!!}
                                    </div>
                                @endif
                                @if(!empty($domainContent->semrush_metrics))
                                    <div class="card-body tab-pane" id="SemRush">
                                        {!!$domainContent->semrush_metrics!!}
                                    </div>
                                @endif
                                @if(!empty($domainContent->dns_report))
                                    <div class="card-body tab-pane" id="dns">
                                        <div class="table-responsive">
                                            {!!$domainContent->dns_report!!}
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($domainContent->ip_address_info))
                                    <div class="card-body tab-pane" id="ipAddress">
                                        {!!$domainContent->ip_address_info!!}
                                    </div>
                                @endif
                                @if(!empty($domainContent->whois_record))
                                    <div class="card-body tab-pane" id="whois">
                                        {!!$domainContent->whois_record!!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        @if(!empty($domain['get_header']))
                            <div class="card form-group">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        @lang('base.header_info') {!! $domain['domain'] !!}
                                    </h3>
                                    @foreach($domain['get_header'] as $header)
                                        <span>{!! $header !!}</span><br>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if(!empty($domain['attribute']['dns_record']) && count($domain['attribute']['dns_record']))
                            <div class="card form-group">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        @lang('base.dns_info')
                                    </h4>
                                    <div class="table-responsive">
                                        <table class="table table-condensed">
                                            <thead><tr>
                                                <th>Host</th>
                                                <th>Type</th>
                                                <th>Class</th>
                                                <th>TTL</th>
                                                <th>Extra</th>
                                            </tr></thead>
                                            <tbody>
                                            @foreach($domain['attribute']['dns_record'] as $record)
                                                <tr>
                                                    <td>@if(!empty($record['host'])){!! $record['host'] !!}@endif</td>
                                                    <td>@if(!empty($record['type'])){!! $record['type'] !!}@endif</td>
                                                    <td>@if(!empty($record['class'])){!! $record['class'] !!}@endif</td>
                                                    <td>@if(!empty($record['ttl'])){!! $record['ttl'] !!}@endif</td>
                                                    <td>
                                                        @if(!empty($record['ip']))
                                                            <b>ip:</b> {!! $record['ip'] !!}<br>
                                                        @endif
                                                        @if(!empty($record['ipv6']))
                                                            <b>Ipv6:</b> {!! $record['ipv6'] !!}<br>
                                                        @endif
                                                        @if(!empty($record['txt']))
                                                            <b>Txt:</b> {!! $record['txt'] !!}<br>
                                                        @endif
                                                        @if(!empty($record['target']))
                                                            <b>Target:</b> {!! $record['target'] !!}<br>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
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
                    @if(!empty($domain['contents']))
                        <?php
                        $html = $domain['contents'];
                        $html=AppHelper::instance()->renameBlacklistWord($html);
                        $dom = new \DOMDocument;
                        @$dom->loadHTML($html);
                        $getH1 = $dom->getElementsByTagName('h1');
                        $getH2 = $dom->getElementsByTagName('h2');
                        $getH3 = $dom->getElementsByTagName('h3');
                        $getH4 = $dom->getElementsByTagName('h4');
                        $getH5 = $dom->getElementsByTagName('h5');
                        ?>
                        <div class="card form-group">
                            <div class="card-body">
                                <h5 class="card-title">@lang('base.tag_info_for') {!! $domain['domain'] !!}</h5>
                                @if($getH1->length>0)
                                    <p><strong>H1 Tag</strong> <span class="label label-default">{!! $getH1->length !!}</span></p>
                                    @foreach($getH1 as $h1)
                                        <span>{!! AppHelper::instance()->renameBlacklistWord($h1->nodeValue) !!}</span><br>
                                    @endforeach
                                    <hr>
                                @endif
                                @if($getH2->length>0)
                                    <p><strong>H2 Tag</strong> <span class="label label-default">{!! $getH2->length !!}</span></p>
                                    @foreach($getH2 as $h2)
                                        <span>{!! AppHelper::instance()->renameBlacklistWord($h2->nodeValue) !!}</span><br>
                                    @endforeach
                                    <hr>
                                @endif
                                @if($getH3->length>0)
                                    <p><strong>H3 Tag</strong> <span class="label label-default">{!! $getH3->length !!}</span></p>
                                    @foreach($getH3 as $h3)
                                        <span>{!! AppHelper::instance()->renameBlacklistWord($h3->nodeValue) !!}</span><br>
                                    @endforeach
                                    <hr>
                                @endif
                                @if($getH4->length>0)
                                    <p><strong>H4 Tag</strong> <span class="label label-default">{!! $getH4->length !!}</span></p>
                                    @foreach($getH4 as $h4)
                                        <span>{!! AppHelper::instance()->renameBlacklistWord($h4->nodeValue) !!}</span><br>
                                    @endforeach
                                    <hr>
                                @endif
                                @if($getH5->length>0)
                                    <p><strong>H5 Tag</strong> <span class="label label-default">{!! $getH5->length !!}</span></p>
                                    @foreach($getH5 as $h5)
                                        <span>{!! AppHelper::instance()->renameBlacklistWord($h5->nodeValue) !!}</span><br>
                                    @endforeach
                                    <hr>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                @include('includes.footer.footer')
            </div>
        </div>
    </div>
@endsection
@include('includes.footer.script.script_default')
