<?php

namespace App\Livewire\Admin\User;

use App\Models\Letter;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder; // Penting untuk builder()
class ListApproveLetter extends DataTableComponent
{
     // Hapus properti $model jika Anda mendefinisikan builder()
    // protected $model = Letter::class; // Ini tidak diperlukan jika Anda menggunakan builder()

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        // Anda bisa menambahkan konfigurasi lain di sini,
        // seperti setSearchDisabled(), setPaginationDisabled(), dll.
    }

    // Gunakan metode builder() untuk mendefinisikan kueri Anda
    public function builder(): Builder
    {
        return Letter::query()
            ->where('status', 'approved')
            ->with('template', 'approver'); // Pastikan relasi ini ada di model Letter
            
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Template Name", "template.name") // Mengakses relasi 'template'
                ->sortable()
                ->searchable(),
            Column::make("Approver", "approver.name") // Mengakses relasi 'approver' (user yang menyetujui)
                ->sortable()
                ->searchable(),
            Column::make("Approved At", "approved_at")
                ->sortable()
                ->format(function($value, $row, Column $column) {
                    return $value ? $value->format('Y-m-d H:i') : '-'; // Format tanggal
                }),

            // Tambahkan kolom lain sesuai kebutuhan dari model Letter Anda
            // Contoh:
            // Column::make("Recipient", "recipient_name")
            //    ->sortable()
            //    ->searchable(),
        ];
    }
}
