<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- http://cungcap.net -->
	@if(count($getChannel)>0)
	@foreach($getChannel as $subChannel)
	<?
		if($subChannel->domainJoinPrimary->domain->domain_primary!='default'){
			if(count($subChannel->domainAll)>0){
				foreach($subChannel->domainAll as $domain){
					if($domain->domain->domain_primary=='default'){
						$domainPrimary=$domain->domain->domain; 
					}
				}
			}else{
				$domainPrimary=$subChannel->domainJoinPrimary->domain->domain; 
			}
		}else{
			$domainPrimary=$subChannel->domainJoinPrimary->domain->domain; 
		}
	?>
	<url>
        <loc>{{route('channel.home',$domainPrimary)}}</loc>
    </url>
	@endforeach
	@endif
    @if(count($posts)>0)
	@foreach($posts as $post)
	<?
		$getChannelPost=\App\Model\Channel::join('posts_join_channel','posts_join_channel.channel_id','=','channel.id')
		->where('posts_join_channel.posts_id','=',$post->id)->select('channel.*')->first(); ; 
		if($getChannelPost->domainJoinPrimary->domain->domain_primary!='default'){
			if(count($getChannelPost->domainAll)>0){
				foreach($getChannelPost->domainAll as $domain){
					if($domain->domain->domain_primary=='default'){
						$domainPrimary=$domain->domain->domain; 
					}
				}
			}else{
				$domainPrimary=$getChannelPost->domainJoinPrimary->domain->domain; 
			}
		}else{
			$domainPrimary=$getChannelPost->domainJoinPrimary->domain->domain; 
		}
	?>
	<url>
        <loc>{{route('channel.slug',array($domainPrimary,$post->getSlug->slug_value))}}</loc>
    </url>
	@endforeach
	@endif
</urlset>