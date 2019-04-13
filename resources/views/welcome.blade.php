@extends('layouts.default')
@section('title', 'A Doc Việt Nam')
@include('includes.header.css.css_default')
@section('content')
    <div class="container-scroller">
        @include('partials.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-description">
                                Bộ tài liệu lưu trữ thông tin sản phẩm, dịch vụ, phương tiện, ngành nghề thuộc các lĩnh vực, các khu vực, các quốc gia!</p>
                            <h3 class="card-title">Từ khóa mới cập nhật</h3>
                            @if(count($newKeyword))
                                @foreach($newKeyword as $item)
                                    <a class="badge badge-secondary mb-1" href="{!! route('keyword.show.id',array($item['_id'],str_slug(mb_substr($item['keyword'], 0, \App\Model\Mongo_keyword::MAX_LENGTH_SLUG),'-'))) !!}">{!! $item['keyword'] !!}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @include('includes.footer.footer')
            </div>
        </div>
    </div>
@endsection
@include('includes.footer.script.script_default')
