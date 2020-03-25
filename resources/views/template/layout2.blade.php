<!-- =========================================================
* Argon Dashboard PRO v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2019 Creative Tim (https://www.creative-tim.com)

* Coded by Creative Tim=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
Software.
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>M-Perpus Enhanced Version - @yield('title')</title>
    @include('template.styles')
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                @if (URL::current()==route('dashboard'))
                <a class="navbar-brand" href="#">
                    @else
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        @endif
                        <img src="../../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
                    </a>
                    <div class="ml-auto">
                        <!-- Sidenav toggler -->
                        <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin"
                            data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </div>
            </div>
            @include('template.menu')
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        @include('template.topnavbar')
        @yield('content')
        <!-- Footer -->
        @include('template.footer')
    </div>
    @include('template.scripts')
</body>

</html>
