<?php

namespace App\Livewire\Forms\Dokumen;

use Carbon\Carbon;
use Google\Client;
use Livewire\Form;
use App\Models\Dokumensaya;
use App\Models\Pengajaran;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Google\Service\Drive\Drive;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajaranForm extends Form
{

    use WithFileUploads;
    public $nama;
    public $document;
    public $existingFile;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'document' => 'required|file|max:10240', // Max 10MB
    ];

    public $dokumen_id;

    public function update()
    {
        dd($this->dokumen_id);
        $doc = Pengajaran::find($this->dokumen_id);

        if ($doc) {
            $username = Auth::user()->username;
            $user = Auth::user()->name;
            $googleFolder = "documents-pribadi/{$username}-{$user}";

            // Cek apakah nama dokumen diubah
            if ($this->nama !== $doc->nama) {
                $extension = pathinfo($doc->document, PATHINFO_EXTENSION);
                $timestamp = Carbon::now()->format('Ymd_His');
                $newFileName = Str::slug($this->nama) . "_{$timestamp}.{$extension}";
                $newFilePath = "{$googleFolder}/{$newFileName}";

                // Pindahkan file lama ke nama baru
                if (Storage::disk('google')->exists($doc->document)) {
                    Storage::disk('google')->move($doc->document, $newFilePath);
                    $doc->document = $newFilePath;
                }
            }
            // Update nama dokumen di database
            $doc->nama = $this->nama;

            // Jika ada file baru yang diunggah
            if ($this->document) {
                // Hapus file lama jika ada
                if (Storage::disk('google')->exists($doc->document)) {
                    Storage::disk('google')->delete($doc->document);
                }

                // Simpan file baru
                $extension = $this->document->getClientOriginalExtension();
                $timestamp = Carbon::now()->format('Ymd_His');
                $newFileName = Str::slug($this->nama) . "_{$timestamp}.{$extension}";
                $newFilePath = "{$googleFolder}/{$newFileName}";

                if (!Storage::disk('google')->exists($googleFolder)) {
                    Storage::disk('google')->makeDirectory($googleFolder);
                }
                Storage::disk('google')->put($newFilePath, file_get_contents($this->document->getRealPath()));
                $doc->document = $newFilePath;
            }

            // Simpan perubahan ke database
            $doc->save();
            session()->flash('message', 'Dokumen berhasil diperbarui.');
        } else {
            session()->flash('error', 'Dokumen tidak ditemukan.');
        }
    }
}
