

<div class="dropdown d-inline-block">
                
    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if ($user->profile_picture)
        <img class="rounded-circle header-profile-user" src="{{ asset('storage/' . $user->profile_picture) }}"
            alt="Profile Picture">
    @else 
        <img class="rounded-circle header-profile-user" src="{{ asset('storage/profile_pictures/avatar.png') }}"
            alt="Header Avatar">
    @endif
        <span class="d-none d-xl-inline-block ms-1" key="t-henry"> {{ $user->name }}</span>
        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" style="">
        <!-- item-->
        <a wire:navigate class="dropdown-item" href="{{ route('profile') }}"><i class="align-middle bx bx-user font-size-16 me-1"></i> <span key="t-profile">Profile</span></a>
        <div class="dropdown-divider"></div>
        <livewire:logout />
    </div>
</div>
