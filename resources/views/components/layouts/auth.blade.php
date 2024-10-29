<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>
    @livewireStyles
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        .fade-out {
            transition: opacity 1s ease-out;
        }

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
                transform: translateY(-10px);
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
            animation: fadeIn 1s forwards;
            /* Fade-in effect */
        }

        .fade-out-up {
            animation: slideUp 1s forwards;
            /* Adjust duration as needed */
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="flex items-center h-full py-16 bg-gray-100 dark:bg-neutral-800">
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" class="w-full max-w-md p-6 mx-auto">
        {{ $slot }}
    </main>


    <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.min.js"></script>

</body>

</html>
