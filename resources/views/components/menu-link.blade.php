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
                @elseif ( request()->is('dokumen/*') &  Auth::user()->level == 'Tendik')
                <li>
                    <a wire:navigate href="/dokumen/tendik/dashboard" class="waves-effect">
                        <i class="bx bx-chat"></i>
                        <span key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="/dokumen/tendik/data-pengajaran" class="waves-effect">
                        <i class="bx bx-chat"></i>
                        <span key="t-pengajaran">Data Pengajaran</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="/dokumen/tendik/data-pembimbingan" class="waves-effect {{ request()->is('dokumen/tendik/data-pembimbingan/*') ? 'active' : '' }}">
                        <i class="bx bx-chat"></i>
                        <span key="t-pembimbingan">Data Pembimbingan</span>
                    </a>
                </li>
                
                <li class="{{ request()->is('dokumen/persuratan/*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect {{ request()->is('dokumen/persuratan/*') ? 'active' : '' }}" aria-expanded="false">
                        <i class="bx bx-calendar"></i>
                        <span key="t-dashboards">Persuratan</span>
                    </a>
                    {{-- <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li><a wire:navigate href="/dokumen/persuratan/templates" key="t-full-calendar">Template Surat</a></li>
                    
                    </ul>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li><a wire:navigate href="{{ route('list.approved.letters') }}" key="t-full-calendar">Surat Disetujui</a></li>
                    
                    </ul> --}}

                     <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li><a wire:navigate href="{{ route('list.pending.letters') }}" key="t-full-calendar" class="{{ request()->is('dokumen/persuratan/butuh-persetujuan/*') ? 'active' : '' }}">Menunggu Persetujuan</a></li>
                        <li><a wire:navigate href="{{ route('list.approved.letters') }}" key="t-full-calendar">Surat Disetujui</a></li>
                        <li><a wire:navigate href="{{ route('list.surat.tolak') }}" key="t-full-calendar">Surat Ditolak</a></li>
                        <li><a wire:navigate href="{{ route('tendik.custom.letters') }}" key="t-full-calendar" class="{{ request()->is('dokumen/persuratan/surat-custom') ? 'active' : '' }}">Surat Custom</a></li>
                        <li><a wire:navigate href="/dokumen/persuratan/templates" key="t-full-calendar" class="{{ request()->is('dokumen/persuratan/templates/*') ? 'active' : '' }}">Template Surat</a></li>
                        <li><a wire:navigate href="{{ route('list.verification.tendik') }}" key="t-verification-tendik" class="{{ request()->is('dokumen/persuratan/verifikasi-tendik/*') ? 'active' : '' }}"><i class="bx bx-check-shield"></i> Verifikasi Tendik</a></li>
                    </ul>
                </li>
                @else
                <li>
                    <a wire:navigate href="/dokumen/dashboard" class="waves-effect {{ request()->is('dokumen/dashboard/*') ? 'active' : '' }}">
                        <i class="bx bx-chat"></i>
                        <span key="t-dashboard">Dashboard</span>
                    </a>
                </li>
              
                <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect {{ request()->is('dokumen/pendidikan/*') ? 'active' : '' }}" aria-expanded="false">
                        <i class="bx bx-calendar"></i>
                        <span key="t-dashboards">Pendidikan</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li><a wire:navigate href="/dokumen/pendidikan/pengajaran" key="t-full-calendar">Pengajaran</a></li>
                        <li class="{{ request()->is('dokumen/pendidikan/bimbingan/*') ? 'mm-active' : '' }}"><a wire:navigate href="/dokumen/pendidikan/bimbingan" key="t-full-calendar">Bimbingan Mahasiswa</a></li>
                        <li><a wire:navigate href="/dokumen/pendidikan/pengujian" key="t-full-calendar">Pengujian Mahasiswa</a></li>
                       
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
               <li class="{{ request()->is('dokumen/persuratan/*') ? 'mm-active' : '' }}">
        <a href="javascript: void(0);" class="has-arrow waves-effect {{ request()->is('dokumen/persuratan/*') ? 'active' : '' }}" aria-expanded="false">
            <i class="bx bx-calendar"></i>
            <span key="t-dashboards">Persuratan</span>
        </a>
        <ul class="sub-menu mm-collapse" aria-expanded="false">
            @if(Auth::user()->is_dekan)
                {{-- Menu khusus untuk Dekan --}}
                <li><a wire:navigate href="{{ route('dosen.persuratan.ajukan-surat') }}" key="t-full-calendar">Ajukan Surat</a></li>
                {{-- <li><a wire:navigate href="{{ route('dosen.persuratan.list-pending-letters') }}" key="t-full-calendar">Surat Saya - Menunggu</a></li> --}}
                {{-- <li><a wire:navigate href="{{ route('dosen.persuratan.list-approved-letters') }}" key="t-full-calendar">Surat Saya - Disetujui</a></li> --}}
                {{-- <li><a wire:navigate href="{{ route('dosen.persuratan.list-rejected-letters') }}" key="t-full-calendar">Surat Saya - Ditolak</a></li> --}}
                <hr style="margin: 8px 0; border-color: #ddd;">
                {{-- Menu approval untuk Dekan --}}
                <li><a wire:navigate href="{{ route('list.pending.letters') }}" key="t-full-calendar" class="{{ request()->is('dokumen/persuratan/butuh-persetujuan/*') ? 'active' : '' }}"><i class="bx bx-check-circle"></i> Perlu Persetujuan</a></li>
                <li><a wire:navigate href="{{ route('list.approved.letters') }}" key="t-full-calendar"><i class="bx bx-check"></i> Telah Disetujui</a></li>
                <li><a wire:navigate href="{{ route('list.surat.tolak') }}" key="t-full-calendar"><i class="bx bx-x-circle"></i> Telah Ditolak</a></li>
                <li><a wire:navigate href="{{ route('list.verification.dekan') }}" key="t-verification-dekan" class="{{ request()->is('dokumen/persuratan/verifikasi-dekan/*') ? 'active' : '' }}"><i class="bx bx-shield-check"></i> Verifikasi Dekan</a></li>
            @else
                {{-- Menu untuk Dosen biasa --}}
                <li><a wire:navigate href="{{ route('dosen.persuratan.ajukan-surat') }}" key="t-full-calendar">Ajukan Surat</a></li>
                <li><a wire:navigate href="{{ route('dosen.persuratan.list-surat') }}" key="t-full-calendar">Daftar Surat</a></li>
                {{-- <li><a wire:navigate href="{{ route('dosen.persuratan.list-approved-letters') }}" key="t-full-calendar">Surat Disetujui</a></li>
                <li><a wire:navigate href="{{ route('dosen.persuratan.list-rejected-letters') }}" key="t-full-calendar">Surat Ditolak</a></li> --}}
            @endif
            
        </ul>
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