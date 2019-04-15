<!DOCTYPE html>
<html>
<head>
    <title>@if(!empty($channel['siteConfig']->site_name)){!! $channel['siteConfig']->site_name !!}@endif</title>
    <meta charset="utf-8">
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    @if($ads=='true')
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-6739685874678212",
                enable_page_level_ads: true
            });
        </script>
    @endif
</head>
<body>

<div class="container">
    <div class="container">
        <div class="card-body">
            <div class="form-group">
                <div class="alert alert-dark">
                    This URL (<strong><span id="linkUrl"></span></strong>) is not belong to @if(!empty($channel['siteConfig']->site_name)){!! $channel['siteConfig']->site_name !!}@endif, if you want to continue, please click bellow button to redirect to
                </div>
            </div>
            @if($ads=='true')
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
            <div class="form-group">
                <a class="btn btn-success btn-block" id="linkContinue" href="">Click here to continue <span id="timeLeft">5</span></a>
            </div>
        </div>
    </div>
    <script type="application/ld-json" id="json-url">{!!json_encode($url)!!}</script>
    <script type="text/javascript">
        var redirUrl=jQuery.parseJSON(jQuery("#json-url").html());

        jQuery(document).ready(function(){
            jQuery("#linkContinue").attr("href",redirUrl);
            jQuery("#linkUrl").html(redirUrl);
        });
        var count = 5;
        setInterval(function(){
            document.getElementById('timeLeft').innerHTML = count;
            if (count == 0) {
                window.location = redirUrl;
            }
            count--;
        },1000);
    </script>
</div>
</body>
</html>