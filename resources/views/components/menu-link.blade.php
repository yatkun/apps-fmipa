<div class="vertical-menu">

    <div data-simplebar="init" class="h-100"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -15px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">

        <!--- Sidemenu -->
        <div id="sidebar-menu" class="mm-active">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled mm-show" id="side-menu">
                @if ( request()->is('iku/*') )
                <li>
                    <a wire:navigate href="/iku/dashboard" class="waves-effect {{ request()->is('iku/dashboard') ? 'active' : '' }}">
                        <i class="bx bx-chat"></i>
                        <span key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="/iku/iku-1" class="waves-effect {{ request()->is('iku/iku-1') ? 'active' : '' }}">
                        <i class="bx bx-file"></i>
                        <span key="t-iku-1">IKU-1</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="/iku/iku-2" class="waves-effect {{ request()->is('iku/iku-2') ? 'active' : '' }}">
                        <i class="bx bx-file"></i>
                        <span key="t-iku-2">IKU-2</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="/iku/iku-3" class="waves-effect {{ request()->is('iku/iku-3') ? 'active' : '' }}">
                        <i class="bx bx-file"></i>
                        <span key="t-iku-3">IKU-3</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="/iku/iku-4" class="waves-effect {{ request()->is('iku/iku-4') ? 'active' : '' }}">
                        <i class="bx bx-file"></i>
                        <span key="t-iku-4">IKU-4</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="/iku/iku-5" class="waves-effect {{ request()->is('iku/iku-5') ? 'active' : '' }}">
                        <i class="bx bx-file"></i>
                        <span key="t-iku-5">IKU-5</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="/iku/iku-6" class="waves-effect {{ request()->is('iku/iku-6') ? 'active' : '' }}">
                        <i class="bx bx-file"></i>
                        <span key="t-iku-6">IKU-6</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="/iku/iku-7" class="waves-effect {{ request()->is('iku/iku-7') ? 'active' : '' }}">
                        <i class="bx bx-file"></i>
                        <span key="t-iku-7">IKU-7</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="/iku/iku-8" class="waves-effect {{ request()->is('iku/iku-8') ? 'active' : '' }}">
                        <i class="bx bx-file"></i>
                        <span key="t-iku-8">IKU-8</span>
                    </a>
                </li>
                @else
                <li>
                    <a wire:navigate href="/dokumen/dashboard" class="waves-effect {{ request()->is('dokumen/dashboard/*') ? 'active' : '' }}">
                        <i class="bx bx-chat"></i>
                        <span key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="bx bx-calendar"></i>
                        <span key="t-dashboards">Dokumen Pribadi</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li><a wire:navigate href="/dokumen/pribadi/pendidikan" key="t-tui-calendar">Pendidikan</a></li>
                        <li><a href="calendar-full.html" key="t-full-calendar">Pengajaran</a></li>
                        <li><a href="calendar-full.html" key="t-full-calendar">Penelitian</a></li>
                        <li><a href="calendar-full.html" key="t-full-calendar">Pengabdian</a></li>
                        <li><a href="calendar-full.html" key="t-full-calendar">Kepangkatan</a></li>
                        <li><a wire:navigate href="/dokumen/pribadi/skp" key="t-full-calendar">SKP</a></li>
                        <li><a href="calendar-full.html" key="t-full-calendar">Lain-lain</a></li>
                    </ul>
                </li>

              
             
                {{-- href="/dokumen/publik"  wire:navigate class="waves-effect {{ request()->is('dokumen/publik/*') ? 'active' : '' }}" --}}
                <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="bx bx-world"></i>
                        <span key="t-publik">Dokumen Publik</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true" style="height: 0px;">
    
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-akreditasi">Akreditasi</a>
                            <ul class="sub-menu mm-collapse" aria-expanded="true">
                                <li><a href="javascript: void(0);" key="t-akreditasi-matematika">Matematika</a></li>
                                <li><a href="javascript: void(0);" key="t-akreditasi-statistika">Statistika</a></li>
                                <li><a href="javascript: void(0);" key="t-akreditasi-aktuaria">Aktuaria</a></li>
                                <li><a href="javascript: void(0);" key="t-akreditasi-bioteknologi">Bioteknologi</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a wire:navigate href="/dokumen/tandai" class="waves-effect {{ request()->is('dokumen/tandai/*') ? 'active' : '' }}">
                        <i class="bx bx-user-check"></i>
                        <span key="t-tandai">Dokumen Tertandai</span>
                    </a>
                   
                </li>
                <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">Multi Level</span>
                    </a>
                    
                </li>
                @if (Auth::user()->level == 'admin')
                <li>
                    <a wire:navigate href="/admin/pengguna" class="waves-effect {{ request()->is('admin/pengguna') ? 'active' : '' }}">
                        <i class="bx bx-user-check"></i>
                        <span key="t-tandai">Daftar Pengguna</span>
                    </a>
                </li>
                @endif
                @endif

               
            </ul>
        </div>
        <!-- Sidebar -->
    </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 1431px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 57px; transform: translate3d(0px, 105px, 0px); display: block;"></div></div></div>
</div>