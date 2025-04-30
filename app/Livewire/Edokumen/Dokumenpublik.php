<?php

namespace App\Livewire\Edokumen;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Forms\Dokumen\PublikForm;
use App\Models\Dokumenpublik as ModelsDokumenpublik;

class Dokumenpublik extends Component
{


    use WithFileUploads;
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';
 
    public $existingFile;

    public $mode = 'add';

    public PublikForm $form;
    public $nama;
    public $document;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'document' => 'required',
    ];

    public $title = 'Dokumen Publik';

    public function upload()
    {

        $this->form->store();
        session()->flash('success', 'Dokumen berhasil ditambahkan !');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('closemodal');
    }

    public function upload_link()
    {   

        $data = ModelsDokumenpublik::create([
            'nama' => $this->nama,
            'document' => $this->document,
            'icon' => 'mdi mdi-google-drive',
            'user_id' => Auth::id(), // Simpan ID pengguna saat ini
        ]);


        
        session()->flash('success', 'Dokumen berhasil ditambahkan !');
        $this->resetLink();
        $this->dispatch('notif');
        $this->dispatch('closemodal');
    }

    public function setsortBy($sortByField)
    {

        // Jika field yang sama diklik
        if ($this->sortBy === $sortByField) {
            // Jika saat ini ASC, ubah menjadi DESC
            if ($this->sortDir === 'ASC') {
                $this->sortDir = 'DESC';
            }
            // Jika saat ini DESC, reset ke default
            elseif ($this->sortDir === 'DESC') {
                $this->sortDir = 'ASC';  // null berarti urutan default
                $this->sortBy = 'created_at';  // kembali ke default sorting
            }
            // Jika saat ini null (default), set ke ASC
            else {
                $this->sortDir = 'ASC';
            }
        } else {
            // Jika field yang berbeda diklik, set ke ASC
            $this->sortBy = $sortByField;
            $this->sortDir = 'ASC';
        }
    }
    public function modes()
    {
        $this->resetInput();
        $this->mode = 'add';
    }

    private function resetInput()
    {
        $this->form->nama = '';
        $this->form->document = '';
    }

    public function resetLink()
    {
        $this->nama = '';
        $this->document = '';
    }

    public function cancelEdit()
    {
        $this->resetInput(); // Clear form fields
        $this->mode = 'add'; // Switch back to 'add' mode
        $this->existingFile = '';
    }

    public function handleSaveOrUpdate()
    {

        if ($this->mode == 'edit') {
            $this->update_a(); // Panggil fungsi update
        } else {

            $this->upload(); // Panggil fungsi save
        }
    }
    public function submit_link()
    {

        if ($this->mode == 'edit') {
            $this->update_link(); // Panggil fungsi update
        } else {
        
            $this->upload_link(); // Panggil fungsi save
        }
    }

    // public function delete($id)
    // {
    //     $this->dispatch('showDeleteConfirmation', $id); // Emit an event to show the confirmation dialog
    // }

    public function delete($id)
    {
      
        $file = ModelsDokumenpublik::findOrFail($id);
        $filePath = $file->document;


        if (Storage::disk('google')->exists($filePath)) {
            Storage::disk('google')->delete($filePath);
        }

        $file->delete();

        
        session()->flash('success', 'Dokumen berhasil dihapus.');
        $this->dispatch('notif'); 
    
        
    }

    public function update($data)
    {

        $this->mode = 'edit';
        $this->form->dokumen_id = $data['id'];
        $this->form->nama = $data['nama'];

        $doc = ModelsDokumenpublik::find($data);

        if ($doc) {
            $this->form->dokumen_id = $data['id'];
            $this->form->nama = $data['nama'];
            $this->existingFile =  $data['document']; // Simpan path dokumen lama
        }
    }

    public function update_a()
    {
        $this->form->update();
        session()->flash('success', 'Dokumen berhasil diupdate !');
        $this->resetInput();
        $this->mode = 'add';
        // Emit event untuk JavaScript
        $this->dispatch('notif');
        $this->dispatch('closemodal');
    }



    public function download($document)
    {
  
        $file = ModelsDokumenpublik::findOrFail($document);
    
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
    public function preview($filePath)
    {
        if (Storage::disk('public')->exists($filePath)) {
            return response()->file(storage_path("app/public/{$filePath}"));
        } else {
            session()->flash('error', 'File tidak ditemukan.');
        }
    }
    
    public function render()
    {
        
        return view('livewire.EDOKUMEN.dokumenpublik',[
            'title' => $this->title,
            'a' => ModelsDokumenpublik::when($this->sortDir, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            }, function ($query) {
                $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
            })
                ->search($this->search)
                ->paginate($this->perPage),
        ]);
   
    }
}
