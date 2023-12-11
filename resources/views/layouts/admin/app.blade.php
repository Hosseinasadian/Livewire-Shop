<!DOCTYPE html>
<html dir="{{config('locale')[app()->getLocale()]['dir']}}" lang="{{app()->getLocale()}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/dist/images/logos/favicon.ico')}}">

    <title>
        @yield('title')
    </title>

    @stack('styles')
    <style>
        .accordion-header.has-error{
            box-shadow: inset red -3px 4px 0px 3px;
        }
    </style>

    <!-- Core Css -->
    <link href="{{asset('admin/dist/css/style.min.css')}}" rel="stylesheet">

    @if(file_exists(public_path('admin/dist/css/lang/'.app()->getLocale().'.css')))
        <link href="{{asset('admin/dist/css/lang/'.app()->getLocale().'.css')}}" rel="stylesheet">
    @endif

    @livewireStyles

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<!-- Preloader -->

<div class="preloader">
    <img src="{{asset('admin/dist/images/logos/favicon.ico')}}" alt="loader" class="lds-ripple img-fluid"/>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div
    class="page-wrapper"
    id="main-wrapper"
    data-layout="vertical"
    data-navbarbg="skin6"
    data-sidebartype="full"
    data-sidebar-position="fixed"
    data-header-position="fixed"
>

    @include('admin.partials.aside')

    <div class="body-wrapper">

        @include('admin.partials.header')

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <div class="dark-transparent sidebartoggler"></div>

    @include('admin.partials.search-results')
</div>

<script src="{{asset('admin/dist/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin/dist/libs/simplebar/dist/simplebar.min.js')}}"></script>
<script src="{{asset('admin/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('admin/dist/js/app.min.js')}}"></script>
<script src="{{asset('admin/dist/js/app.init.js')}}"></script>
<script src="{{asset('admin/dist/js/app-style-switcher.js')}}"></script>
<script src="{{asset('admin/dist/js/sidebarmenu.js')}}"></script>
<script src="{{asset('admin/dist/js/custom.js')}}"></script>

@stack('scripts')
@livewireScripts

</body>

</html>
