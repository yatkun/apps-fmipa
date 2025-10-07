{{-- Table Row untuk Pending Letters --}}
<tr>
    <td>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 me-3">
                <div class="rounded ava-sm bg-light d-flex align-items-center justify-content-center">
                    <i class="bx bx-file text-primary"></i>
                </div>
            </div>
            <div class="flex-grow-1">
                <h6 class="mb-0">
                    {{ $row->template->name ?? $row->title }}
                </h6>
            </div>
        </div>
    </td>
    <td>
        <div class="text-muted fs-6">
            {{ $row->created_at->format('d M Y') }}
        </div>
    </td>
    <td>
        <span class="badge rounded-pill bg-warning">{{ $row->status }}</span>
    </td>
    @if (Auth::user()->level !== 'Dosen')
        <td>
            <div class="d-flex gap-2">
                <a wire:navigate
                   href="{{ route('approve.letter', $row->hashed_id) }}"
                   class="action-btn btn-view" 
                   title="Lihat & Review Surat">
                    <i class="bx bx-show"></i>
                    <span class="d-none d-sm-inline">Review</span>
                </a>
            </div>
        </td>
    @endif
</tr>
