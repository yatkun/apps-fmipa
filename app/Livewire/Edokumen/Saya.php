<?php

namespace App\Livewire\Edokumen;


use Livewire\Component;
use App\Models\Dokumensaya;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Forms\Dokumen\PribadiForm;


use Illuminate\Support\Facades\Response;

class Saya extends Component
{
    use WithFileUploads;

    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';

    public $existingFile;
    public $mode = 'add';

    public PribadiForm $form;

  


    public function upload()
    {

        $this->form->store();
        session()->flash('success', 'Dokumen berhasil diupload.');
        $this->resetInput();
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
        $this->existingFile = '';
    }

    public function cancelEdit()
    {
        $this->resetInput(); // Clear form fields
        $this->mode = 'add'; // Switch back to 'add' mode
    }

    public function handleSaveOrUpdate()
    {

        if ($this->mode == 'edit') {
            $this->update_a(); // Panggil fungsi update
        } else {
            $this->upload(); // Panggil fungsi save
        }
    }

    // public function delete($id)
    // {
    //     $this->dispatch('showDeleteConfirmation', $id); // Emit an event to show the confirmation dialog
    // }

    public function delete($id)
    {
      
        $file = Dokumensaya::findOrFail($id);
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

        $doc = Dokumensaya::find($data);

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
        $file = Dokumensaya::findOrFail($document);
    
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
        return view('livewire.EDOKUMEN.saya', [
            'a' => Dokumensaya::when($this->sortDir, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            }, function ($query) {
                $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
            })
                ->search($this->search)
                ->where('user_id', Auth::id())
                ->paginate($this->perPage),
        ]);
    }
}
