@extends('layouts.default')
@section('title', (!empty($channel['siteConfig']->site_name)?$channel['siteConfig']->site_name:''))
@include('includes.header.css.css_default')
@section('content')
    <div class="container-scroller">
        @include('partials.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <a href="{!! route('keyword.of.page.add') !!}">Thêm từ khóa mới</a>
                    @if(count($keywords))
                    <ul class="list-group">
                        @foreach($keywords as $item)
                            <li class="list-group-item"><a href="{!! route('keyword.of.page.update',$item['_id']) !!}">{!! $item['keyword'] !!}</a></li>
                        @endforeach
                    </ul>
                        {{ $keywords->links() }}
                    @else
                        <div class="alert alert-danger">Chưa có bất kỳ từ khóa nào cho trang này! </div>
                    @endif
                </div>
                @include('includes.footer.footer')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@endsection
@include('includes.footer.script.script_default')
