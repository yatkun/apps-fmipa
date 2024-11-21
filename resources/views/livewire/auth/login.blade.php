<div>

    @if (session('error'))
        @include('livewire.includes.alert-error', [
            'header' => 'Error',
        ])
    @endif


    <section class="flex flex-col md:flex-row h-screen items-center">

        <div class="bg-slate-100 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen relative">
            <img src="{{ asset('storage/gambar/login3.JPG') }}" class="h-full w-full object-cover absolute">
            {{-- <div class="absolute w-full h-full p-24">
                <div class="bg-white bg-opacity-55 border-white border border-opacity-60 h-full p-10 rounded-lg text-white text-4xl italic font-bold">Digitalizing MIPA, Right at Your Fingertips</div>
            </div> --}}
            {{-- <img src="https://images.unsplash.com/photo-1444313431167-e7921088a9d3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1441&q=100" alt="" class="w-full h-full object-cover"> --}}
        </div>

        <div
            class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
              flex items-center justify-center">

            <div class="w-full h-100">

                <h1 class="text-3xl font-bold">APPS MIPA</h1>

                <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">Log in to your account</h1>

                <form class="mt-6" wire:submit="login">
                    <div>
                        <label class="block text-gray-700">Username</label>

                        <input type="text" wire:model="username" id="username" name="username"
                            class="block mt-2 w-full px-4 py-3 text-sm border bg-gray-200 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            aria-describedby="email-error" value="{{ old('username') }}" autofocus autocomplete
                            required>
                    </div>

                    <div class="mt-4">
                        <label class="block text-gray-700">Password</label>


                        <input type="password" wire:model="password" id="password" name="password"
                            value="{{ old('password') }}"
                            class="mt-2 block w-full px-4 py-3 text-sm border bg-gray-200 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            aria-describedby="password-error">

                    </div>


                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full block bg-blue-500 hover:bg-blue-400 focus:bg-blue-400 text-white font-semibold rounded-lg
                    px-4 py-3 mt-6">
                        <div wire:loading
                            class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-white rounded-full dark:text-white"
                            role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span wire:loading.remove wire.target="save">Masuk</span>
                    </button>
                </form>

                <hr class="my-6 border-gray-300 w-full">



                <p class="text-sm text-gray-500 mt-12">&copy; 2024 Apps MIPA - All Rights Reserved.</p>
            </div>
        </div>

    </section>



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
