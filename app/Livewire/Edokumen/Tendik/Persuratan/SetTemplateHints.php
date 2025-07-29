<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan;

use Livewire\Component;
use App\Models\Template;

class SetTemplateHints extends Component
{
     public $template; // Properti untuk menampung instance Template
    public $templateId; // Properti untuk menerima ID template dari URL
    public $placeholderHints = []; // Array untuk menampung hint yang akan diedit

    protected $rules = [
        'placeholderHints.*' => 'nullable|string|max:500', // Aturan validasi untuk setiap hint
    ];

    /**
     * Metode mount() akan dipanggil saat komponen diinisialisasi.
     * Kita akan menggunakan ini untuk memuat template dan mengisi placeholderHints.
     */
    public function mount($templateId)
    {
        $this->templateId = $templateId;
        $this->template = Template::findOrFail($templateId); // Cari template atau lempar 404

        // Gabungkan semua placeholder (umum dan tabel) untuk ditampilkan
        $allPlaceholders = array_merge($this->template->placeholders ?? [], $this->template->table_placeholders ?? []);
        $existingHints = $this->template->placeholder_hints ?? [];

        // Inisialisasi placeholderHints dengan nilai yang sudah ada atau string kosong
        foreach ($allPlaceholders as $ph) {
            $this->placeholderHints[$ph] = $existingHints[$ph] ?? '';
        }
    }

    public function saveHints()
    {
        $this->validate();

        // Filter hint yang kosong/null sebelum disimpan
        $filteredHints = array_filter($this->placeholderHints, fn($value) => !is_null($value) && $value !== '');

        // Perbarui kolom placeholder_hints di database
        $this->template->update([
            'placeholder_hints' => $filteredHints,
        ]);

        session()->flash('message', 'Petunjuk placeholder berhasil diperbarui!');
        // Opsional: Redirect kembali ke daftar template atau tetap di halaman ini
        // return redirect()->route('nama.rute.daftar.template');
    }

    public function render()
    {
        return view('livewire.edokumen.tendik.persuratan.set-template-hints');
    }
}
