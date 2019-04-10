<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @if(count($channel['keywordPrimary']))
            @foreach($channel['keywordPrimary'] as $item)
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('keyword.show',AppHelper::instance()->characterReplaceUrl($item['keyword'])) !!}">
                        <i class="mdi mdi mdi-chevron-double-right menu-icon"></i>
                        <span class="menu-title">{!! $item['keyword'] !!}</span>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</nav>