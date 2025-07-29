<?php

namespace App\Livewire\Edokumen\Tendik\Bimbingan;

use App\Models\User;
use Livewire\Component;
use App\Models\Bimbingan;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\BimbinganDocument;
use Illuminate\Support\Facades\Storage;

class TambahDataPembimbingan extends Component
{
    public $mode = 'add';
    use WithFileUploads;

    public $nama;
    public $nim;
    public $prodi;
    public $angkatan;
    public $judul;
    public $document = [];
    public $pembimbing_1;
    public $pembimbing_2;
    public $existingFile;

    protected $rules = [
        'nama' => 'required|string',
        'nim' => 'required|string',
        'prodi' => 'required|string',
        'angkatan' => 'required|string',
        'judul' => 'required|string',
        'document.*' => 'file|max:10240', // per file
        'document' => 'array',
        'pembimbing_1' => 'required',
        'pembimbing_2' => 'nullable',
    ];

    protected $messages = [
        'nama.required' => 'Nama Mahasiswa harus diisi',
        'nim.required' => 'NIM Mahasiswa harus diisi',
        'prodi.required' => 'Program Studi harus diisi',
        'angkatan.required' => 'Angkatan harus diisi',
        'judul.required' => 'Judul Skripsi harus diisi',
        'document.max:10240' => 'Dokumen maksimal 10 MB',
        'pembimbing_1.required' => 'Pembimbing 1 harus diisi',
        'pembimbing_2.required' => 'Pembimbing 2 harus diisi'
    ];

    public function upload()
    {
        $this->validate();

        $dosen1 = User::find($this->pembimbing_1);
        $dosen2 = $this->pembimbing_2 ? User::find($this->pembimbing_2) : null;

        // Simpan data bimbingan
        $bimbingan = Bimbingan::create([
            'nama' => $this->nama,
            'nim' => $this->nim,
            'prodi' => $this->prodi,
            'angkatan' => $this->angkatan,
            'judul' => $this->judul,
            'pembimbing_1' => $this->pembimbing_1,
            'pembimbing_2' => $this->pembimbing_2,
        ]);

        $folderPaths = [];

        if ($dosen1) {
            $folderPaths[] = "documents-pribadi/pendidikan/bimbingan/{$dosen1->username}-{$dosen1->name}";
        }
        if ($dosen2) {
            $folderPaths[] = "documents-pribadi/pendidikan/bimbingan/{$dosen2->username}-{$dosen2->name}";
        }

        foreach ($this->document as $doc) {
            $extension = $doc->getClientOriginalExtension();
            $timestamp = Carbon::now()->format('Ymd_His');
            $fileName = Str::slug($this->nama) . "_{$timestamp}_" . uniqid() . ".{$extension}";
        
            foreach ($folderPaths as $folder) {
                // Buat folder jika belum ada
                if (!Storage::disk('google')->exists($folder)) {
                    Storage::disk('google')->makeDirectory($folder);
                }
        
                // Simpan file ke Google Drive
                Storage::disk('google')->put("{$folder}/{$fileName}", file_get_contents($doc->getRealPath()));
        
                // Simpan path ini ke database (semua folder disimpan)
                BimbinganDocument::create([
                    'bimbingan_id' => $bimbingan->id,
                    'document' => "{$folder}/{$fileName}",
                ]);
            }
        }

        session()->flash('success', 'Data bimbingan berhasil disimpan.');
        $this->dispatch('notif');
        return redirect()->route('tendik.pembimbingan');
    }

    public function handleSaveOrUpdate()
    {
        if ($this->mode == 'edit') {
            $this->update_a(); // Panggil fungsi update
        } else {
            $this->upload(); // Panggil fungsi save
        }
    }


    public function render()
    {
        return view('livewire.edokumen.tendik.bimbingan.tambah-data-pembimbingan', [
            'user' => User::where('level', 'Dosen')->get()
        ]);
    }
}
