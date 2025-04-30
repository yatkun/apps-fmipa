<?php

namespace App\Livewire\Edokumen;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokumentertandai as ModelsDokumentertandai;


class DokumenTertandai extends Component
{

    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';

    public $pengguna = [];
    public $penggunaOptions = [];
    public $userId;
    public $mode = 'add';
    public $nama;
    public $document = [];
    public $doc;
    public $documentId;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'doc' => 'required',
        'pengguna' => 'required|array|min:1'
    ];

    protected $messages = [
        'nama.required' => 'Nama dokumen harus diisi',
        'nama.max' => 'Maksimal 255 karakter',
        'doc.required' => 'Link dokumen harus diisi',
        'pengguna.required' => 'Pengguna harus dipilih',
        'pengguna.array' => 'Format pengguna tidak valid',
        'pengguna.min' => 'Pengguna harus dipilih (minimal 1)',
    ];

    public function mount()
    {
        $this->dispatch('notif');
        $userId = Auth::user()->id;
        $this->userId = $userId;
        $this->loadDokumen();
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

    public function handleSaveOrUpdate()
    {

        if ($this->mode == 'edit') {
            $this->update_a(); // Panggil fungsi update
        } else {

            $this->upload(); // Panggil fungsi save
        }
    }

    public function update($data)
    {

        $this->mode = 'edit';
        $this->documentId = $data['id'];
        $this->nama = $data['nama'];
        $this->doc = $data['document'];

        $doc = ModelsDokumentertandai::findOrFail($data['id']);

        if ($doc) {
            $this->documentId = $data['id'];
            $this->nama = $data['nama'];
            $this->doc = $data['document']; // Simpan path dokumen lama
        }

        $documentId = $data['id'];

        // Pastikan pengguna adalah array
        $this->pengguna = $doc->pengguna->pluck('id')->toArray();

        // Ambil daftar pengguna dari database untuk Select2
        $this->penggunaOptions = User::pluck('name', 'id')->toArray();
    }

    public function upload()
    {

        $validate = $this->validate();
        $username = Auth::user()->username;

        $data = ModelsDokumentertandai::create([
            'nama' => $this->nama,
            'document' => $this->doc,
            'icon' => 'mdi mdi-google-drive',
            'user_id' => Auth::id(), // Simpan ID pengguna saat ini
        ]);

        $allPengguna = array_merge($this->pengguna, [Auth::id()]);
        $data->pengguna()->sync($allPengguna);
        session()->flash('success', 'Dokumen berhasil ditambahkan !');
        $this->dispatch('notif');
        return redirect()->route('dokumen.tandai');
    }

    public function loadDokumen()
    {
        // Pastikan ID pengguna valid
        $user = User::find($this->userId);

        if ($user && $user->dokumen) {
            $this->document = $user->dokumen;
        } else {
            $this->document = collect(); // Mengembalikan koleksi kosong jika tidak ada data
        }
    }


    public function download($document)
    {

        $file = ModelsDokumentertandai::findOrFail($document);

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

    public function delete($id)
    {
      
        $file = ModelsDokumentertandai::findOrFail($id);
        $filePath = $file->document;


        if (Storage::disk('google')->exists($filePath)) {
            Storage::disk('google')->delete($filePath);
        }

        $file->delete();

        
        session()->flash('success', 'Dokumen berhasil dihapus.');
        $this->dispatch('notif'); 
    
        
    }


    public function render()
    {

        // Melakukan query untuk mengambil data dokumen yang tertandai
        $dokumen = ModelsDokumentertandai::query()
            ->when($this->sortBy, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            })
            ->whereHas('pengguna', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->with('pengguna') // untuk eager loading data pengguna
            ->search($this->search)
            ->paginate($this->perPage);



        // Mengembalikan data untuk view
        return view('livewire.EDOKUMEN.dokumen-tertandai', [
            'dok' => $dokumen,
            // 'dok' => $this->document,
            'user' => User::all()
        ]);
    }
}
