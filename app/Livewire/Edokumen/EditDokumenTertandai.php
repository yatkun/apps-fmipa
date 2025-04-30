<?php

namespace App\Livewire\Edokumen;

use view;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Dokumentertandai;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditDokumenTertandai extends Component
{
    use WithFileUploads;
    public $existingFile;
    public $nama;
    public $icon;   
    public $document;
    public $dokumenId;
    public $pengguna = [];
    public $penggunaOptions = [];
    public $mode = 'edit';

  
   
    public function mount($hashid)
    {
      

        $decodedId = Hashids::decode($hashid);
        if (empty($decodedId)) {
            abort(404, 'Dokumen tidak ditemukan');
        }
        $id = $decodedId[0];
        $dokumen = Dokumentertandai::findOrFail($id);
       $this->icon = $dokumen->icon;

        if ($dokumen) {
            $this->dokumenId = $dokumen->id;
            $this->nama = $dokumen->nama;
            $this->existingFile =  $dokumen['document']; // Simpan path dokumen lama
            $this->document =  $dokumen['document']; // Simpan path dokumen lama
        }
        $this->dokumenId = $dokumen->id;
        
        // Pastikan pengguna adalah array

        $this->pengguna = $dokumen->pengguna->pluck('id')->toArray();

        // Ambil daftar pengguna dari database untuk Select2
        $this->penggunaOptions = User::pluck('name', 'id')->toArray();
        
    }


    public function download($dokumenId)
    {
        
        $this->mode = 'download';
        $file = Dokumentertandai::findOrFail($dokumenId);
        

        $filePath = $file->document;
        $fileName = basename($filePath);


        // Periksa apakah file ada di Google Drive
        if (!Storage::disk('google')->exists($filePath)) {
            session()->flash('error', 'File not found on Google Drive');
            return;
        }

        // Ambil konten file dari Google Drive
        $fileContent = Storage::disk('google')->get($filePath);
        // Kembalikan sebagai response download
        return response()->streamDownload(function () use ($fileContent) {
            echo $fileContent;
        }, $fileName);
    }

    public function update(){
       
        $doc = Dokumentertandai::find($this->dokumenId);
      
        if($doc && $doc->icon == 'mdi mdi-google-drive'){
            $doc->nama = $this->nama;
            $doc->document = $this->document;
        }

        $allPengguna = array_merge($this->pengguna, [Auth::id()]); // Pastikan kita menambahkan ID pengguna yang login

         // Sync pengguna ke dalam pivot table dokumen_user
         $doc->pengguna()->sync($allPengguna);

        $doc->save();
        session()->flash('success', 'Dokumen berhasil diperbarui.');
        return redirect()->route('dokumen.tandai');
      
    }
    public function render()
    {
        return view('livewire.EDOKUMEN.edit-dokumen-tertandai', [
            'user' => User::all()
        ]);
    }
}
