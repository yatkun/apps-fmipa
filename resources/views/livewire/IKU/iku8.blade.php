@push('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
@endpush

<div class="main-content">
    @if (session('success'))
        @include('livewire.includes.alert-success', [
            'header' => 'Sukses',
        ])
    @endif
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-0 card-title">IKU 8 : Akreditasi Internasional
                            </h4>
                            <p class="card-title-desc">Persentase program studi S1 dan D4/D3 yang memiliki akreditasi atau sertifikasi internasional yang diakui pemerintah.</p>

                            <div class="row">


                                <div class="col-xl-12">
                                    <div class="mt-0">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                           
                                            <x-accordion.accordion id="1" title="Kriteria Akreditasi dan Sertifikasi">
                                                <li>
                                                    Lembaga akreditasi atau sertifikasi internasional yang diakui oleh Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi.
                                                </li>
                                                <li>
                                                    Program studi Kedokteran yang memiliki peringkat akreditasi Unggul dari LAM PT-KES dapat dihitung sebagai program studi terakreditasi
                                                    Internasional.
                                                </li>
                                                <li>
                                                    Akreditasi atau sertifikasi internasional yang dihitung adalah yang masih berlaku pada tahun perhitungan IKU
                                                </li>
                                            </x-accordion.accordion>
                                           
                                            
                                            
                                        </div>
                                        <!-- end accordion -->
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>


            </div>

           
        </div>
    </div>



</div>


@push('scripts')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}" data-navigate-once>
    </script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}" data-navigate-once>
    </script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}" data-navigate-once>
    </script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"
        data-navigate-once></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}" data-navigate-once></script>

    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" data-navigate-once>
    </script>


    {{-- Livewire script sudah diload di layout --}}

    {{-- <script>
        
        $('#myInputTextField').keyup(function() {
            oTable.search($(this).val()).draw();
        })
    </script> --}}
@endpush
