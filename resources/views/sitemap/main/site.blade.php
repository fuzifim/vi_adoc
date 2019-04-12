<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- http://cungcap.net -->

    <url>
        <loc>{{route('channel.home',$channel['domainPrimary'])}}</loc>
    </url>
	@if(count($channel['info']->joinCategory))
	@foreach($channel['info']->joinCategory as $joinCategory)
	<url>
        <loc>{{route('channel.slug',array($channel['domainPrimary'],$joinCategory->category->getSlug->slug_value))}}</loc>
    </url>
	@endforeach
	@endif
	@if(count($posts)>0)
	@foreach($posts as $post)
	<url>
        <loc>{{route('channel.slug',array($channel['domain']->domain,$post->getSlug->slug_value))}}</loc>
    </url>
	@endforeach
	@endif
</urlset>