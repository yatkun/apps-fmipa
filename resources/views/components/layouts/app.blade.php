<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="https://preline.co/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        @stack('styles')

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    
    @livewireStyles
    <style>
        ul.breadcrumb {
          padding: 10px 16px;
          list-style: none;
          background-color: #fff;
        }
        ul.breadcrumb li {
          display: inline;
          font-size: 13px;
        }
        ul.breadcrumb li+li:before {
          padding: 8px;
          color: black;
          content: "/\00a0";
        }
        ul.breadcrumb li a {
          color: #0275d8;
          text-decoration: none;
        }
        ul.breadcrumb li a:hover {
          color: #01447e;
          text-decoration: underline;
        }
        </style>
    <style>
        .error-notif {
            position: fixed;
            left: 0px;
            right: 0px;
            z-index: 9999;
            display: flex;
            justify-content: center;
            display: hidden;
            top: 1.25rem;

        }

        .notif-content {
            display: flex;
            align-items: center;
            background: #ffffff;
            
            gap: 1rem;
            padding-left: 0.75rem
                /* 12px */
            ;
            padding-right: 0.75rem
                /* 12px */
            ;
            padding-top: 0.75rem
                /* 12px */
            ;
            padding-bottom: 0.75rem
                /* 12px */
            ;
            border-radius: 0.125rem
                /* 2px */
            ;
        }
    </style>


    <style>
        @keyframes slideUp {
            0% {

                opacity: 1;

            }

            100% {
                transform: translateY(-40px);
                /* Adjust the distance as needed */
                opacity: 0;

            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                /* Start invisible */
                transform: translateY(-40px);
                /* Optional: Slide down effect */
            }

            100% {
                opacity: 1;
                /* Fully visible */
                transform: translateY(0);
                /* Return to original position */
            }
        }

        .fade-in {
            animation: fadeIn 0.3s forwards;
            /* Fade-in effect */
        }

        .fade-out-up {
            animation: slideUp 0.1s forwards;
            /* Adjust duration as needed */
        }

        .fade-in.show {
            opacity: 1;
        }
    </style>

   
</head>

<body data-sidebar="dark" data-layout-mode="light">
    <x-navbar></x-navbar>

    <x-menu-link></x-menu-link>

    {{ $slot }}
    {{ $scripts ?? '' }}



    @livewireScripts

    <script data-navigate-once>
        Livewire.on('closemodal', function() {
            $('#modal').modal('hide'); // Jika Anda menggunakan Bootstrap modal
            $('#modal2').modal('hide'); // Jika Anda menggunakan Bootstrap modal
        });

        Livewire.on('showDeleteConfirmation', id => {
            if (confirm('Apakah anda yakin menghapus data ini ?')) {
                Livewire.dispatch('confirmDelete', id); // Emit only if confirmed
            }
        });
    </script>

   

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}" data-navigate-track></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}" data-navigate-track></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}" data-navigate-track></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}" data-navigate-track></script>


    @stack('scripts')

    
</body>

</html>
