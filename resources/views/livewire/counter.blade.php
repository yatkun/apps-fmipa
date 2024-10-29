<div class="w-full lg:ps-64" id="content">
    <div class="flex items-center justify-between p-5">
        <h2 class="text-2xl dark:text-white">Paket Tryout CPNS Premium 1</h2>
        <x-button-outline href="#" class="">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>

            LAPORKAN SOAL</x-button-outline>
    </div>

    <div class="px-5">
        <div class="grid grid-cols-12 gap-4">
            <div
                class="flex flex-col col-span-12 bg-white border md:col-span-8 rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div
                    class="px-4 py-3 bg-gray-100 border-b rounded-t-xl md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
                    <div class="flex items-center justify-between">
                        <div class="text-xl font-medium dark:text-white">Soal Nomor 1</div>

                        <span
                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">Tes
                            Wawasan
                            Kebangsaan</span>
                    </div>
                </div>
                <div class="p-4 md:p-5">

                    <div class="">

                        <h2 class="text-xl"> {{ $currentQuestion->pertanyaan }}</h2>
                    </div>

                </div>
                <div class="ml-4">
                    <ul>
                        @foreach ($currentQuestion->options as $option)
                            <div>
                                <label>
                                    <input type="radio" wire:model.defer="answers.{{ $currentQuestionIndex + 1 }}"
                                        wire:click="saveAnswer({{ $currentQuestionIndex + 1 }}, '{{ $option->id }}')"
                                        value="{{ $option->id }}"
                                        {{ isset($answers[$currentQuestionIndex + 1]) && $answers[$currentQuestionIndex + 1] == $option->id ? 'checked' : '' }}>
                                    {{ $option->opsi }}
                                    
                                </label>

                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-span-12 md:col-span-4">
                <div
                    class="flex flex-col p-4 bg-white border border-gray-200 rounded-xl md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <div class="text-2xl font-bold dark:text-white">01 : 22 : 34</div>

                        <div class="mb-4">
                            @foreach ($questions as $index => $question)
                                <button wire:click="setQuestion({{ $index }})" class="btn btn-primary">
                                    {{ $index + 1 }}
                                </button>
                            @endforeach

                            <button wire:click="clearAnswers">
                                Selesai
                            </button>


                            <button wire:click="cek">
                                CEK
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

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
