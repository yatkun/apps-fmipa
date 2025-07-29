<?php

namespace App\Livewire\Edokumen\pribadi\Bimbingan;

use App\Models\Bimbingan;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class TambahBimbingan extends Component
{
    public $mode = 'add';

    use WithFileUploads;

    public $nama;
    public $nim;
    public $prodi;
    public $angkatan;
    public $judul;
    public $document;
    public $pembimbing_1;
    public $pembimbing_2;

    public $existingFile;

   
    

    public function upload()
    {
        dd('dd');
        $this->validate([
            'nama' => 'required|string',
            'nim' => 'required|string',
            'prodi' => 'required|string',
            'angkatan' => 'required|string',
            'judul' => 'required|string',
            'document' => 'required|file|max:10240', // 10MB
            'pembimbing_1' => 'required|different:pembimbing_2|exists:users,id',
            'pembimbing_2' => 'nullable|different:pembimbing_1|exists:users,id',
        ]);
    
        $originalName = $this->nama;
        $extension = $this->document->getClientOriginalExtension();
        $timestamp = Carbon::now()->format('Ymd_His');
        $fileName = Str::slug($originalName) . "_{$timestamp}.{$extension}";
    
        // Ambil data pembimbing
        $dosen1 = User::find($this->pembimbing_1);
        $dosen2 = $this->pembimbing_2 ? User::find($this->pembimbing_2) : null;
    
        // Siapkan folder untuk masing-masing pembimbing
        $folderPaths = [];
    
        if ($dosen1) {
            $folderPaths[] = "documents-pribadi/pendidikan/bimbingan/{$dosen1->username}-{$dosen1->name}";
        }
    
        if ($dosen2) {
            $folderPaths[] = "documents-pribadi/pendidikan/bimbingan/{$dosen2->username}-{$dosen2->name}";
        }
    
        // Upload ke Google Drive masing-masing folder
        foreach ($folderPaths as $folder) {
            if (!Storage::disk('google')->exists($folder)) {
                Storage::disk('google')->makeDirectory($folder);
            }
    
            Storage::disk('google')->put("{$folder}/{$fileName}", file_get_contents($this->document->getRealPath()));
        }
    
        // Simpan path salah satu file untuk database
        $savedPath = $folderPaths[0] . '/' . $fileName;
    
        // Simpan semua data ke database
        Bimbingan::create([
            'nama' => $this->nama,
            'nim' => $this->nim,
            'prodi' => $this->prodi,
            'angkatan' => $this->angkatan,
            'judul' => $this->judul,
            'document' => $savedPath,
            'pembimbing_1' => $this->pembimbing_1,
            'pembimbing_2' => $this->pembimbing_2,
        ]);
        
        session()->flash('success', 'Data bimbingan berhasil disimpan dan dokumen berhasil diunggah!');
        $this->dispatch('notif');
        return redirect()->route('bimbingan');


    }



    public function render()
    {
        return view('livewire.EDOKUMEN.pribadi.bimbingan.tambah-bimbingan', [
            'user' => User::where('level', 'Dosen')->get()
        ]);
    }
}
