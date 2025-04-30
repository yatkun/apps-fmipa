@push('styles')
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #e4e6fb;
            background-image: url("https://cdn.siap.id/s3/UI-UX/doc-project-dxs/img/bg-ppg1.png");
            background-size: cover;
            background-position: top;
            background-repeat: no-repeat;
        }

    </style>
@endpush

<div class="container-fluid">
<div class="items-center row justify-content-center">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div class="favorite-icon">
                    <a href="javascript:void(0)"><i class="uil uil-heart-alt fs-18"></i></a>
                </div>
               
                <img height="50" class="mb-3" src="{{ asset('assets/images/logo.svg') }}">
                <h5 class="mb-2 fs-17"><span class="text-dark">Aplikasi IKU</span></h5>
                <ul class="mb-0 list-inline">
                    <li class="list-inline-item">
                        <p class="mb-1 text-muted fs-14">Aplikasi penginputan kinerja
                            fakultas</p>
                    </li>

                </ul>

                <div class="gap-2 mt-4 hstack">

                    <button wire:click="choose('IKU')" data-bs-toggle="modal"
                        class="btn btn-soft-primary w-100">Masuk</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div class="favorite-icon">
                    <a href="javascript:void(0)"><i class="uil uil-heart-alt fs-18"></i></a>
                </div>

                <img height="50" class="mb-3" src="{{ asset('assets/images/logo.svg') }}">
                <h5 class="mb-2 fs-17"><span class="text-dark">Aplikasi E-DOKUMEN</span></h5>
                <ul class="mb-0 list-inline">
                    <li class="list-inline-item">
                        <p class="mb-1 text-muted fs-14">Aplikasi untuk pengelolaan dokumen FMIPA</p>
                    </li>

                </ul>

                <div class="gap-2 mt-4 hstack">

                    <button wire:click="choose('EDokumen')" data-bs-toggle="modal"
                        class="btn btn-soft-primary w-100">Masuk</button>
                </div>
            </div>
        </div>
    </div>


</div>
</div>
