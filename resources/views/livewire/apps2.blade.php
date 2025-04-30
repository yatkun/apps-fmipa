<div class="page-content">
    <div class="container-fluid">
        <div class="items-center row justify-content-center">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="favorite-icon">
                            <a href="javascript:void(0)"><i class="uil uil-heart-alt fs-18"></i></a>
                        </div>
                        
                        <img height="50" class="mb-3" src="{{ asset('storage/gambar/icon.png') }}">
                        <h5 class="mb-2 fs-17"><span class="text-dark">Aplikasi IKU</span></h5>
                        <ul class="mb-0 list-inline">
                            <li class="list-inline-item">
                                <p class="mb-1 text-muted fs-14">Aplikasi yang dibuat untuk memudahkan dalam penginputan kinerja fakultas</p>
                            </li>
                           
                        </ul>
                        
                        <div class="gap-2 mt-4 hstack">
                      
                            <button wire:click="choose('IKU')" data-bs-toggle="modal" class="btn btn-soft-primary w-100">Masuk</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="favorite-icon">
                            <a href="javascript:void(0)"><i class="uil uil-heart-alt fs-18"></i></a>
                        </div>
                        
                        <img height="50" class="mb-3" src="{{ asset('storage/gambar/icon.png') }}">
                        <h5 class="mb-2 fs-17"><span  class="text-dark">Aplikasi E-DOKUMEN</span></h5>
                        <ul class="mb-0 list-inline">
                            <li class="list-inline-item">
                                <p class="mb-1 text-muted fs-14">Aplikasi yang dibuat untuk memudahkan dalam penginputan kinerja fakultas</p>
                            </li>
                           
                        </ul>
                        
                        <div class="gap-2 mt-4 hstack">
                      
                            <button wire:click="choose('EDokumen')" data-bs-toggle="modal" class="btn btn-soft-primary w-100">Masuk</button>
                        </div>
                    </div>
                </div>
            </div>
        
           
        
        </div><!--end row-->
        
     

    </div> <!-- container-fluid -->
</div><!-- End Page-content -->