<?php

namespace App\Livewire\Forms;

use App\Models\Ikudua;
use App\Models\Ikuenam;
use App\Models\Period;
use Livewire\Form;
use App\Models\Ikusatu;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class IkuenamForm extends Form
{
    #[Validate(['required'])]
    public string $kriteria = '';



    #[Validate(['required'])]
    public string $nama = '';
    
    #[Validate(['nullable', 'string'])]
    public ?string $bukti = null;
    
    public $ikuenam_id;

    public function store()
    {
    
        $validate = $this->validate();
        if($validate['kriteria'] == 'Perusahaan multinasional' || $validate['kriteria'] == 'Organisasi nirlaba kelas dunia'){
            $validate['bobot'] = 0.75;
        }elseif($validate['kriteria'] == 'Perusahaan nasional berstandar tinggi, BUMN, dan/atau BUMD' || $validate['kriteria'] == 'Perusahaan rintisan (startup company) teknologi' 
        || $validate['kriteria'] == 'Perguruan tinggi yang masuk dalam daftar QS200 berdasarkan bidang ilmu (QS200 by subject) perguruan tinggi dalam negeri' ){
            $validate['bobot'] = 0.5;
        }elseif($validate['kriteria'] == 'Perusahaan teknologi global'
        || $validate['kriteria'] == 'Institusi/organisasi multilateral'
        || $validate['kriteria'] == 'Perguruan tinggi yang masuk dalam daftar QS200 berdasarkan bidang ilmu (QS200 by subject) perguruan tinggi luar negeri'
        ){
            $validate['bobot'] = 1.0;
        }elseif($validate['kriteria'] == 'Instansi pemerintah'
        || $validate['kriteria'] == 'Rumah sakit'
        || $validate['kriteria'] == 'Lembaga riset pemerintah, swasta, nasional, maupun internasional'
        || $validate['kriteria'] == 'Lembaga kebudayaan berskala nasional/bereputasi'
        ){
            $validate['bobot'] = 0.3;
        }
        
        // Auto-assign active period
        $activePeriod = Period::getActivePeriod();
        if ($activePeriod) {
            $validate['period_id'] = $activePeriod->id;
        }

        Ikuenam::create($validate);
    }

  
    public function update()
    {

        $validate = $this->validate();
        if($validate['kriteria'] == 'Perusahaan multinasional' || $validate['kriteria'] == 'Organisasi nirlaba kelas dunia'){
            $validate['bobot'] = 0.75;
        }elseif($validate['kriteria'] == 'Perusahaan nasional berstandar tinggi, BUMN, dan/atau BUMD' || $validate['kriteria'] == 'Perusahaan rintisan (startup company) teknologi' 
        || $validate['kriteria'] == 'Perguruan tinggi yang masuk dalam daftar QS200 berdasarkan bidang ilmu (QS200 by subject) perguruan tinggi dalam negeri' ){
            $validate['bobot'] = 0.5;
        }elseif($validate['kriteria'] == 'Perusahaan teknologi global'
        || $validate['kriteria'] == 'Institusi/organisasi multilateral'
        || $validate['kriteria'] == 'Perguruan tinggi yang masuk dalam daftar QS200 berdasarkan bidang ilmu (QS200 by subject) perguruan tinggi luar negeri'
        ){
            $validate['bobot'] = 1.0;
        }elseif($validate['kriteria'] == 'Instansi pemerintah'
        || $validate['kriteria'] == 'Rumah sakit'
        || $validate['kriteria'] == 'Lembaga riset pemerintah, swasta, nasional, maupun internasional'
        || $validate['kriteria'] == 'Lembaga kebudayaan berskala nasional/bereputasi'
        ){
            $validate['bobot'] = 0.3;
        }

        Ikuenam::where('id', $this->ikuenam_id)->update($validate);
    }
}
