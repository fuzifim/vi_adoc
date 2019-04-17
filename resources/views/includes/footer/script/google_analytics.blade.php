
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-6369288-8"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-6369288-8');
    @if(!empty($channel['siteConfig']->google_analytics_account))
    gtag('config', '{!! $channel['siteConfig']->google_analytics_account !!}');
    @endif
</script>