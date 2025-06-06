<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/edok2.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/edok_icon.svg') }}" alt="" height="17">
                    </span>
                </a>

                <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/edok_icon.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/edok2.svg') }}" alt="" height="24">
                    </span>
                </a>
            </div>

            <button type="button" class="px-3 btn btn-sm font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <div class="d-flex">



            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button wire:navigate href="/apps" type="button" class="btn header-item noti-icon waves-effect"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-customize"></i>
                </button>

            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-bell bx-tada"></i>
                    {{-- <span class="badge bg-danger rounded-pill">3</span> --}}
                </button>
                <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0" key="t-notifications"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small" key="t-view-all"> View All</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div data-simplebar="init" style="max-height: 230px;">
                        <div class="simplebar-wrapper" style="margin: 0px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                                        <div class="simplebar-content" style="padding: 0px;">
                                            <a href="javascript: void(0);" class="text-reset notification-item">
                                                <div class="d-flex">
                                                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title bg-primary rounded-circle font-size-16">
                                                            <i class="bx bx-cart"></i>
                                                        </span>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1" key="t-your-order">Your order is placed</h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1" key="t-grammer">If several languages
                                                                coalesce the grammar</p>
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                                <span key="t-min-ago">3 min ago</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="javascript: void(0);" class="text-reset notification-item">
                                                <div class="d-flex">
                                                    <img src="assets/images/users/avatar-3.jpg"
                                                        class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">James Lemire</h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1" key="t-simplified">It will seem like
                                                                simplified English.</p>
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                                <span key="t-hours-ago">1 hours ago</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="javascript: void(0);" class="text-reset notification-item">
                                                <div class="d-flex">
                                                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title bg-success rounded-circle font-size-16">
                                                            <i class="bx bx-badge-check"></i>
                                                        </span>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1" key="t-shipped">Your item is shipped</h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1" key="t-grammer">If several languages
                                                                coalesce the grammar</p>
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                                <span key="t-min-ago">3 min ago</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="javascript: void(0);" class="text-reset notification-item">
                                                <div class="d-flex">

                                                    <img src="{{ asset('assets/images/users/avatar-4.jpg') }}"
                                                        class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Salena Layfield</h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1" key="t-occidental">As a skeptical
                                                                Cambridge friend of mine occidental.</p>
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                                <span key="t-hours-ago">1 hours ago</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar"
                                style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                            <div class="simplebar-scrollbar"
                                style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                        </div>
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="text-center btn btn-sm btn-link font-size-14" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span>
                        </a>
                    </div> --}}
                </div>
            </div>

            @livewire('profile')



        </div>
    </div>
</header>
