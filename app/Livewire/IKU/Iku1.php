<?php

namespace App\Livewire\IKU;

use App\Models\Setiku;
use App\Models\Ikusatu;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use App\Livewire\Forms\IkusatuForm;
use Illuminate\Support\Facades\Validator;

class Iku1 extends Component
{

    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';


    public IkusatuForm $form; 


   
    public $mode = 'add';

    public $isModalOpen = false;
    protected $listeners = ['confirmDelete'];


    public function save()
    {
        $this->form->store();
        session()->flash('success', 'Data berhasil ditambahkan !');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('iku1store');
    }

    public function save_lulusan()
    {

        $this->a->update(['jml_lulusan' => $this->jml_lulusan]);
        
        $validatedData = Validator::make(
            ['jml_lulusan' => $this->jml_lulusan],
            ['jml_lulusan' => 'required'],
            ['required' => 'The :attribute field is required'],
        )->validate();

        if(Setiku::where('id', 1)){
            Setiku::where('id', 1)->update($validatedData);
        }



        
        
        session()->flash('success', 'Data berhasil disimpan !');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('iku1store');
    }


    private function resetInput()
    {
        $this->form->nama = '';
        $this->form->program_studi = '';
        $this->form->tanggal_lulus = '';
        $this->form->pekerjaan = '';
        $this->form->pendapatan = '';
        $this->form->masa_tunggu = '';
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

  
    public function updateiku1($data)
    {
            $this->dispatch('openModal');
            $this->form->ikusatu_id = $data['id'];
            $this->form->nama = $data['nama'];
            $this->form->program_studi = $data['program_studi'];
            $this->form->tanggal_lulus = $data['tanggal_lulus'];
            $this->form->pekerjaan = $data['pekerjaan'];
            $this->form->pendapatan = $data['pendapatan'];
            $this->form->masa_tunggu = $data['masa_tunggu'];
    }
    public function update()
    {
    
        $this->form->update();

        $this->dispatch('iku1store');
        session()->flash('success', 'Data berhasil diupdate !');
        $this->resetInput();
        $this->mode = 'add';
        // Emit event untuk JavaScript
        $this->dispatch('notif');
    }

    public function cancelEdit()
    {
        $this->resetInput(); // Clear form fields
        $this->mode = 'add'; // Switch back to 'add' mode
    }

    public function deleteIku1($id)
    {
        $this->dispatch('showDeleteConfirmation', $id); // Emit an event to show the confirmation dialog
    }

    public function confirmDelete($id)
    {
        Ikusatu::where('id', $id)->delete();

        session()->flash('success', 'Data berhasil dihapus!');
        $this->dispatch('notif'); // Emit any notification event if needed
    }

    public function render()
    {
        return view('livewire.IKU.iku1', [
            'ikusatu' => Ikusatu::when($this->sortDir, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            }, function ($query) {
                $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
            })
                ->search($this->search)
                ->paginate($this->perPage),
            'a' => Ikusatu::where('pekerjaan', 'Bekerja')->count(),
            'aa' => Ikusatu::where('pekerjaan', 'Bekerja')->sum('bobot'),
            'b' => Ikusatu::where('pekerjaan', 'Wirausaha')->count(),
            'bb' => Ikusatu::where('pekerjaan', 'Wirausaha')->sum('bobot'),
            'c' => Ikusatu::where('pekerjaan', 'Lanjut studi')->count(),
            'cc' => Ikusatu::where('pekerjaan', 'Lanjut studi')->sum('bobot'),
            'd' => Ikusatu::all()->count()
        ]);
    }
}
