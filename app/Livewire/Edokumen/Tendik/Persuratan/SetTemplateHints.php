<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan;

use Livewire\Component;
use App\Models\Template;

class SetTemplateHints extends Component
{
     public $template; // Properti untuk menampung instance Template
    public $templateId; // Properti untuk menerima ID template dari URL
    public $placeholderHints = []; // Array untuk menampung hint yang akan diedit
    public $placeholderPermissions = []; // Array untuk menampung permission placeholder

    protected $rules = [
        'placeholderHints.*' => 'nullable|string|max:500', // Aturan validasi untuk setiap hint
        'placeholderPermissions.*' => 'required|in:dosen,tendik', // Permission hanya dosen atau tendik (sistem sudah dikecualikan)
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
        $existingPermissions = $this->template->placeholder_permissions ?? [];
        
        // Daftar placeholder sistem yang tidak boleh diedit
        $systemPlaceholders = ['qr_code', 'ttd', 'tanda_tangan_dekan'];

        // Inisialisasi placeholderHints dengan nilai yang sudah ada atau string kosong
        // KECUALIKAN placeholder sistem
        foreach ($allPlaceholders as $ph) {
            // Skip placeholder sistem - tidak ditampilkan di form set hints
            if (in_array($ph, $systemPlaceholders)) {
                continue;
            }
            
            $this->placeholderHints[$ph] = $existingHints[$ph] ?? '';
            
            // Default permission: dosen bisa isi semua kecuali yang mengandung 'nomor_surat' atau 'no_surat'
            $defaultPermission = (strpos(strtolower($ph), 'nomor') !== false && strpos(strtolower($ph), 'surat') !== false) || 
                                 (strpos(strtolower($ph), 'no_surat') !== false) ? 'tendik' : 'dosen';
            
            $this->placeholderPermissions[$ph] = $existingPermissions[$ph] ?? $defaultPermission;
        }
    }

    public function saveHints()
    {
        $this->validate();

        // Filter hint yang kosong/null sebelum disimpan
        $filteredHints = array_filter($this->placeholderHints, fn($value) => !is_null($value) && $value !== '');
        
        // Ambil existing permissions dan hints untuk mempertahankan placeholder sistem
        $existingHints = $this->template->placeholder_hints ?? [];
        $existingPermissions = $this->template->placeholder_permissions ?? [];
        
        // Daftar placeholder sistem yang tidak boleh diubah
        $systemPlaceholders = ['qr_code', 'ttd', 'tanda_tangan_dekan'];
        
        // Gabungkan hints lama (untuk sistem) dengan yang baru (untuk user)
        $finalHints = $existingHints;
        foreach ($filteredHints as $placeholder => $hint) {
            if (!in_array($placeholder, $systemPlaceholders)) {
                $finalHints[$placeholder] = $hint;
            }
        }
        
        // Gabungkan permissions lama (untuk sistem) dengan yang baru (untuk user)
        $finalPermissions = $existingPermissions;
        foreach ($this->placeholderPermissions as $placeholder => $permission) {
            if (!in_array($placeholder, $systemPlaceholders)) {
                $finalPermissions[$placeholder] = $permission;
            }
        }

        // Perbarui kolom placeholder_hints dan placeholder_permissions di database
        $this->template->update([
            'placeholder_hints' => $finalHints,
            'placeholder_permissions' => $finalPermissions,
        ]);

        session()->flash('message', 'Petunjuk placeholder dan pengaturan permission berhasil diperbarui!');
        // Opsional: Redirect kembali ke daftar template atau tetap di halaman ini
        // return redirect()->route('nama.rute.daftar.template');
    }

    public function render()
    {
        return view('livewire.edokumen.tendik.persuratan.set-template-hints');
    }
}
