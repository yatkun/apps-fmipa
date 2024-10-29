<div class="w-full lg:ps-64" id="content">
    <div class="flex items-center justify-between px-5 mt-5">
        <h2 class="text-2xl dark:text-white">Paket Tryout</h2>
        <x-button-outline href="#" class="">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>

            LAPORKAN SOAL</x-button-outline>
    </div>

    <!-- Card Blog -->
    <div class="px-5 mt-5">
        <!-- Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Card -->
            @foreach ($paket as $item)
            <x-card-tryout>
                <x-slot name="kategori">
                    {{ $item->kategori }}
                </x-slot>

                <x-slot name="judul">
                    {{ $item->nama }}
                </x-slot>
                <x-slot name="jmlsoal">
                    {{ $item->soal->count() }}
                </x-slot>
            </x-card-tryout>
            @endforeach
         
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Card Blog -->

</div>



<script>
    document.getElementById('focus').addEventListener('click', function() {
        const content = document.getElementById('content');

        // Cek apakah elemen memiliki class lg:ps-64
        if (content.classList.contains('lg:ps-64')) {
            // Jika ada, hapus lg:ps-64 dan tambahkan lg:ps-0
            content.classList.remove('lg:ps-64');
            content.classList.add('lg:ps-0');
        } else {
            // Jika tidak ada, hapus lg:ps-0 dan tambahkan lg:ps-64
            content.classList.remove('lg:ps-0');
            content.classList.add('lg:ps-64');
        }


    });
</script>
