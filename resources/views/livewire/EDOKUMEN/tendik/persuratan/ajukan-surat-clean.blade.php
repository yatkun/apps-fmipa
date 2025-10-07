<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-paper-plane me-2"></i>
                        Ajukan Surat
                    </h5>
                    <a wire:navigate href="{{ route('dosen.persuratan.dashboard') }}"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>
                        Kembali
                    </a>
                </div>

                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-file-alt me-2 text-primary"></i>
                                        Pilih Template Surat
                                    </h6>

                                    @if ($templates->count() > 0)
                                        <div class="form-group">
                                            <label for="templateSelect" class="form-label fw-bold">Template
                                                Tersedia</label>
                                            <select id="templateSelect" wire:model.live="templateId"
                                                class="form-select select2-template" wire:ignore.self>
                                                <option value="">-- Pilih Template --</option>
                                                @foreach ($templates as $template)
                                                    <option value="{{ $template->id }}">
                                                        {{ $template->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            Belum ada template tersedia.
                                        </div>
                                    @endif

                                    <div class="mt-4">
                                        <h6 class="text-muted">
                                            <i class="fas fa-edit me-2"></i>
                                            Atau Buat Custom Surat
                                        </h6>
                                        <div class="form-group">
                                            <label for="customTitle" class="form-label">Judul Surat</label>
                                            <input type="text" id="customTitle" wire:model="customTitle"
                                                class="form-control" placeholder="Masukkan judul surat custom">
                                        </div>
                                        <div class="form-group">
                                            <label for="customContent" class="form-label">Isi Surat</label>
                                            <textarea id="customContent" wire:model="customContent" class="form-control" rows="5"
                                                placeholder="Masukkan isi surat custom"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    @if ($templateSelected)
                                        <h6 class="card-title">
                                            <i class="fas fa-edit me-2 text-success"></i>
                                            Isi Form Template
                                        </h6>

                                        @if (count($placeholderHints) > 0)
                                            <div class="alert alert-info">
                                                <h6><i class="fas fa-info-circle me-2"></i>Panduan Pengisian:</h6>
                                                <ul class="mb-0">
                                                    @foreach ($placeholderHints as $hint)
                                                        @if (!in_array($hint['placeholder'], ['${qr_code}', '${ttd}']))
                                                            <li><strong>{{ $hint['placeholder'] }}</strong>:
                                                                {{ $hint['hint'] }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (count($formData) > 0)
                                            <form wire:submit.prevent="submit">
                                                @foreach ($formData as $key => $value)
                                                    @if (!in_array($key, ['${qr_code}', '${ttd}']))
                                                        <div class="form-group mb-3" wire:key="input-{{ $key }}">
                                                            <label class="form-label fw-bold">{{ $key }}</label>
                                                            @if (is_array($value))
                                                                @php
                                                                    $tableKey = str_replace(['${', '}'], '', $key);
                                                                @endphp
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                @foreach ($value as $index => $row)
                                                                                    @if ($index === 0)
                                                                                        @foreach (array_keys($row) as $header)
                                                                                            <th>{{ ucfirst($header) }}
                                                                                            </th>
                                                                                        @endforeach
                                                                                        <th>Aksi</th>
                                                                                    @endif
                                                                                @break
                                                                            @endforeach
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($value as $index => $row)
                                                                            <tr wire:key="row-{{ $key }}-{{ $index }}">
                                                                                @foreach ($row as $field => $fieldValue)
                                                                                    <td>
                                                                                        <input type="text"
                                                                                            wire:model="formData.{{ $key }}.{{ $index }}.{{ $field }}"
                                                                                            class="form-control form-control-sm"
                                                                                            placeholder="{{ ucfirst($field) }}">
                                                                                    </td>
                                                                                @endforeach
                                                                                <td>
                                                                                    <button type="button"
                                                                                        wire:click="removeTableRow('{{ $key }}', {{ $index }})"
                                                                                        class="btn btn-danger btn-sm">
                                                                                        <i class="fas fa-trash"></i>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <button type="button"
                                                                    wire:click="addTableRow('{{ $key }}')"
                                                                    class="btn btn-primary btn-sm mt-2">
                                                                    <i class="fas fa-plus me-1"></i>
                                                                    Tambah Baris
                                                                </button>
                                                            </div>
                                                        @else
                                                            <input type="text"
                                                                wire:model="formData.{{ $key }}"
                                                                class="form-control"
                                                                placeholder="Masukkan {{ $key }}"
                                                                wire:key="input-{{ $key }}">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach

                                            <div class="form-group mb-3">
                                                <label class="form-label fw-bold">Catatan Tambahan (Opsional)</label>
                                                <textarea wire:model="catatan" class="form-control" rows="3"
                                                    placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                                            </div>

                                            <div class="d-grid">
                                                <button type="submit" wire:loading.attr="disabled"
                                                    wire:target="submit" class="px-5 btn btn-success">
                                                    <span wire:loading.remove wire:target="submit">
                                                        <i class="fas fa-paper-plane me-2"></i>
                                                        Ajukan Surat Sekarang
                                                    </span>
                                                    <span wire:loading wire:target="submit">
                                                        <div class="spinner-border spinner-border-sm me-2"
                                                            role="status">
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
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2 on page load
    initializeSelect2();
    
    // Reinitialize Select2 after Livewire updates
    document.addEventListener('livewire:navigated', function() {
        setTimeout(initializeSelect2, 100);
    });
    
    // Also handle after any Livewire morph
    Livewire.hook('morph.updated', function() {
        setTimeout(initializeSelect2, 100);
    });
    
    function initializeSelect2() {
        // Destroy existing Select2 instances first
        if ($('.select2-template').hasClass('select2-hidden-accessible')) {
            $('.select2-template').select2('destroy');
        }
        
        // Initialize Select2 with search functionality
        $('.select2-template').select2({
            placeholder: '-- Pilih Template --',
            allowClear: true,
            width: '100%',
            templateResult: formatTemplate,
            templateSelection: formatTemplateSelection
        }).on('change', function(e) {
            // Update Livewire property when selection changes
            const value = $(this).val();
            @this.set('templateId', value);
        });
    }
    
    function formatTemplate(template) {
        if (!template.id) {
            return template.text;
        }
        
        return $('<span><i class="fas fa-file-alt me-2"></i>' + template.text + '</span>');
    }
    
    function formatTemplateSelection(template) {
        return template.text || template.id;
    }
    
    // Handle URL parameters for template selection
    const urlParams = new URLSearchParams(window.location.search);
    const templateParam = urlParams.get('template');
    
    if (templateParam) {
        // Set the template ID and trigger change
        @this.set('templateId', templateParam).then(() => {
            // Update the select2 display
            setTimeout(() => {
                $('.select2-template').val(templateParam).trigger('change');
            }, 500);
        });
    }
});
</script>
@endpush
