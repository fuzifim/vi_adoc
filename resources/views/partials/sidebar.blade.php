<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @if(count($channel['keywordPrimary']))
            @foreach($channel['keywordPrimary'] as $item)
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('keyword.show.id',array($item['_id'],str_slug(mb_substr($item['keyword'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}">
                        <i class="mdi mdi mdi-chevron-double-right menu-icon"></i>
                        <span class="menu-title">{!! $item['keyword'] !!}</span>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</nav>