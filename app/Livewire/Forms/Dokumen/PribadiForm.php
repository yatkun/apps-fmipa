<?php

namespace App\Livewire\Forms\Dokumen;

use Carbon\Carbon;
use Google\Client;
use Livewire\Form;
use App\Models\Dokumensaya;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Google\Service\Drive\Drive;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PribadiForm extends Form
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


    public function store()
    {

        $validate = $this->validate();

        $username = Auth::user()->username;

        $originalName = $this->nama;
        $extension = $this->document->getClientOriginalExtension();
        $timestamp = Carbon::now()->format('Ymd_His');

        $fileName = Str::slug($originalName) . "_{$timestamp}.{$extension}";

        if ($extension == 'docx' | $extension == 'doc') {
            $icon = 'mdi mdi-file-word text-primary';
        } elseif ($extension == 'pdf') {
            $icon = 'mdi mdi-file-pdf text-danger';
        } elseif ($extension == 'jpg' | $extension == 'jpeg' | $extension == 'png') {
            $icon = 'mdi mdi-image text-info';
        } elseif ($extension == 'rar' | $extension == 'zip') {
            $icon = 'mdi mdi-folder-zip text-warning';
        } elseif ($extension == 'xls' | $extension == 'xlsx') {
            $icon = 'mdi mdi-file-excel text-success';
        } elseif ($extension == 'ppt' | $extension == 'pptx') {
            $icon = 'mdi mdi-file-powerpoint text-warning';
        } else {
            $icon = 'mdi mdi-file text-muted';
        }

        // $this->document->storeAs('documents', $fileName, 'public');
        $googleFolder = "documents-pribadi/{$username}";

        if (!Storage::disk('google')->exists($googleFolder)) {
            Storage::disk('google')->makeDirectory($googleFolder);
        }
        Storage::disk('google')->put("{$googleFolder}/{$fileName}", file_get_contents($this->document->getRealPath()));

        $filePath = "{$googleFolder}/{$fileName}";


        // Simpan informasi file ke database dengan user_id
        $data = Dokumensaya::create([
            'nama' => $this->nama,
            'document' => $filePath,
            'icon' => $icon,
            'user_id' => Auth::id(), // Simpan ID pengguna saat ini
        ]);
    }



    public function update()
    {
        $doc = Dokumensaya::find($this->dokumen_id);

        if ($doc) {
            $username = Auth::user()->username;
            $googleFolder = "documents-pribadi/{$username}";

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

                // Tentukan ikon berdasarkan tipe file
                $icon = match ($extension) {
                    'docx', 'doc' => 'mdi mdi-file-word text-primary',
                    'pdf' => 'mdi mdi-file-pdf text-danger',
                    'jpg', 'jpeg', 'png' => 'mdi mdi-image text-info',
                    'rar', 'zip' => 'mdi mdi-folder-zip text-warning',
                    'xls', 'xlsx' => 'mdi mdi-file-excel text-success',
                    'ppt', 'pptx' => 'mdi mdi-file-powerpoint text-warning',
                    default => 'mdi mdi-file text-muted',
                };

                $doc->document = $newFilePath;
                $doc->icon = $icon;
            }

            // Simpan perubahan ke database
            $doc->save();
            session()->flash('message', 'Dokumen berhasil diperbarui.');
        } else {
            session()->flash('error', 'Dokumen tidak ditemukan.');
        }
    }
}
