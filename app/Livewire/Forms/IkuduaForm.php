<?php

namespace App\Livewire\Forms;

use App\Models\Ikudua;
use Livewire\Form;
use App\Models\Ikusatu;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class IkuduaForm extends Form
{
    #[Validate(['required'])]
    public string $nama = '';

    #[Validate(['required'])]
    public string $program_studi = '';


    #[Validate(['required'])]
    public string $sks_juara = '';


    #[Validate(['required'])]
    public string $keterangan = '';
    
    #[Validate([''])]
    public string $level = '';

    #[Validate(['nullable', 'string'])]
    public ?string $bukti = null;

    public $ikudua_id;

    public function store_a()
    {
    
        $validate = $this->validate();
        $validate['kategori'] = 'Kegiatan Luar Prodi';
     

        $validate['bobot'] = $validate['sks_juara'] / 20;
        Ikudua::create($validate);
    }

    public function store_b()
    {

        $validate = $this->validate();
        $validate['kategori'] = 'Prestasi';

        if ($validate['sks_juara'] == 1 && $validate['level'] == 'Internasional') {
            $validate['bobot'] = 1;
        } elseif ($validate['sks_juara'] == 1 && $validate['level'] == 'Nasional') {
            $validate['bobot'] = 0.7;
        } elseif ($validate['sks_juara'] == 1 && $validate['level'] == 'Provinsi') {
            $validate['bobot'] = 0.4;
        } elseif ($validate['sks_juara'] == 2 && $validate['level'] == 'Internasional') {
            $validate['bobot'] = 0.9;
        } elseif ($validate['sks_juara'] == 2 && $validate['level'] == 'Nasional') {
            $validate['bobot'] = 0.6;
        } elseif ($validate['sks_juara'] == 2 && $validate['level'] == 'Provinsi') {
            $validate['bobot'] = 0.3;
        } elseif ($validate['sks_juara'] == 3 && $validate['level'] == 'Internasional') {
            $validate['bobot'] = 0.8;
        } elseif ($validate['sks_juara'] == 3 && $validate['level'] == 'Nasional') {
            $validate['bobot'] = 0.5;
        } elseif ($validate['sks_juara'] == 3 && $validate['level'] == 'Provinsi') {
            $validate['bobot'] = 0.2;
        } elseif ($validate['sks_juara'] == 'Peserta') {
            $validate['bobot'] = 0.7;
        }
        Ikudua::create($validate);
    }

    public function updatea()
    {
        $validate = $this->validate();
        $validate['kategori'] = 'Kegiatan Luar Prodi';
        $validate['bobot'] = $validate['sks_juara'] / 20;
        Ikudua::where('id', $this->ikudua_id)->update($validate);
    }

    public function updateb()
    {

        $validate = $this->validate();
        $validate['kategori'] = 'Prestasi';

        if ($validate['sks_juara'] == 1 && $validate['level'] == 'Internasional') {
            $validate['bobot'] = 1;
        } elseif ($validate['sks_juara'] == 1 && $validate['level'] == 'Nasional') {
            $validate['bobot'] = 0.7;
        } elseif ($validate['sks_juara'] == 1 && $validate['level'] == 'Provinsi') {
            $validate['bobot'] = 0.4;
        } elseif ($validate['sks_juara'] == 2 && $validate['level'] == 'Internasional') {
            $validate['bobot'] = 0.9;
        } elseif ($validate['sks_juara'] == 2 && $validate['level'] == 'Nasional') {
            $validate['bobot'] = 0.6;
        } elseif ($validate['sks_juara'] == 2 && $validate['level'] == 'Provinsi') {
            $validate['bobot'] = 0.3;
        } elseif ($validate['sks_juara'] == 3 && $validate['level'] == 'Internasional') {
            $validate['bobot'] = 0.8;
        } elseif ($validate['sks_juara'] == 3 && $validate['level'] == 'Nasional') {
            $validate['bobot'] = 0.5;
        } elseif ($validate['sks_juara'] == 3 && $validate['level'] == 'Provinsi') {
            $validate['bobot'] = 0.2;
        } elseif ($validate['sks_juara'] == 'Peserta') {
            $validate['bobot'] = 0.7;
        }
        Ikudua::where('id', $this->ikudua_id)->update($validate);
    }
}
