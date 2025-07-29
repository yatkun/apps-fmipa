@push('styles')
@endpush

@section('title', 'Dokumen Pendidikan | Bimbingan Mahasiswa')

<div class="main-content">
    @if (session('success'))
        @include('livewire.includes.alert-success', [
            'header' => 'Sukses',
        ])
    @endif
    <div class="page-content">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body border-bottom">
                            <div class="d-flex">
                                <img src="assets/images/companies/wechat.svg" alt="" height="50">
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fw-semibold">Magento Developer</h5>
                                    <ul class="gap-2 mb-0 list-unstyled hstack">
                                        <li>
                                            <i class="bx bx-building-house"></i> <span class="text-muted">Themesbrand</span>
                                        </li>
                                        <li>
                                            <i class="bx bx-map"></i> <span class="text-muted">California</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-3 fw-semibold">Description</h5>
                            <p class="text-muted">We are looking to hire a skilled Magento developer to build and maintain eCommerce websites for our clients. As a Magento developer, you will be responsible for liaising with the design team, setting up Magento 1x and 2x sites, building modules and customizing extensions, testing the performance of each site, and maintaining security and feature updates after the installation is complete.</p>
                            
                            <h5 class="mb-3 fw-semibold">Responsibilities:</h5>
                            <ul class="gap-3 vstack">
                                <li>
                                    Meeting with the design team to discuss the needs of the company.
                                </li>
                                <li>
                                    Building and configuring Magento 1x and 2x eCommerce websites.
                                </li>
                                <li>
                                    Coding of the Magento templates.
                                </li>
                                <li>
                                    Developing Magento modules in PHP using best practices.
                                </li>
                                <li>
                                    Designing themes and interfaces.
                                </li>
                                <li>
                                    Setting performance tasks and goals.
                                </li>
                                <li>
                                    Updating website features and security patches.
                                </li>
                            </ul>

                            <h5 class="mb-3 fw-semibold">Requirements:</h5>
                            <ul class="gap-3 vstack">
                                <li>
                                    Bachelor’s degree in computer science or related field.
                                </li>
                                <li>
                                    Advanced knowledge of Magento, JavaScript, HTML, PHP, CSS, and MySQL.
                                </li>
                                <li>
                                    Experience with complete eCommerce lifecycle development.
                                </li>
                                <li>
                                    Understanding of modern UI/UX trends.
                                </li>
                                <li>
                                    Knowledge of Google Tag Manager, SEO, Google Analytics, PPC, and A/B Testing.
                                </li>
                                <li>
                                    Good working knowledge of Adobe Photoshop and Adobe Illustrator.
                                </li>
                                <li>
                                    Strong attention to detail.
                                </li>
                                <li>
                                    Ability to project-manage and work to strict deadlines.
                                </li>
                                <li>
                                    Ability to work in a team environment.
                                </li>
                            </ul>

                            <h5 class="mb-3 fw-semibold">Qualification:</h5>
                            <ul class="gap-3 vstack">
                                <li>
                                    B.C.A / M.C.A under National University course complete.
                                </li>
                                <li>
                                    3 or more years of professional design experience
                                </li>
                                <li>
                                    Advanced degree or equivalent experience in graphic and web design
                                </li>
                            </ul>

                            <h5 class="mb-3 fw-semibold">Skill &amp; Experience:</h5>
                            <ul class="gap-3 mb-0 vstack">
                                <li>
                                    Understanding of key Design Principal
                                </li>
                                <li>
                                    Proficiency With HTML, CSS, Bootstrap
                                </li>
                                <li>
                                    WordPress: 1 year (Required)
                                </li>
                                <li>
                                    Experience designing and developing responsive design websites
                                </li>
                                <li>
                                    web designing: 1 year (Preferred)
                                </li>
                            </ul>

                            <div class="mt-4">
                                <span class="badge badge-soft-warning">PHP</span>
                                <span class="badge badge-soft-warning">Magento</span>
                                <span class="badge badge-soft-warning">Marketing</span>
                                <span class="badge badge-soft-warning">WordPress</span>
                                <span class="badge badge-soft-warning">Bootstrap</span>
                            </div>

                            <div class="mt-4">
                                <ul class="mb-0 list-inline">
                                    <li class="mt-1 list-inline-item">
                                        Share this job:
                                    </li>
                                    <li class="mt-1 list-inline-item">
                                        <a href="javascript:void(0)" class="btn btn-outline-primary btn-hover"><i class="uil uil-facebook-f"></i> Facebook</a>
                                    </li>
                                    <li class="mt-1 list-inline-item">
                                        <a href="javascript:void(0)" class="btn btn-outline-danger btn-hover"><i class="uil uil-google"></i> Google+</a>
                                    </li>
                                    <li class="mt-1 list-inline-item">
                                        <a href="javascript:void(0)" class="btn btn-outline-success btn-hover"><i class="uil uil-linkedin-alt"></i> linkedin</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

           


        </div>
    </div>

   
    <!-- Overlay Loading -->

</div>


<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    <script src="{{ asset('assets/js/livewire.js') }}" data-navigate-track></script>
@endpush
