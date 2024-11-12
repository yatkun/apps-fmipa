<?php

namespace App\Livewire\IKU;

use App\Models\Ikutiga;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\IkuempatForm;

class Iku4 extends Component
{

    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';
    public $mode = 'add';

    public IkuempatForm $form;

    protected $listeners = ['confirmDelete'];
    
    public function render()
    {
        return view('livewire.IKU.iku4', [
            'a' => Ikutiga::when($this->sortDir, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            }, function ($query) {
                $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
            })
                ->search($this->search)
                ->paginate($this->perPage),
        ]);
    }
}
