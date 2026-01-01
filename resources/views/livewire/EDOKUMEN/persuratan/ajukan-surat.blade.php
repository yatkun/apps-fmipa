@section('title', 'Ajukan Surat')

<div>
    <div class="main-content">
        @if (session('success'))
            @include('livewire.includes.alert-success', [
                'header' => 'Sukses',
            ])
        @elseif (session('error'))
            @include('livewire.includes.alert-error', [
                'header' => 'Gagal',
            ])    
        @endif
        <div class="page-content">
            <div class="container-fluid">
                <div class="mb-4 card fade-in">
                    <div class="p-3 card-header bg-light">
                        <h5 class="mb-0 section-title me-2">
                            <i class="fas fa-file-alt"></i>
                            Pilih Template Surat
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="mb-3 col-md-10 mb-md-0">


                                <!-- Isolate Select2 dari Livewire interference -->
                                <div wire:ignore>
                                    <select id="selectTemplate" class="form-control select2" wire:model="templateId"
                                        data-placeholder="🔍 Pilih Template Surat yang Diinginkan">
                                        <option value="">🔍 Pilih Template Surat yang Diinginkan
                                        </option>
                                        @foreach ($templates as $template)
                                            <option value="{{ $template->id }}"
                                                @if ($templateId == $template->id) selected @endif>
                                                📄
                                                {{ $template->title ?? ($template->name ?? 'Template ' . $template->id) }}
                                            </option>
                                        @endforeach
                                        <option value="custom" @if ($templateId == 'custom') selected @endif>
                                            ✨ Surat Custom (Bebas)
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn w-100 btn-primary" wire:click="pilihTemplate"
                                    wire:loading.attr="disabled" wire:target="pilihTemplate"
                                    @if (!$templateId) disabled @endif>
                                    <span wire:loading.remove>
                                        <i class="fas fa-check me-2"></i>
                                        @if ($templateId && !$templateSelected)
                                            Pilih Template
                                        @else
                                            Pilih Template
                                        @endif
                                    </span>
                                    <span wire:loading>
                                        <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                        Memuat...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($templateSelected)
                    @if ($templateId === 'custom')
                        <!-- Custom Letter Section -->
                        <div class="mb-4 card fade-in">
                            <div class="card-body">
                                <h5 class="section-title">
                                    <i class="fas fa-edit"></i>
                                    Informasi Surat Custom
                                </h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="fas fa-heading me-1"></i>
                                                Judul Surat Custom
                                            </label>
                                            <input type="text" class="form-control" wire:model.defer="customTitle"
                                                placeholder="Masukkan judul surat yang jelas dan spesifik">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="fas fa-file-text me-1"></i>
                                                Isi Surat Custom
                                            </label>
                                            <textarea class="form-control" wire:model.defer="customContent" rows="6"
                                                placeholder="Masukkan isi surat dengan detail yang lengkap..."></textarea>
                                            <div class="form-text">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Jelaskan kebutuhan surat Anda
                                                dengan detail agar mudah
                                                diproses
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($templateId && $templateId !== 'custom')
                        <!-- Template Placeholders Section -->
                        @if (!empty($dosenPlaceholders))
                            <div class="mb-4 card fade-in">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0 section-title">
                                        <i class="fas fa-edit"></i>
                                        Isi Data Template
                                    </h5>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($dosenPlaceholders as $index => $ph)
                                            <div class="mb-3 col-md-6"
                                                wire:key="dosen-{{ $templateId }}-{{ $ph }}-{{ $index }}">
                                                <label class="form-label fw-semibold">
                                                    <i class="fas fa-edit me-1 text-primary"></i>
                                                    {{ ucfirst(str_replace('_', ' ', $ph)) }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                @php
                                                    // Use placeholder hint if available, otherwise use default
                                                    $placeholderText = isset($placeholderHints[$ph])
                                                        ? $placeholderHints[$ph]
                                                        : 'Masukkan ' . strtolower(str_replace('_', ' ', $ph));
                                                @endphp
                                                <input type="text"
                                                    class="form-control @error('formData.' . $ph) is-invalid @enderror"
                                                    wire:model.live="formData.{{ $ph }}"
                                                    wire:key="input-{{ $templateId }}-{{ $ph }}-{{ $index }}"
                                                    placeholder="{{ $placeholderText }}"
                                                    id="input-{{ $templateId }}-{{ $ph }}-{{ $index }}">
                                                @error('formData.' . $ph)
                                                    <div class="invalid-feedback">
                                                        {{ $message }}</div>
                                                @enderror

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        @endif

                        <!-- Dynamic Table Section -->
                        @php
                            $selectedTemplate = $templates->firstWhere('id', $templateId);
                        @endphp
                        @if ($selectedTemplate && $selectedTemplate->dynamic_table_marker && !empty($selectedTemplate->table_placeholders))
                            <div class="mb-4 card fade-in">
                                <div class="card-body">
                                    <h5 class="section-title">
                                        <i class="fas fa-table"></i>
                                        Data Tabel Dinamis
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-primary">
                                                <tr>
                                                    @foreach ($selectedTemplate->table_placeholders as $ph)
                                                        <th>{{ ucfirst(str_replace('_', ' ', $ph)) }}
                                                        </th>
                                                    @endforeach
                                                    <th width="120">Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($tableData as $idx => $row)
                                                    @if (is_array($row) && count(array_intersect(array_keys($row), $selectedTemplate->table_placeholders)) > 0)
                                                        <tr>
                                                            @foreach ($selectedTemplate->table_placeholders as $ph)
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                        wire:model="tableData.{{ $idx }}.{{ $ph }}"
                                                                        placeholder="{{ strtolower(str_replace('_', ' ', $ph)) }}">
                                                                </td>
                                                            @endforeach
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-outline-danger btn-sm"
                                                                    wire:click="removeTableRow({{ $idx }})">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                    <tr>
                                                        <td colspan="{{ count($selectedTemplate->table_placeholders) + 1 }}"
                                                            class="py-4 text-center text-muted">
                                                            <i class="mb-2 fas fa-inbox fa-2x d-block"></i>
                                                            Belum ada data.
                                                            Klik "Tambah
                                                            Baris" untuk
                                                            menambah data.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="button" class="btn btn-secondary" wire:click="addTableRow">
                                        <i class="fas fa-plus me-2"></i>
                                        Tambah Baris
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- Additional Notes Section -->
                    <div class="mb-4 card fade-in">
                        <div class="card-body">
                            <h5 class="section-title">
                                <i class="fas fa-sticky-note"></i>
                                Catatan Tambahan
                            </h5>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-comment me-1"></i>
                                    Catatan Pengajuan (opsional)
                                </label>
                                <textarea class="form-control" wire:model.defer="catatan" rows="4"
                                    placeholder="Tambahkan catatan atau informasi tambahan yang diperlukan..."></textarea>
                                <div class="form-text">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    Catatan ini akan membantu reviewer
                                    memahami konteks pengajuan Anda
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Section -->
                    <div class="card fade-in" style="background: linear-gradient(135deg, #f6f9fc 0%, #ffffff 100%);">
                        <div class="text-center card-body">
                            <div class="mb-4">
                                <i class="mb-3 fas fa-paper-plane fa-3x text-primary"></i>
                                <h5 class="mb-2 fw-bold text-dark">Siap untuk
                                    Mengajukan Surat?</h5>
                                <p class="mb-0 text-muted">
                                    Pastikan semua data sudah benar dan
                                    lengkap sebelum mengajukan surat.
                                    Surat yang telah diajukan akan masuk ke
                                    proses verifikasi.
                                </p>
                            </div>

                            <div class="flex-wrap gap-3 d-flex justify-content-center">
                                <a href="{{ route('dosen.persuratan.list-surat') }}"
                                    class="px-4 btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>
                                    Batal & Kembali
                                </a>
                                <button wire:click="submit" wire:loading.attr="disabled" wire:target="submit"
                                    class="px-5 btn btn-success">
                                    <span wire:loading.remove wire:target="submit">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Ajukan Surat Sekarang
                                    </span>
                                    <span wire:loading wire:target="submit">
                                        <div class="spinner-border spinner-border-sm me-2" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        Sedang Memproses...
                                    </span>
                                </button>
                            </div>

                            <div class="mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Surat akan dikirim ke Staff/Tendik untuk
                                    proses verifikasi dan penomoran
                                </small>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>



<script data-navigate-once>
    document.addEventListener('livewire:navigated', function() {
        var selectElement = document.getElementById('selectTemplate');
        if (selectElement) {
            // Inisialisasi Select2
            // $(selectElement).select2({
            //     width: '100%',
            //     dropdownParent: $(selectElement).parent(),
            //     placeholder: "🔍 Pilih Template Surat yang Diinginkan",
            //     allowClear: true
            // });

            // Cari instance Livewire yang punya select ini
            let component = Livewire.find(selectElement.closest('[wire\\:id]').getAttribute('wire:id'));

            // Event listener perubahan nilai - hanya update templateId, templateSelected jadi false
            $(selectElement).on('change', function(e) {
                var selectedValue = $(this).val();
                if (component) {
                    // Update templateId tapi set templateSelected ke false
                    component.set('templateId', selectedValue);
                    component.set('templateSelected', false);
                }
            });
        } else {
            console.warn('Elemen select2 tidak ditemukan di DOM.');
        }
    });
</script>
