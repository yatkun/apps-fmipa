<?php

namespace App\Livewire\Forms;

use App\Models\Ikudua;
use App\Models\Ikuenam;
use Livewire\Form;
use App\Models\Ikusatu;
use App\Models\Ikutujuh;
use App\Models\Skripsi;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class Eskripsi extends Form
{
    #[Validate(['required'])]
    public string $nama = '';

    #[Validate(['required'])]
    public string $judul = '';

    #[Validate(['required'])]
    public string $pembimbing_1 = '';


    #[Validate(['required'])]
    public string $pembimbing_2 = '';
    
    
    public $skripsi_id;

    public function store()
    {
    
        $validate = $this->validate();
        
        
        Skripsi::create($validate);
    }

  
    public function update()
    {

        $validate = $this->validate();
       

        Skripsi::where('id', $this->skripsi_id)->update($validate);
    }
}
