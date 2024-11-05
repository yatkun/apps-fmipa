<div>

    @if (session('error'))
        @include('livewire.includes.alert-error', [
            'header' => 'Error',
        ])
    @endif
    <div class="bg-white border border-gray-200 shadow-sm mt-7 rounded-xl dark:bg-neutral-900 dark:border-neutral-700">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign in</h1>

            </div>

            <div class="mt-5">


                <!-- Form -->
                <form wire:submit="login">
                    <div class="grid gap-y-4">
                        <!-- Form Group -->
                        <div>
                            <label for="username" class="block mb-2 text-sm dark:text-white">Username</label>
                            <div class="relative">
                                <input type="text" wire:model="username" id="username" name="username"
                                    class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    aria-describedby="email-error" value="{{ old('username') }}">
                                <div class="absolute inset-y-0 hidden pointer-events-none end-0 pe-3">
                                    <svg class="text-red-500 size-5" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="hidden mt-2 text-xs text-red-600" id="email-error">Please include a valid email
                                address so we can get back to you</p>
                        </div>
                        <!-- End Form Group -->

                        <!-- Form Group -->
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block mb-2 text-sm dark:text-white">Password</label>
                                <a class="inline-flex items-center text-sm font-medium text-blue-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500"
                                    href="../examples/html/recover-account.html">Forgot password?</a>
                            </div>
                            <div class="relative">
                                <input type="password" wire:model="password" id="password" name="password" value="{{ old('password') }}"
                                    class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    aria-describedby="password-error">
                                <div class="absolute inset-y-0 hidden pointer-events-none end-0 pe-3">
                                    <svg class="text-red-500 size-5" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="hidden mt-2 text-xs text-red-600" id="password-error">8+ characters required</p>
                        </div>
                        <!-- End Form Group -->

                        <!-- Checkbox -->
                        <div class="flex items-center">
                            <div class="flex">
                                <input id="remember-me" name="remember-me" type="checkbox"
                                    class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                            </div>
                            <div class="ms-3">
                                <label for="remember-me" class="text-sm dark:text-white">Remember me</label>
                            </div>
                        </div>
                        <!-- End Checkbox -->

                        <button type="submit" wire:loading.attr="disabled"
                            class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            <span wire:loading wire.target="save">Masuk..</span>
                            <span wire:loading.remove wire.target="save">Masuk</span>
                            </button>
                    </div>
                </form>
                <!-- End Form -->
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
