<div>

    @if (session('error'))
        @include('livewire.includes.alert-error', [
            'header' => 'Error',
        ])
    @endif


    


    <div class="relative flex flex-col justify-center min-h-screen py-6 overflow-hidden bg-gray-50 sm:py-12">
        <img src="{{ asset('storage/gambar/beams-2.jpg') }}" alt=""
            class="absolute -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2 max-w-none" width="1308" />
        <div style="background: url('storage/gambar/grid.svg')"
            class="absolute inset-0  bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
        </div>
        <div
            class="relative w-full px-6 pt-10 pb-8 bg-white shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-5">
            <div class="max-w-md mx-auto">
                <div class="flex space-x-2">
                    <h1 class="text-4xl font-bold text-indigo-600">APPS</h1>
                    <h1 class="text-4xl font-light text-indigo-900">FMIPA</h1>
                </div>
                <div class="divide-y divide-gray-300/50">
                    <div class="py-2 space-y-6 text-base leading-7 text-gray-600">
                        <p>Log in to your account</p>
                        <form class="" wire:submit="login">
                            <div class="mb-5">
                                <label for="username"
                                    class="block mb-2 text-sm font-medium text-gray-600">Username</label>

                                <input value="{{ old('username') }}" autofocus autocomplete type="text"
                                    wire:model="username" id="username" name="username"
                                    class="block w-full p-3 bg-gray-200 border border-transparent rounded focus:outline-none" />
                            </div>

                            <div class="mb-5">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-600">Password</label>

                                <input type="password" value="{{ old('password') }}" wire:model="password"
                                    id="password" name="password"
                                    class="block w-full p-3 bg-gray-200 border border-transparent rounded focus:outline-none" />
                            </div>
                            <button type="submit" wire:loading.attr="disabled"
                                class="w-full p-3 mt-4 text-white bg-indigo-600 rounded shadow">
                                <div wire:loading
                                    class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-white rounded-full dark:text-white"
                                    role="status" aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span wire:loading.remove wire.target="save">Masuk</span>
                            </button>

                        </form>
                    </div>
                    <div class="pt-8 text-sm">
                        <p class="text-gray-700">© 2024 Apps MIPA - All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<script>
    $(document).ready(function() {

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




    });
</script>
