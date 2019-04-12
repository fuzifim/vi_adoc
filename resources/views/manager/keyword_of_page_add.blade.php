@extends('layouts.default')
@section('title', 'A Document Việt Nam')
@include('includes.header.css.css_default')
@section('content')
    <div class="container-scroller">
        @include('partials.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <form method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Thông tin từ khóa</h4>
                                <p class="card-description">
                                    Basic form layout
                                </p>
                                <form class="forms-sample">
                                    @if(!empty($keyword['_id']))
                                        <input type="hidden" name="keywordid" value="{!! $keyword['_id'] !!}">
                                    @endif
                                    <div class="form-group">
                                        <label for="keywordname">Từ khóa</label>
                                        <input type="text" class="form-control" name="keywordname" id="keywordname" placeholder="Nhập từ khóa" @if(!empty($keyword['keyword'])) value="{!! $keyword['keyword']!!}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="orderNumber">Thứ tự sắp xếp</label>
                                        <input type="number" class="form-control" name="orderNumber" id="orderNumber" placeholder="Số thứ tự" @if(!empty($keyword['keyword']) && !empty($keyword['order_number'])) value="{!! $keyword['order_number'] !!}"@endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="lang">Lang</label>
                                        <input type="text" class="form-control" id="lang" placeholder="lang" value="{!! config('app.locale') !!}" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
                @include('includes.footer.footer')
            </div>
        </div>
    </div>
@endsection
@include('includes.footer.script.script_default')
