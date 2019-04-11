<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- https://cungcap.net -->

    <url>
        <loc>https://cungcap.net</loc>
    </url>
    <url>
        <loc>https://cungcap.net/channel/add</loc>
    </url>
    <url>
        <loc>https://cungcap.net/web-design</loc>
    </url>
	<url>
        <loc>https://cungcap.net/domain</loc>
    </url>
	<url>
        <loc>https://cungcap.net/email</loc>
    </url>
	<url>
        <loc>https://cungcap.net/hosting</loc>
    </url>
	<url>
        <loc>https://cungcap.net/cloud</loc>
    </url>
	<url>
        <loc>https://cungcap.net/tin-tuc</loc>
    </url>
	<url>
        <loc>https://cungcap.net/company</loc>
    </url>
	<url>
        <loc>https://cungcap.net/sitelink</loc>
    </url>
	@foreach($getSite as $site)
	<url>
        <loc>http://{{$site->domain}}.{{config('app.url')}}</loc>
    </url>
	@endforeach
	@foreach($getCompany as $company)
	<url>
        <loc>https://com-{{$company->id}}.{{config('app.url')}}</loc>
    </url>
	@endforeach
	@foreach($getNews as $news)
	<url>
        <loc>https://news-{{$news->id}}.{{config('app.url')}}</loc>
    </url>
	@endforeach
	@foreach($getFeed as $feed)
	<url>
        <loc>https://feed-{{$feed->id}}.{{config('app.url')}}</loc>
    </url>
	@endforeach
</urlset>