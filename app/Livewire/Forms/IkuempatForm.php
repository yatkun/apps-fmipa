<?php

namespace App\Livewire\Forms;

use App\Models\Ikudua;
use App\Models\Ikuempat;
use Livewire\Form;
use App\Models\Ikusatu;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class IkuempatForm extends Form
{
    #[Validate(['required'])]
    public string $nama = '';

    #[Validate(['required'])]
    public string $kriteria = '';

    #[Validate(['required'])]
    public string $keterangan = '';

    #[Validate(['nullable', 'string'])]
    public ?string $bukti = null;

   

    public $ikuempat_id;

    public function store()
    {

        $validate = $this->validate();
        
       
        
        Ikuempat::create($validate);
      

        
    }

   
    public function update(){
        $validate = $this->validate();

    
        
   

        Ikuempat::where('id', $this->ikuempat_id)->update($validate);
    }
}
