<?php

namespace App\Livewire\Forms;
use Livewire\Form;
use App\Models\Ikusatu;
use App\Models\Ikutiga;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class IkutigaForm extends Form
{
    #[Validate(['required'])]
    public string $nama = '';

    #[Validate(['required'])]
    public string $kriteria = '';

    #[Validate(['required'])]
    public string $keterangan = '';

    #[Validate(['nullable', 'string'])]
    public ?string $bukti = null;
   

    public $ikutiga_id;

    public function store()
    {

        $validate = $this->validate();

        if($validate['kriteria'] == 'Tridharma'){
            $validate['bobot'] = 1;
        }elseif($validate['kriteria'] == 'Praktisi'){
            $validate['bobot'] = 1;
        }else{
            $validate['bobot'] = 0.75;
        }
        
        Ikutiga::create($validate);
      

        
    }

   
    public function update(){
        $validate = $this->validate();

        if($validate['kriteria'] == 'Tridharma'){
            $validate['bobot'] = 1;
        }elseif($validate['kriteria'] == 'Praktisi'){
            $validate['bobot'] = 1;
        }else{
            $validate['bobot'] = 0.75;
        }
        
   

        Ikutiga::where('id', $this->ikutiga_id)->update($validate);
    }
}
