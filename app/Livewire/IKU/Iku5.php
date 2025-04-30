<?php

namespace App\Livewire\IKU;

use App\Models\Ikulima;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\IkulimaForm;

class Iku5 extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';
    public $mode = 'add';

    public $kriteriaOptions = [];

    public IkulimaForm $form;

    protected $listeners = ['confirmDelete'];


    public function updatedFormJenisKarya($value)
    {

        if ($value === 'Karya Tulis Ilmiah') {
            $this->kriteriaOptions = [
                'Buku referensi',
                'Jurnal internasional bereputasi',
                'Buku nasional/internasional yang mempunyai ISBN',
                'Book chapter internasional',
                'Jurnal nasional berbahasa inggris atau bahasa resmi PBB terindeks pada DOAJ',
                'Prosiding internasional dalam seminar internasional, dalam bentuk monograf, atau ',
                'Hasil penelitian kerjasama industri termasuk penugasan dari kementerian atau
LPNK yang tidak dipublikasikan','Untuk Karya Tulis Ilmiah yang tidak masuk dalam Kriteria di atas'
            ];
        } elseif ($value === 'Karya Terapan') {
            $this->kriteriaOptions = [
                'Karya Terapan yang diterapkan/digunakan/diaplikasikan pada Dunia Usaha dan Dunia Industri atau Masyarakat pada tingkat internasional atau Nasional; atau',
                'Hasil Rancangan Teknologi/Seni yang dipatenkan secara internasional',
                'Karya Terapan yang belum diterapkan tetapi sudah mendapatkan ijin edar atau sudah terstandarisasi',
                'Hasil Rancangan Teknologi/Seni yang dipatenkan secara Nasional; atau melaksanakan pengembangan hasil pendidikan dan penelitian'
            ];
        } elseif ($value === 'Karya Seni') {
            $this->kriteriaOptions = [
                'Melaksanakan dan/atau menghasilkan karya seni atau kegiatan seni pada tingkat internasional',
                'Melaksanakan dan/atau menghasilkan karya seni atau kegiatan seni pada tingkat Nasional',
                'Membuat rancangan karya seni atau kegiatan seni tingkat internasional; atau melaksanakan penelitian di bidang seni yang dipatenkan atau dipublikasikan dalam seminar nasional',
                'Melaksanakan dan/atau menghasilkan karya seni atau kegiatan seni pada tingkat lokal',
                'Membuat rancangan karya seni atau kegiatan seni tingkat nasional; atau melaksanakan penelitian di bidang seni yang tidak dipatenkan atau dipublikasikan'
            ];
        } else {
            $this->kriteriaOptions = []; // Kosongkan opsi jika tidak ada pilihan
        }

        // Kosongkan pilihan kriteria saat jenis_karya berubah
        $this->form->kriteria = '';
    }
    // Fungsi untuk memperbarui opsi kriteria ketika jenis_karya berubah

    public function modes()
    {
        $this->resetInput();
        $this->mode = 'add';
    }

    public function save()
    {
        $this->form->store();
        session()->flash('success', 'Data berhasil ditambahkan !');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('iku1store');
        $this->dispatch('closemodal');
    }

    
    private function resetInput()
    {
        $this->form->nama = '';
        $this->form->jenis_karya = '';
        $this->form->kriteria = '';
        $this->form->tanggal = '';
        $this->form->keterangan = '';
        $this->form->bukti = '';
    }

    public function deleteIku5($id)
    {
        $this->dispatch('showDeleteConfirmation', $id); // Emit an event to show the confirmation dialog
    }

    public function confirmDelete($id)
    {
        Ikulima::where('id', $id)->delete();

        session()->flash('success', 'Data berhasil dihapus!');
        $this->dispatch('notif'); // Emit any notification event if needed
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
            $this->save(); // Panggil fungsi save
        }
    }


    public function update($data)
    {
       
        $this->mode = 'edit';
        $this->dispatch('modalIku5');
        $this->form->ikulima_id = $data['id'];
        $this->form->nama = $data['nama'];
        $this->form->jenis_karya = $data['jenis_karya'];
        $this->form->kriteria = $data['kriteria'];
        $this->form->tanggal = $data['tanggal'];
        $this->form->keterangan = $data['keterangan'];
        $this->form->bukti = $data['bukti'];
    }
    public function update_a()
    {
        $this->form->update();

        $this->dispatch('iku1store');
        session()->flash('success', 'Data berhasil diupdate !');
        $this->resetInput();
        $this->mode = 'add';
        // Emit event untuk JavaScript
        $this->dispatch('notif');
        $this->dispatch('closemodal');
    }




    public function render()
    {
        return view('livewire.IKU.iku5', [
            'a' => Ikulima::when($this->sortDir, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            }, function ($query) {
                $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
            })
                ->search($this->search)
                ->paginate($this->perPage),
        ]);
    }
}
