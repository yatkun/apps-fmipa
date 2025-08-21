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
            display: none; /* Hidden by default */
            justify-content: center;
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

        .required:after {
            content: " *";
            color: red;
        }
    </style>


</head>

<body data-sidebar="dark" data-layout-mode="light">
    <x-navbar></x-navbar>

    <x-menu-link></x-menu-link>
    @if (session('success'))
        @include('livewire.includes.alert-success', [
            'header' => 'Sukses',
        ])
    @endif
    @if (session('error'))
        @include('livewire.includes.alert-error', [
            'header' => 'Sukses',
        ])
    @endif


     
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

        // Alert auto-show and auto-hide functionality
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('custom-alert');
            if (alert) {
                // Show alert with fade-in animation
                alert.style.display = 'flex';
                alert.classList.add('fade-in');
                
                // Auto-hide alert after 4 seconds
                setTimeout(function() {
                    alert.classList.remove('fade-in');
                    alert.classList.add('fade-out-up');
                    
                    // Remove alert from DOM after animation completes
                    setTimeout(function() {
                        alert.style.display = 'none';
                    }, 300);
                }, 4000);
            }
        });

        // Listen for profile update event from Livewire
        Livewire.on('profile-updated', () => {
            // Show alert after profile update
            setTimeout(() => {
                const alert = document.getElementById('custom-alert');
                if (alert) {
                    alert.style.display = 'flex';
                    alert.classList.add('fade-in');
                    
                    setTimeout(function() {
                        alert.classList.remove('fade-in');
                        alert.classList.add('fade-out-up');
                        
                        setTimeout(function() {
                            alert.style.display = 'none';
                        }, 300);
                    }, 4000);
                }
            }, 100);
        });
    </script>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}" data-navigate-track></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}" data-navigate-track></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}" data-navigate-track></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}" data-navigate-track></script>

    <!-- App js -->
    @stack('scripts')




    <script src="{{ asset('assets/js/app.js') }}" data-navigate-track></script>



</body>

</html>
