@section('title', 'Profile')
@push('styles')
    <style>
        .profile-image-container {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Ubah sesuai kebutuhan Anda */
            opacity: 0;
            /* Awalnya tidak terlihat */
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 0.3s ease;
            /* Animasi fade selama 0.3 detik */
        }

        .overlay:hover {
            opacity: 1;
            /* Munculkan overlay saat di-hover */
        }

        .change-image-text {
            color: white;
            font-size: 12px;
            /* Ubah sesuai kebutuhan Anda */
            text-transform: uppercase;
        }
    </style>
@endpush

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if (session('success'))
            @include('livewire.includes.alert-success', [
                'header' => 'Sukses',
            ])
            @endif

            @error('profile_picture')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror

            <div class="row">
                <div class="col-xl-12">
                    <div class="overflow-hidden card">

                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-md-9 col-7">

                                </div>
                                <div class="col-md-3 col-5 align-self-end">

                                    <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="d-flex flex-md-row flex-column align-items-center" style="margin-top: -70px">
                                <div class="mb-2 avatar-xl me-md-3 mb-md-0 profile-image-container">
                                    @if (!empty($user->profile_picture))
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt=""
                                            class="avatar-xl img-thumbnail"
                                            style="background-size:cover;object-fit:cover !important;">
                                    @else
                                        <img src="{{ asset('storage/profile_pictures/avatar.png') }}" alt=""
                                            class="avatar-xl img-thumbnail">
                                    @endif
                                    <div class="overlay img-thumbnail" id="change-image">
                                        <span class="change-image-text">Ganti</span>
                                    </div>
                                    <input type="file" wire:model="profile_picture" id="profile-image-upload"
                                        class="d-none">

                                </div>
                                <div class="flex-grow-1 align-self-center align-self-md-end">
                                    <div
                                        class="d-flex flex-md-row flex-column justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-center align-items-md-start">
                                            <div class="mb-1 text-center font-size-18 mb-md-1 text-md-start">
                                                {{ $user->name }}</div>
                                            <div class="mb-1 text-center d-flex text-muted align-items-center me-md-5">
                                                <i class="bx bx-book-bookmark font-size-14"></i>
                                                <div class="ms-2 font-size-14">Dosen</div>
                                            </div>
                                        </div>
                                        <div class="mt-2 mt-sm-0"><a href="dosen-profil/edit" class="btn btn-light"
                                                aria-expanded="false"><i class="mdi mdi-pencil me-1"></i> <span
                                                    class="d-sm-inline-block">Edit
                                                    Data
                                                    Pribadi</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- container-fluid -->
    </div>
</div>


@push('scripts')
    <script>
        document.getElementById('change-image').addEventListener('click', function() {
            document.getElementById('profile-image-upload').click();
        });
    </script>
     <script src="{{ asset('assets/js/livewire.js') }}" data-navigate-track></script>
@endpush
