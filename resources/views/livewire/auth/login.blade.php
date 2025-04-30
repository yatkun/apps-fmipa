<div>

    @if (session('error'))
        @include('livewire.includes.alert-error', [
            'header' => 'Error',
        ])
    @endif

   

    <div class="my-5 account-pages pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="overflow-hidden card">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-4 text-primary">
                                        <h5 class="text-primary">Selamat Datang di Aplikasi
                                            {{ session('selected_application') == 'IKU' ? 'IKU' : 'E-Dokumen' }} !</h5>
                                        <p>{{ session('selected_application') == 'IKU' ? 'Aplikasi penginputan kinerja fakultas' : 'Aplikasi untuk pengelolaan dokumen FMIPA' }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="pt-0 card-body">
                            <div class="auth-logo">
                                <a class="auth-logo-light">
                                    <div class="mb-4 avatar-md profile-user-wid">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="assets/images/logo-light.svg" alt=""
                                                class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>

                                <a class="auth-logo-dark">
                                    <div class="mb-4 avatar-md profile-user-wid">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="assets/images/logo.svg" alt="" class="rounded-circle"
                                                height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" wire:submit="login">

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input value="{{ old('username') }}" autofocus autocomplete type="text"
                                            class="form-control" wire:model="username" id="username" name="username"
                                            placeholder="Masukkan username (NIP/NIDN/NIDK)">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" value="{{ old('password') }}" wire:model="password"
                                                id="password" name="password" class="form-control"
                                                placeholder="Masukkan password" aria-label="password"
                                                aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i
                                                    class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>



                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit"
                                            wire:loading.attr="disabled">Masuk</button>
                                    </div>


                                </form>
                            </div>
                        </div>
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

