<?php

namespace App\Livewire\Forms;

use App\Models\Ikudua;
use App\Models\Ikuenam;
use Livewire\Form;
use App\Models\Ikusatu;
use App\Models\Ikutujuh;
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
    
    
    public $ikutujuh_id;

    public function store()
    {
    
        $validate = $this->validate();
        
        $validate['bobot'] = 1.0;
        
        Ikutujuh::create($validate);
    }

  
    public function update()
    {

        $validate = $this->validate();
       
            $validate['bobot'] = 1.0;
        

        Ikutujuh::where('id', $this->ikutujuh_id)->update($validate);
    }
}
