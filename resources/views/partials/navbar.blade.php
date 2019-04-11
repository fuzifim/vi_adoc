<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="{!! route('home') !!}">A Doc</a>
            <a class="navbar-brand brand-logo-mini" href="{!! route('home') !!}">Doc</a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-sort-variant"></span>
            </button>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
            <li class="nav-item nav-search d-none d-lg-block w-100">
                <div class="input-group">
                    <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
                    </div>
                    <input type="text" class="form-control" placeholder="@lang('base.search')" aria-label="search" aria-describedby="search">
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            @if(Auth::check())
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">{!! \Auth::user()->name !!}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    @if(Auth::user()->id==1)
                    <a class="dropdown-item" href="{!! route('keyword.of.page') !!}">
                        <i class="mdi mdi-logout text-primary"></i>
                        @lang('base.keyword_of_page')
                    </a>
                    @endif
                    <a class="dropdown-item" href="{!! route('logout') !!}">
                        <i class="mdi mdi-logout text-primary"></i>
                        @lang('base.logout')
                    </a>
                </div>
            </li>
            @else
                <li class="nav-item nav-profile">
                    <a class="nav-link" href="{!! route('login') !!}">@lang('base.login')</a>
                </li>
            @endif
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>