<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    @livewireStyles
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <style>
        #hs-application-sidebar {
            @apply hidden;
            /* Menggunakan Tailwind untuk menyembunyikan */
        }

        #hs-application-sidebar.show {
            @apply block;
            /* Menampilkan sidebar */
        }

        .dt-layout-row:has(.dt-search),
        .dt-layout-row:has(.dt-length),
        .dt-layout-row:has(.dt-paging) {
            display: none !important;
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

        .card {
            padding: 24px;
            border: 1px solid #ffffff1f;
            border-radius: 18px;
            background: linear-gradient(193deg, #6a6dd982 53%, #a695fb78 100%);
            box-shadow: inset 0 0 6px hsla(0, 0%, 100%, 0.2);
            position: relative;
            max-width: 300px;
            transition: all 1.7s ease;
            margin: 28px auto;
        }

        .card:hover {
            box-shadow: inset 0 0 6px hsla(0, 0%, 100%, 0.4);
        }

        .card::before {
            content: "";
            position: absolute;
            width: 50%;
            height: 1px;
            background: linear-gradient(45deg, #ffffff00, #ffffff 50%, #ffffff00);
            top: -1px;
            right: 20px;
            transition: all 1.4s ease;
        }

        .card:hover::before {
            right: calc(50% - 20px);
        }

        .card::after {
            content: "";
            position: absolute;
            width: 50%;
            height: 1px;
            background: linear-gradient(45deg, #ffffff00, #ffffff87 50%, #ffffff00);
            bottom: -1px;
            left: 20px;
            transition: all 1.4s ease;
        }

        .card:hover::after {
            left: calc(50% - 20px);
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-neutral-900">
    <x-navbar></x-navbar>
    <x-breadcrumb></x-breadcrumb>
    <x-menu-link></x-menu-link>

    {{ $slot }}
    {{ $scripts ?? '' }}



    @livewireScripts
    <script data-navigate-once>
        Livewire.on('iku1store', () => {
            HSOverlay.close('#hs-scale-animation-modal');
            HSOverlay.close('#iku1-edit-modal');
            HSOverlay.close('#ModalAddIku2a');
            HSOverlay.close('#ModalAddIku2b');
            HSOverlay.close('#ModalAddIku3');
            HSOverlay.close('#ModalAddIku4');
        });

        Livewire.on('openModal', () => {
            HSOverlay.open('#iku1-edit-modal');
        });

        Livewire.on('modalIku2a', () => {
            HSOverlay.open('#ModalAddIku2a');

        });
        Livewire.on('modalIku2b', () => {
            HSOverlay.open('#ModalAddIku2b');

        });
        Livewire.on('modalIku3', () => {
            HSOverlay.open('#ModalAddIku3');

        });

        Livewire.on('openModalIku2a', () => {
            HSOverlay.open('#ModalAddIku2a');
        });

        Livewire.on('openModalIku2b', () => {
            HSOverlay.open('#ModalAddIku2b');
        });

        Livewire.on('showDeleteConfirmation', id => {
            if (confirm('Apakah anda yakin menghapus data ini ?')) {
                Livewire.dispatch('confirmDelete', id); // Emit only if confirmed
            }
        });

        Livewire.on('notif', () => {
            setTimeout(() => {
                const alertBox = document.getElementById('custom-alert');

                if (alertBox) {
                    alertBox.classList.remove('hidden'); // Ensure the alert is shown
                    alertBox.classList.add('fade-in'); // Apply fade-in effect

                    setTimeout(() => {
                        alertBox.classList.add(
                            'fade-out-up'
                        ); // Tambahkan kelas opacity-0 untuk efek fade-out
                        setTimeout(() => alertBox.remove(),
                            1000
                        ); // Hapus elemen setelah durasi fade-out selesai (1 detik)
                    }, 3000)

                }
            });
        })
    </script>
    <script></script>
    <script data-navigate-once>
        document.addEventListener("livewire:navigated", () => {

            window.HSStaticMethods.autoInit();

        });
    </script>





</body>



</html>
