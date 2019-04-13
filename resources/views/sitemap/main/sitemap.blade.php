<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- https://{{config('app.url')}} -->

    <url>
        <loc>https://{{config('app.url')}}</loc>
    </url>
@if($sitemapIndex=='false')
	@if($type=='_category.xml')
		@if(count($getNote))
		@foreach($getNote as $item)
		<url>
			<loc>{!! route('keyword.show.id',array($item['_id'],str_slug(mb_substr($item['keyword'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}</loc>
		</url>
		@endforeach

		@endif
	@endif
		@if($type=='_domain.xml')
			@if(count($getNote))
				@foreach($getNote as $item)
					<url>
						<loc>{!! route('domain.show',$item['domain']) !!}</loc>
					</url>
				@endforeach

			@endif
		@endif
	@else
	<url>
        <loc>https://{{config('app.url')}}/sitemap_category.xml</loc>
    </url>
	<url>
        <loc>https://{{config('app.url')}}/sitemap_domain.xml</loc>
    </url>
@endif
</urlset>