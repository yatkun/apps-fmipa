<?php

namespace App\Livewire\Edokumen\Tendik\Bimbingan;

use App\Models\User;
use Livewire\Component;
use App\Models\Bimbingan;
use App\Models\BimbinganDocument;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Storage;

class EditDataPembimbingan extends Component
{

    public $mode = 'edit';
    use WithFileUploads;
    public $dokumenId;
    public $nama;
    public $nim;
    public $prodi;
    public $angkatan;
    public $judul;

    public $documents = []; // untuk dokumen lama (path)
    public $newDocuments = []; // untuk file baru dari input
    public $pembimbing_1;
    public $pembimbing_2;
    public $existingFile;

    public function mount($hashid)
    {

        $decodedId = Hashids::decode($hashid);
        if (empty($decodedId)) {
            abort(404, 'Dokumen tidak ditemukan');
        }
        $id = $decodedId[0];
        $dokumen = Bimbingan::with('documents')->findOrFail($id);

        if ($dokumen) {
            $this->dokumenId = $dokumen->id;
            $this->nama = $dokumen->nama;
            $this->nim =  $dokumen->nim; // Simpan path dokumen lama
            $this->prodi =  $dokumen->prodi; // Simpan path dokumen lama
            $this->angkatan =  $dokumen->angkatan; // Simpan path dokumen lama
            $this->judul =  $dokumen->judul; // Simpan path dokumen lama
            $this->pembimbing_1 =  $dokumen->pembimbing_1; // Simpan path dokumen lama
            $this->pembimbing_2 =  $dokumen->pembimbing_2; // Simpan path dokumen lama
            $this->documents = $dokumen->documents->pluck('document')->toArray();
            $this->existingFile =  optional($dokumen->documents->first())->document;
        }
    }

    public function update()
    {

        $this->validate([
            'nama' => 'required|string',
            'nim' => 'required|string',
            'prodi' => 'required|string',
            'angkatan' => 'required|string',
            'judul' => 'required|string',
            'pembimbing_1' => 'required|exists:users,id',
            'pembimbing_2' => 'nullable|exists:users,id',
            'newDocuments.*' => 'nullable|file|max:10240',
        ]);

        $bimbingan = Bimbingan::with('documents')->findOrFail($this->dokumenId);
        $oldPembimbing1 = $bimbingan->pembimbing_1;
        $oldPembimbing2 = $bimbingan->pembimbing_2;

        $oldDosen1 = User::find($oldPembimbing1);
        $oldDosen2 = $oldPembimbing2 ? User::find($oldPembimbing2) : null;


        $newDosen1 = User::find($this->pembimbing_1);
        $newDosen2 = $this->pembimbing_2 ? User::find($this->pembimbing_2) : null;


        // Ambil semua folder dosen lama
        $oldFolders = [];
        if ($oldDosen1) {
            $oldFolders[] = "documents-pribadi/pendidikan/bimbingan/{$oldDosen1->username}-{$oldDosen1->name}";
        }
        if ($oldDosen2) {
            $oldFolders[] = "documents-pribadi/pendidikan/bimbingan/{$oldDosen2->username}-{$oldDosen2->name}";
        }

        // Ambil folder dosen baru
        $newFolders = [];
        if ($newDosen1) {
            $newFolders[] = "documents-pribadi/pendidikan/bimbingan/{$newDosen1->username}-{$newDosen1->name}";
        }
        if ($newDosen2) {
            $newFolders[] = "documents-pribadi/pendidikan/bimbingan/{$newDosen2->username}-{$newDosen2->name}";
        }

        // ✅ Update data bimbingan
        $bimbingan->update([
            'nama' => $this->nama,
            'nim' => $this->nim,
            'prodi' => $this->prodi,
            'angkatan' => $this->angkatan,
            'judul' => $this->judul,
            'pembimbing_1' => $this->pembimbing_1,
            'pembimbing_2' => $this->pembimbing_2,
        ]);

        // ✅ Jika ada file baru
        if (!empty($this->newDocuments)) {
            // 🔴 Hapus file lama dari Google Drive (folder dosen lama)

            foreach ($bimbingan->documents as $doc) {
                foreach ($oldFolders as $folder) {
                    $path = $folder . '/' . basename($doc->document);
                    if (Storage::disk('google')->exists($path)) {
                        Storage::disk('google')->delete($path);
                    }
                }
            }

            // 🔴 Hapus data dokumen dari database
            $bimbingan->documents()->delete();

            // ✅ Upload file baru ke folder dosen baru
            foreach ($this->newDocuments as $file) {
                $extension = $file->getClientOriginalExtension();
                $timestamp = now()->format('Ymd_His');
                $fileName = Str::slug($this->nama) . "_{$timestamp}_" . uniqid() . ".{$extension}";

                foreach ($newFolders as $folder) {
                    if (!Storage::disk('google')->exists($folder)) {
                        Storage::disk('google')->makeDirectory($folder);
                    }

                    Storage::disk('google')->put("{$folder}/{$fileName}", file_get_contents($file->getRealPath()));
                }

                // Simpan satu path ke database (misal dari dosen1)
                BimbinganDocument::create([
                    'bimbingan_id' => $bimbingan->id,
                    'document' => "{$newFolders[0]}/{$fileName}",
                ]);
            }
        } else {
            // 🔄 Jika tidak ada file baru dan dosen berubah, salin file lama ke folder dosen baru
            if ($this->pembimbing_1 != $oldPembimbing1 || $this->pembimbing_2 != $oldPembimbing2) {
                foreach ($bimbingan->documents as $doc) {
                    $basename = basename($doc->document);
            
                    // Salin file ke folder dosen yang baru ditambahkan
                    foreach ($newFolders as $folder) {
                        $newPath = "{$folder}/{$basename}";
                        if (!Storage::disk('google')->exists($newPath)) {
                            foreach ($oldFolders as $oldFolder) {
                                $oldPath = "{$oldFolder}/{$basename}";
                                if (Storage::disk('google')->exists($oldPath)) {
                                    $fileContent = Storage::disk('google')->get($oldPath);
                                    Storage::disk('google')->put($newPath, $fileContent);
                                }
                            }
                        }
                    }
            
                    // Hapus hanya dari folder dosen yang berubah
                    if ($this->pembimbing_1 != $oldPembimbing1 && $oldDosen1) {
                        $oldFolder1 = "documents-pribadi/pendidikan/bimbingan/{$oldDosen1->username}-{$oldDosen1->name}";
                        $oldPath1 = "{$oldFolder1}/{$basename}";
                        if (Storage::disk('google')->exists($oldPath1)) {
                            Storage::disk('google')->delete($oldPath1);
                        }
                    }
            
                    if ($this->pembimbing_2 != $oldPembimbing2 && $oldDosen2) {
                        $oldFolder2 = "documents-pribadi/pendidikan/bimbingan/{$oldDosen2->username}-{$oldDosen2->name}";
                        $oldPath2 = "{$oldFolder2}/{$basename}";
                        if (Storage::disk('google')->exists($oldPath2)) {
                            Storage::disk('google')->delete($oldPath2);
                        }
                    }
            
                    // Update path di DB (salah satu folder baru)
                    $doc->update([
                        'document' => "{$newFolders[0]}/{$basename}",
                    ]);
                }
            }
            
        }
        session()->flash('success', 'Data bimbingan berhasil diperbarui!');
        $this->dispatch('notif');
        return redirect()->route('tendik.pembimbingan');
    }

    public function handleSaveOrUpdate()
    {

        if ($this->mode == 'edit') {
            $this->update(); // Panggil fungsi update
        } else {
            $this->upload(); // Panggil fungsi save
        }
    }

    public function render()
    {
        return view('livewire.edokumen.tendik.bimbingan.edit-data-pembimbingan', [
            'user' => User::where('level', 'Dosen')->get()
        ]);
    }
}
