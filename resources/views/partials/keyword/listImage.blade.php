<div class="card form-group">
    <div class="card-body">
        <h2 class="card-title">@lang('base.image_relate_for') {!! $keyword['keyword'] !!}</h2>
        <div class="form-group">
            <?php $a=0; ?>
            @foreach($keyword['image_relate'] as $imageRelate)
                <?php
                $a++;
                ?>
                @if($a==1)
                    <?php
                    $image=DB::connection('mongodb')->collection('mongo_image')
                        ->where('_id', (string)$imageRelate)->first();
                    ?>
                    <img class="mx-auto d-block" id="showImageLarge" src="https:{{$image['attribute']['image']}}" alt="{{$image['title']}}" title="{{$image['title']}}">
                    <h3 class="subtitle text-center"><span class="" id="showImageLargeLink"><span class="">{{$image['title']}}</span></span></h3>
                    <?php break; ?>
                @endif
            @endforeach
        </div>
        <div class="form-group" id="thumbImage">
            <div class="row row-pad-5">
                @foreach(array_slice($keyword['image_relate'], 1, 6) as $imageRelate)
                    <?php
                    $image=DB::connection('mongodb')->collection('mongo_image')
                        ->where('_id', (string)$imageRelate)->first();
                    ?>
                    <div class="col col-md-2 col-xs-2 mb-2">
                        <a class="showImageLink" href="https:{{$image['attribute']['image']}}" data-image="https:{{$image['attribute']['image']}}" data-title="{{$image['title']}}" data-url=""><img class="img-fluid" src="https:{{$image['attribute']['thumb']}}" alt="{{$image['title']}}" title="{{$image['title']}}"></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>