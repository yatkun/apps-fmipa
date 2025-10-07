# Modern Data Table Component

Component Livewire yang reusable untuk membuat tabel modern dengan fitur lengkap seperti search, sorting, pagination, dan styling yang konsisten.

## Instalasi

Component ini terdiri dari:
- `App\Livewire\Components\ModernDataTable` - Class component
- `resources/views/livewire/components/modern-data-table.blade.php` - View component
- `resources/views/livewire/components/table-rows/` - Folder untuk row templates

## Fitur

- ✅ **Search** - Pencarian real-time dengan debounce
- ✅ **Sorting** - Sorting kolom dengan indikator visual
- ✅ **Pagination** - Pagination yang dapat dikustomisasi
- ✅ **Responsive** - Mobile-friendly design
- ✅ **Empty State** - Handling untuk kondisi data kosong
- ✅ **Loading States** - Indikator loading untuk UX yang baik
- ✅ **Keyboard Shortcuts** - Ctrl+K untuk fokus search
- ✅ **Customizable** - Header, styling, dan action buttons yang fleksibel
- ✅ **Row Templates** - Menggunakan partial views untuk row content

## Penggunaan Dasar

### 1. Buat Row Template

Pertama, buat view partial untuk row tabel Anda:

```blade
{{-- resources/views/livewire/components/table-rows/your-data-row.blade.php --}}
<tr>
    <td>{{ $row->name }}</td>
    <td>{{ $row->email }}</td>
    <td>{{ $row->created_at->format('d M Y') }}</td>
    <td>
        <button class="action-btn btn-view">
            <i class="bx bx-show"></i> Lihat
        </button>
    </td>
</tr>
```

### 2. Di Controller/Component

```php
<?php

namespace App\Livewire\YourNamespace;

use Livewire\Component;
use Livewire\WithPagination;

class YourComponent extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    protected $listeners = [
        'searchUpdated' => 'updateSearch',
        'sortUpdated' => 'updateSort'
    ];

    public function updateSearch($value)
    {
        $this->search = $value;
        $this->resetPage();
    }

    public function updateSort($field, $direction)
    {
        $this->sortBy = $field;
        $this->sortDir = $direction;
        $this->resetPage();
    }

    public function render()
    {
        $data = YourModel::query()
            ->when($this->search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($this->sortBy && $this->sortDir, function ($query) {
                return $query->orderBy($this->sortBy, $this->sortDir);
            })
            ->paginate($this->perPage);

        $tableConfig = [
            'title' => 'Data Title',
            'subtitle' => 'Data description',
            'searchPlaceholder' => 'Cari data...',
            'rowView' => 'livewire.components.table-rows.your-data-row',
            'columns' => [
                [
                    'label' => 'Nama',
                    'field' => 'name',
                    'icon' => 'bx bx-user',
                    'sortable' => true,
                    'width' => '40%'
                ],
                [
                    'label' => 'Email',
                    'field' => 'email',
                    'icon' => 'bx bx-envelope',
                    'sortable' => true,
                    'width' => '30%'
                ],
                [
                    'label' => 'Tanggal',
                    'field' => 'created_at',
                    'icon' => 'bx bx-calendar',
                    'sortable' => true,
                    'width' => '20%'
                ],
                [
                    'label' => 'Aksi',
                    'field' => '',
                    'icon' => 'bx bx-cog',
                    'sortable' => false,
                    'width' => '10%'
                ]
            ],
            'data' => $data->items(),
            'emptyStateTitle' => 'Tidak Ada Data',
            'emptyStateText' => 'Saat ini tidak ada data yang tersedia.',
            'emptyStateIcon' => 'bx-file-blank',
            'headerActions' => [
                '<a href="/create" class="btn btn-primary">
                    <i class="bx bx-plus me-2"></i>
                    Tambah Data
                </a>'
            ]
        ];

        return view('your-view', [
            'data' => $data,
            'tableConfig' => $tableConfig
        ]);
    }
}
```

### 3. Di View Blade

```blade
@section('title', 'Your Page Title')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <livewire:components.modern-data-table
                        :title="$tableConfig['title']"
                        :subtitle="$tableConfig['subtitle']"
                        :search-placeholder="$tableConfig['searchPlaceholder']"
                        :columns="$tableConfig['columns']"
                        :data="$tableConfig['data']"
                        :row-view="$tableConfig['rowView']"
                        :empty-state-title="$tableConfig['emptyStateTitle']"
                        :empty-state-text="$tableConfig['emptyStateText']"
                        :empty-state-icon="$tableConfig['emptyStateIcon']"
                        :header-actions="$tableConfig['headerActions']"
                        :search="$search"
                        :per-page="$perPage"
                        :sort-by="$sortBy"
                        :sort-dir="$sortDir"
                    >
                        @slot('paginationSlot')
                            @if ($data->hasPages())
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="table-info">
                                        Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }} 
                                        dari {{ $data->total() }} data
                                    </div>
                                    <div>
                                        {{ $data->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            @endif
                        @endslot
                    </livewire:components.modern-data-table>
                </div>
            </div>
        </div>
    </div>
</div>
```

## Parameter Component

### Props Utama

| Parameter | Type | Default | Deskripsi |
|-----------|------|---------|-----------|
| `title` | string | '' | Judul halaman |
| `subtitle` | string | '' | Subtitle halaman |
| `searchPlaceholder` | string | 'Cari data...' | Placeholder untuk search input |
| `columns` | array | [] | Konfigurasi kolom tabel |
| `data` | array | [] | Data yang akan ditampilkan |
| `rowView` | string | '' | Path ke view partial untuk row |
| `rowData` | array | [] | Data tambahan untuk row template |
| `showSearch` | boolean | true | Tampilkan search box |
| `showPerPage` | boolean | true | Tampilkan selector per page |
| `showHeader` | boolean | true | Tampilkan header |
| `showPagination` | boolean | true | Tampilkan pagination |
| `emptyStateTitle` | string | 'Tidak Ada Data' | Judul empty state |
| `emptyStateText` | string | 'Saat ini tidak ada...' | Text empty state |
| `emptyStateIcon` | string | 'bx-file-blank' | Icon empty state |
| `headerActions` | array | [] | Array HTML untuk action buttons |
| `tableClass` | string | '' | CSS class tambahan untuk table |
| `containerClass` | string | '' | CSS class tambahan untuk container |

### Konfigurasi Kolom

```php
[
    'label' => 'Nama Kolom',          // Label yang ditampilkan
    'field' => 'database_field',      // Field untuk sorting
    'icon' => 'bx bx-icon',          // Icon kolom (opsional)
    'sortable' => true,               // Apakah bisa di-sort
    'width' => '30%'                  // Lebar kolom (opsional)
]
```

## Row Templates

Row templates adalah view partial yang digunakan untuk menampilkan setiap baris data. Variabel `$row` otomatis tersedia dalam template ini.

### Contoh Row Templates

#### 1. Simple Row
```blade
{{-- simple-row.blade.php --}}
<tr>
    <td>{{ $row->name }}</td>
    <td>{{ $row->email }}</td>
    <td>
        <span class="badge bg-primary">{{ $row->status }}</span>
    </td>
</tr>
```

#### 2. Complex Row dengan Actions
```blade
{{-- complex-row.blade.php --}}
<tr>
    <td>
        <div class="d-flex align-items-center">
            <div class="ava-sm bg-light rounded me-3">
                <i class="bx bx-user"></i>
            </div>
            <div>
                <h6 class="mb-0">{{ $row->name }}</h6>
                <small class="text-muted">{{ $row->email }}</small>
            </div>
        </div>
    </td>
    <td>{{ $row->created_at->format('d M Y') }}</td>
    <td>
        <div class="d-flex gap-2">
            <button class="action-btn btn-view">
                <i class="bx bx-show"></i> Lihat
            </button>
            <button class="action-btn action-btn-success">
                <i class="bx bx-edit"></i> Edit
            </button>
        </div>
    </td>
</tr>
```

#### 3. Row dengan Event Handlers
```blade
{{-- row-with-events.blade.php --}}
<tr>
    <td>{{ $row->title }}</td>
    <td>{{ $row->created_at->format('d M Y') }}</td>
    <td>
        <button onclick="Livewire.dispatch('deleteItem', {{ $row->id }})"
                class="action-btn btn-danger">
            <i class="bx bx-trash"></i> Hapus
        </button>
    </td>
</tr>
```

## CSS Classes Tersedia

### Action Buttons
- `.action-btn` - Base class untuk action button
- `.btn-view` - Button untuk view/lihat (blue)
- `.action-btn-success` - Button success (green)
- `.btn-danger` - Button danger (red)

### Status Badges
- `.status-badge` - Base class untuk status badge
- `.status-pending` - Status pending (yellow)
- `.status-approved` - Status approved (green)
- `.status-rejected` - Status rejected (red)

### Table Elements
- `.modern-table` - Table styling
- `.sortable-column` - Kolom yang bisa di-sort
- `.sort-icon` - Icon sorting
- `.empty-state` - Container empty state

## Event Handling untuk Row Actions

Jika Anda memerlukan event handling dari row template ke parent component, gunakan Livewire dispatch:

### 1. Di Row Template
```blade
<button onclick="Livewire.dispatch('deleteItem', {{ $row->id }})">
    Hapus
</button>
```

### 2. Di Parent Component
```php
protected $listeners = [
    'searchUpdated' => 'updateSearch',
    'sortUpdated' => 'updateSort',
    'deleteItem' => 'deleteItem'
];

public function deleteItem($itemId)
{
    // Handle delete logic
    YourModel::find($itemId)->delete();
    session()->flash('success', 'Item berhasil dihapus');
}
```

## Contoh Implementasi Lengkap

Lihat file contoh:
- `ListPendingLettersWithComponent.php` - Untuk halaman pending letters
- `ListApprovedLettersWithComponent.php` - Untuk halaman approved letters
- `table-rows/pending-letters-row.blade.php` - Row template untuk pending letters
- `table-rows/approved-letters-row.blade.php` - Row template untuk approved letters

## Keyboard Shortcuts

- `Ctrl + K` atau `Cmd + K` - Fokus ke search input

## Events Livewire

Component mengirim events berikut:
- `searchUpdated` - Ketika search berubah
- `sortUpdated` - Ketika sorting berubah
- `refreshTable` - Untuk refresh table dari parent

## Tips Penggunaan

1. **Performance** - Gunakan `->select()` di query untuk mengambil kolom yang diperlukan saja
2. **Search** - Implementasikan search di level query untuk performa yang baik
3. **Sorting** - Pastikan field yang di-sort ada index di database
4. **Pagination** - Gunakan `->paginate()` untuk pagination otomatis
5. **Responsive** - Component sudah responsive, tapi pastikan content kolom juga mobile-friendly
6. **Row Templates** - Buat row template yang sesuai dengan struktur data Anda
7. **Event Handling** - Gunakan Livewire dispatch untuk komunikasi antar component

## Troubleshooting

### Undefined variable $row
- **Solusi**: Pastikan menggunakan `rowView` parameter dan buat file row template
- Row template otomatis mendapat akses ke variabel `$row`

### Search tidak bekerja
- Pastikan listener `searchUpdated` ada di component
- Check implementasi search di query

### Sorting tidak bekerja  
- Pastikan listener `sortUpdated` ada di component
- Verify field name di konfigurasi kolom sesuai dengan database

### Pagination tidak muncul
- Pastikan menggunakan `->paginate()` bukan `->get()`
- Check apakah `showPagination` = true

### Row template tidak ditemukan
- Pastikan path `rowView` benar
- File row template harus ada di lokasi yang sesuai
- Gunakan dot notation untuk path (ex: `livewire.components.table-rows.your-row`)
