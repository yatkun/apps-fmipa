<?php

namespace App\Livewire\Forms;
use Livewire\Form;
use App\Models\Setiku;
use App\Models\Ikusatu;
use App\Models\Period;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;

class IkusatuForm extends Form
{
    #[Validate(['required'])]
    public string $nama = '';

    #[Validate(['required'])]
    public string $program_studi = '';

    #[Validate(['required'])]
    public string $tanggal_lulus = '';

    #[Validate(['required'])]
    public string $pekerjaan = '';

    #[Validate(['required'])]
    public string $pendapatan = '';

    #[Validate(['required'])]
    public string $masa_tunggu = '';

    
    #[Validate(['nullable', 'string'])]
    public ?string $bukti = null;

    #[Validate(['required', 'numeric', 'min:0'])]
    public $ump = 1000000;

    public $ikusatu_id;

    public function store()
    {

        $validate = $this->validate();
        $validate['ump'] = $this->ump;

        // Auto-assign active period
        $activePeriod = Period::getActivePeriod();
        if ($activePeriod) {
            $validate['period_id'] = $activePeriod->id;
        }

        if (($validate['pekerjaan'] == 'Wirausaha') && ($validate['masa_tunggu'] <= 6)) {
            if ($validate['pendapatan'] >= 1.2 * $validate['ump']) {
                $validate['bobot'] = 1.2;
            } else {
                $validate['bobot'] = 1;
            }
        } elseif (($validate['pekerjaan'] == 'Wirausaha') && ($validate['masa_tunggu'] > 6)) {
            if ($validate['pendapatan'] >= 1.2 * $validate['ump']) {
                $validate['bobot'] = 1;
            } else {
                $validate['bobot'] = 0.8;
            }
        }


        if (($validate['pekerjaan'] == 'Bekerja') && ($validate['masa_tunggu'] <= 6)) {
            if ($validate['pendapatan'] >= 1.2 * $validate['ump']) {
                $validate['bobot'] = 1;
            } else {
                $validate['bobot'] = 0.7;
            }
        } elseif (($validate['pekerjaan'] == 'Bekerja') && ($validate['masa_tunggu'] > 6)) {
            if ($validate['pendapatan'] >= 1.2 * $validate['ump']) {
                $validate['bobot'] = 0.8;
            } else {
                $validate['bobot'] = 0.5;
            }
        }

        if ($validate['pekerjaan'] == 'Lanjut studi') {
            $validate['bobot'] = 1;
        }

        if ($validate['pekerjaan'] == '-') {
            $validate['bobot'] = 0;
            $validate['masa_tunggu'] = '-';
        }

        
        Ikusatu::create($validate);

        
    }

   
   
    public function update(){
        $validate = $this->validate();
        $validate['ump'] = $this->ump;

        if (($validate['pekerjaan'] == 'Wirausaha') && ($validate['masa_tunggu'] <= 6)) {
            if ($validate['pendapatan'] >= 1.2 * $validate['ump']) {
                $validate['bobot'] = 1.2;
            } else {
                $validate['bobot'] = 1;
            }
        } elseif (($validate['pekerjaan'] == 'Wirausaha') && ($validate['masa_tunggu'] > 6)) {
            if ($validate['pendapatan'] >= 1.2 * $validate['ump']) {
                $validate['bobot'] = 1;
            } else {
                $validate['bobot'] = 0.8;
            }
        }


        if (($validate['pekerjaan'] == 'Bekerja') && ($validate['masa_tunggu'] <= 6)) {
            if ($validate['pendapatan'] >= 1.2 * $validate['ump']) {
                $validate['bobot'] = 1;
            } else {
                $validate['bobot'] = 0.7;
            }
        } elseif (($validate['pekerjaan'] == 'Bekerja') && ($validate['masa_tunggu'] > 6)) {
            if ($validate['pendapatan'] >= 1.2 * $validate['ump']) {
                $validate['bobot'] = 0.8;
            } else {
                $validate['bobot'] = 0.5;
            }
        }

        if ($validate['pekerjaan'] == 'Lanjut studi') {
            $validate['bobot'] = 1;
        }

        Ikusatu::where('id', $this->ikusatu_id)->update($validate);
    }
}
