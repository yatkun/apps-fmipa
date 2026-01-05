<?php

namespace App\Livewire\IKU;

use App\Models\Setiku;
use App\Models\Ikusatu;
use App\Models\Period;
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
    public $sortDir = 'DESC'; // Default DESC untuk data terbaru di atas

    protected $paginationTheme = 'bootstrap';
    public IkusatuForm $form;

    public $mode = 'add';
    public $isEdit = false;

    protected $listeners = ['confirmDelete', 'period-changed' => 'handlePeriodChanged'];
    
    // Reset pagination when search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    // Reset pagination when perPage changes
    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function handlePeriodChanged()
    {
        $this->resetPage();
    }

    public function handleSaveOrUpdate()
    {
        if ($this->mode == 'edit') {
            $this->update(); // Panggil fungsi update
        } else {
            $this->save(); // Panggil fungsi save
        }
    }


    public function save()
    {
        $this->form->store();
        
        // Reset form dan mode
        $this->resetInput();
        $this->mode = 'add';
        
        session()->flash('success', 'Data berhasil ditambahkan !');
        
        // Emit events
        $this->dispatch('notif');
        $this->dispatch('closemodal');
        $this->dispatch('iku1store');
        
        // Reset Livewire internal state
        $this->reset(['mode', 'isEdit']);
        
        // Reset pagination to page 1
        $this->resetPage();
    }
   

    public function save_lulusan()
    {

        $this->a->update(['jml_lulusan' => $this->jml_lulusan]);

        $validatedData = Validator::make(
            ['jml_lulusan' => $this->jml_lulusan],
            ['jml_lulusan' => 'required'],
            ['required' => 'The :attribute field is required'],
        )->validate();

        if (Setiku::where('id', 1)) {
            Setiku::where('id', 1)->update($validatedData);
        }





        session()->flash('success', 'Data berhasil disimpan !');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('iku1store');
    }

    public function modes()
    {
        $this->resetInput();
        $this->mode = 'add';
        $this->isEdit = false;
        $this->form->reset(); // Reset form object
    }
    
    private function resetInput()
    {
        $this->form->reset(); // Reset entire form object
        $this->form->ump = 1000000; // Reset to default value
        $this->isEdit = false;
    }

    public function setsortBy($sortByField)
    {
        // Jika field yang sama diklik
        if ($this->sortBy === $sortByField) {
            // Toggle between ASC and DESC
            $this->sortDir = $this->sortDir === 'ASC' ? 'DESC' : 'ASC';
        } else {
            // Jika field yang berbeda diklik, set field baru dengan ASC
            $this->sortBy = $sortByField;
            $this->sortDir = 'ASC';
        }
    }


    public function updateiku1($data)
    {

        $this->mode = 'edit';
        $this->form->ikusatu_id = $data['id'];
        $this->form->nama = $data['nama'];
        $this->form->program_studi = $data['program_studi'];
        $this->form->tanggal_lulus = $data['tanggal_lulus'];
        $this->form->pekerjaan = $data['pekerjaan'];
        $this->form->pendapatan = $data['pendapatan'];
        $this->form->ump = $data['ump'] ?? 1000000; // Set UMP or default value
        $this->form->masa_tunggu = $data['masa_tunggu'];
        $this->form->bukti = $data['bukti'];
    }
    public function update()
    {
        $this->form->update();
        
        // Reset form dan mode sebelum dispatch
        $this->resetInput();
        $this->mode = 'add';
        
        session()->flash('success', 'Data berhasil diupdate !');
        
        // Emit events
        $this->dispatch('notif');
        $this->dispatch('closemodal');
        $this->dispatch('iku1store');
        
        // Reset Livewire internal state
        $this->reset(['mode', 'isEdit']);
        
        // Don't reset page on update, stay on current page
        // $this->resetPage();
    }

    public function cancelEdit()
    {
        $this->resetInput(); // Clear form fields
        $this->mode = 'add'; // Switch back to 'add' mode
    }

    public function deleteIku1($id)
    {
        $this->dispatch('showDeleteConfirmation', id: $id);
    }

    public function confirmDelete($id)
    {
        Ikusatu::where('id', $id)->delete();

        session()->flash('success', 'Data berhasil dihapus!');
        $this->dispatch('notif');
        
        // Reset to page 1 after delete to avoid empty page
        $this->resetPage();
    }

    public function render()
    {
        $activePeriod = Period::getActivePeriod();
        
        return view('livewire.IKU.iku1', [
            'ikusatu' => Ikusatu::bySessionPeriod()
                ->orderBy($this->sortBy, $this->sortDir)
                ->search($this->search)
                ->paginate($this->perPage),
            'a' => Ikusatu::bySessionPeriod()->where('pekerjaan', 'Bekerja')->count(),
            'aa' => Ikusatu::bySessionPeriod()->where('pekerjaan', 'Bekerja')->sum('bobot'),
            'b' => Ikusatu::bySessionPeriod()->where('pekerjaan', 'Wirausaha')->count(),
            'bb' => Ikusatu::bySessionPeriod()->where('pekerjaan', 'Wirausaha')->sum('bobot'),
            'c' => Ikusatu::bySessionPeriod()->where('pekerjaan', 'Lanjut studi')->count(),
            'cc' => Ikusatu::bySessionPeriod()->where('pekerjaan', 'Lanjut studi')->sum('bobot'),
            'd' => Ikusatu::bySessionPeriod()->count(),
            'activePeriod' => $activePeriod,
        ]);
    }
}
