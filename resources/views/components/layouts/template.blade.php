<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<!-- Icons Css -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @livewireStyles
    
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
            animation: fadeIn 0.5s forwards;
            /* Fade-in effect */
        }

        .fade-out-up {
            animation: slideUp 1s forwards;
            /* Adjust duration as needed */
        }
    </style>
@stack('styles')
</head>

<body data-sidebar="dark" data-layout-mode="light">
  
    {{ $slot }}

    <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.min.js"></script>
    @livewireScripts
    {{-- <script>
        (function() {
            function textareaAutoHeight(el, offsetTop = 0) {
                el.style.height = 'auto';
                el.style.height = `${el.scrollHeight + offsetTop}px`;
            }

            (function() {
                const textareas = [
                    '#hs-tac-message'
                ];

                textareas.forEach((el) => {
                    const textarea = document.querySelector(el);
                    const overlay = textarea.closest('.hs-overlay');

                    if (overlay) {
                        const {
                            element
                        } = HSOverlay.getInstance(overlay, true);

                        element.on('open', () => textareaAutoHeight(textarea, 3));
                    } else textareaAutoHeight(textarea, 3);

                    textarea.addEventListener('input', () => {
                        textareaAutoHeight(textarea, 3);
                    });
                });
            })();
        })()
    </script> --}}





</body>

</html>
