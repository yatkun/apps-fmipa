{{-- Table Row untuk Approved Letters --}}
<tr>
    <td>
        <div class="fw-medium text-dark">
            {{ $row->template->name ?? 'N/A' }}
        </div>
    </td>
    <td>
        <div class="text-muted">
            {{ $row->user->name ?? 'N/A' }}
        </div>
    </td>
    <td>
        <div class="text-muted">
            {{ $row->created_at->format('d M Y') }}
        </div>
    </td>
    <td>
        <div class="text-muted">
            {{ $row->approved_at ? $row->approved_at->format('d M Y') : 'N/A' }}
        </div>
    </td>
    <td class="text-center">
        <button onclick="Livewire.dispatch('downloadLetter', {{ $row->id }})"
                class="action-btn action-btn-success">
            <i class="fas fa-download"></i> Unduh
        </button>
    </td>
</tr>
