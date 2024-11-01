<?php

namespace App\Livewire;

use App\Models\Ikusatu;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

class Iku1 extends Component
{

    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';

    #[Rule(['required'])]
    public string $nama = '';

    #[Rule(['required'])]
    public string $program_studi = '';

    #[Rule(['required'])]
    public string $tanggal_lulus = '';

    #[Rule(['required'])]
    public string $pekerjaan = '';

    #[Rule(['required'])]
    public string $pendapatan = '';

    #[Rule(['required'])]
    public string $masa_tunggu = '';

    public $ump = 1000000;
    public function save()
    {

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

        if ($validate['pekerjaan'] == 'Lanjut studi'){
            $validate['bobot'] = 1;
        }

        Ikusatu::create($validate);
        
        $this->dispatch('modalClosed');
        session()->flash('success', 'Data berhasil ditambahkan !.');
        $this->resetInput();
        // Emit event untuk JavaScript
         $this->dispatch('notif');

     
    }


    private function resetInput()
    {
        $this->nama = '';
        $this->program_studi = '';
        $this->tanggal_lulus = '';
        $this->pekerjaan = '';
        $this->pendapatan = '';
        $this->masa_tunggu = '';
    }

    public function setsortBy($sortByField)
    {
      
        // Jika field yang sama diklik
        if ($this->sortBy === $sortByField) {
            // Jika saat ini ASC, ubah menjadi DESC
            if ($this->sortDir === 'ASC') {
                $this->sortDir = 'DESC';
            }
            // Jika saat ini DESC, reset ke default
            elseif ($this->sortDir === 'DESC') {
                $this->sortDir = 'ASC';  // null berarti urutan default
                $this->sortBy = 'created_at';  // kembali ke default sorting
            }
            // Jika saat ini null (default), set ke ASC
            else {
                $this->sortDir = 'ASC';
            }
        } else {
            // Jika field yang berbeda diklik, set ke ASC
            $this->sortBy = $sortByField;
            $this->sortDir = 'ASC';
        }
    }
    public function render()
    {
        return view('livewire.iku1', [
            'ikusatu' => Ikusatu::when($this->sortDir, function($query) {
                    $query->orderBy($this->sortBy, $this->sortDir);
                }, function($query) {
                    $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
                })
                ->search($this->search)
                ->paginate($this->perPage),
        ]);
    }
}
