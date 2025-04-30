<?php

namespace App\Livewire\Edokumen;

use App\Models\Dokumentertandai;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadTertandai extends Component
{
    use WithFileUploads;
    public $existingFile;
    public $mode = 'add';

    public $nama;
    public $document;
    public $dokumenId;
    public $pengguna = [];

    protected $rules = [
        'nama' => 'required|string|max:255',
        'document' => 'required|max:10240',
        'pengguna' => 'min:1'
    ];

    protected $messages = [
        'nama.required' => 'Nama dokumen harus diisi',
        'nama.max:255' => 'Maksimal 255 karakter',
        'document.required' => 'Dokumen harus diunggah',
        'document.max:10240' => 'Dokumen maksimal 10 MB',
        'pengguna.min:1' => 'Pengguna harus dipilih (minimal 1)',
    ];
   
 
    protected $listeners = ['editDokumen'];

    public function editDokumen($data)
    {
        $this->dokumenId = $data['id'];
        $this->nama = $data['nama'];
        
        $dokumen = Dokumentertandai::find($data);

        if ($dokumen) {
            $this->dokumenId = $data['id'];
            $this->nama = $data['nama'];
            $this->existingFile =  $data['document']; // Simpan path dokumen lama
        }
        
    }

   
  

    public function upload()
    {
     
        $this->validate();
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
        $googleFolder = "documents-tertandai/{$username}";

        if (!Storage::disk('google')->exists($googleFolder)) {
            Storage::disk('google')->makeDirectory($googleFolder);
        }
        Storage::disk('google')->put("{$googleFolder}/{$fileName}", file_get_contents($this->document->getRealPath()));

        $filePath = "{$googleFolder}/{$fileName}";

        // Simpan informasi file ke database dengan user_id
        $data = Dokumentertandai::create([
            'nama' => $this->nama,
            'document' => $filePath,
            'icon' => $icon,
            'user_id' => Auth::id(), // Simpan ID pengguna saat ini
        ]);
         // Menambahkan ID pengguna yang login ke dalam daftar pengguna yang dipilih
         $allPengguna = array_merge($this->pengguna, [Auth::id()]); // Pastikan kita menambahkan ID pengguna yang login

         // Sync pengguna ke dalam pivot table dokumen_user
         $data->pengguna()->sync($allPengguna);


        session()->flash('success', 'Dokumen berhasil ditambahkan !');
        $this->dispatch('notif');
        return redirect()->route('dokumen.tandai');
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
        return view('livewire.EDOKUMEN.upload-tertandai', [
            'user' => User::all()
        ]);
    }
}
