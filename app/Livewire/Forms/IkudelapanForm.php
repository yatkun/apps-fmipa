<?php

namespace App\Livewire\Forms;

use App\Models\Ikudelapan;
use App\Models\Period;
use Livewire\Form;
use Livewire\Attributes\Validate;

class IkudelapanForm extends Form
{
    #[Validate(['required', 'string'])]
    public string $program_studi = '';

 

    #[Validate(['nullable', 'url'])]
    public string $bukti = '';
    
    public $ikudelapan_id;

    public function store()
    {
      
        $validate = $this->validate();
        // Auto-assign active period
        $activePeriod = Period::getActivePeriod();
        if ($activePeriod) {
            $validate['period_id'] = $activePeriod->id;
        }

        Ikudelapan::create($validate);
        $this->reset();
    }

    public function update()
    {
        $validate = $this->validate();
        
        Ikudelapan::find($this->ikudelapan_id)->update($validate);
        $this->reset();
    }

    public function resetForm()
    {
        $this->reset();
    }
}


