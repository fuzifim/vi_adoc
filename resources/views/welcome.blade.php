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
                    Bộ tài liệu lưu trữ thông tin sản phẩm, dịch vụ, phương tiện, ngành nghề thuộc các lĩnh vực, các khu vực, các quốc gia!
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
