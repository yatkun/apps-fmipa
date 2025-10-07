<?php

namespace App\Livewire\Forms;

use App\Models\Ikudelapan;
use App\Models\Period;
use Livewire\Form;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class IkudelapanForm extends Form
{
    #[Validate(['required'])]
    public string $mata_kuliah = '';

    #[Validate(['required'])]
    public string $nama = '';

    #[Validate(['required'])]
    public string $semester = '';


    #[Validate(['required'])]
    public string $link = '';
    
    
    public $ikudelapan_id;

    public function store()
    {
    
        $validate = $this->validate();
        
        $validate['bobot'] = 1.0;
        
        // Auto-assign active period
        $activePeriod = Period::getActivePeriod();
        if ($activePeriod) {
            $validate['period_id'] = $activePeriod->id;
        }

        Ikudelapan::create($validate);
    }

  
    public function update()
    {

        $validate = $this->validate();
       
        $validate['bobot'] = 1.0;
        

        Ikudelapan::where('id', $this->ikudelapan_id)->update($validate);
    }
}
