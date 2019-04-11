<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<rss version="2.0">
<channel>
<title>Cung Cấp</title><link>https://cungcap.net/rss</link><description>Cung Cấp sản phẩm, dịch vụ kinh doanh doanh đến mọi người ⭐ ⭐ ⭐ ⭐ ⭐</description><copyright>Copyright (C) Cung Cấp</copyright><lastBuildDate>{!!\Carbon\Carbon::now()!!}</lastBuildDate><generator>Cung Cấp</generator><image><url>https://cungcap.net/assets/img/logo-red-white.svg</url><title>Cung Cấp. Net</title><link>https://cungcap.net</link></image>
@foreach($getNews as $news)
<item>
	<title>{!!$news->title!!}</title>
	<link>https://news-{{$news->id}}.{{config('app.url')}}</link>
	<pubDate>{{$news->updated_at}}</pubDate>
	<description><![CDATA[@if(!empty($news->image))<a href="https://news-{{$news->id}}.{{config('app.url')}}"><img width=130 height=100 src="https:{{$news->image}}" ></a></br>@endif{!!$news->description!!}]]></description>
	@if(!empty($news->image))<enclosure type="image/jpeg" url="https:{{$news->image}}"/>@endif
</item>
@endforeach
@foreach($getFeed as $feed)
<item>
	<title>{!!$feed->title!!}</title>
	<link>https://feed-{{$feed->id}}.{{config('app.url')}}</link>
	<pubDate>{{$feed->updated_at}}</pubDate>
	<description><![CDATA[@if(!empty($feed->image))<a href="https://feed-{{$feed->id}}.{{config('app.url')}}"><img width=130 height=100 src="https:{{$feed->image}}" ></a></br>@endif{!!$feed->description!!}]]></description>
	@if(!empty($feed->image))<enclosure type="image/jpeg" url="https:{{$feed->image}}"/>@endif
</item>
@endforeach
</channel></rss>