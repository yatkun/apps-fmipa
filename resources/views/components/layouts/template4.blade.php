<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | Skote - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap Css -->
  
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <title>{{ $title ?? config('app.name') }}</title>
    @livewireStyles
   

    <style>
        .error-notif{
            position: fixed;
            left: 0px;
            right: 0px;
            z-index: 9999;
            display: flex;
            justify-content: center;
            display: hidden;
            top: 1.25rem;
        }
        .notif-content{
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-left: 0.75rem /* 12px */;
            padding-right: 0.75rem /* 12px */;
            padding-top: 0.75rem /* 12px */;
        padding-bottom: 0.75rem /* 12px */;
        border-radius: 0.125rem /* 2px */;
        }
    </style>
</head>

<body data-sidebar="dark" data-layout-mode="light">
   
    <div id="layout-wrapper">

        <x-navbar></x-navbar>
        {{ $slot }}
       

    </div>

    @livewireScripts
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>
