<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan\Verification;

use App\Models\Letter;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListVerificationDekan extends Component
{
    use WithPagination;
    
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function mount()
    {
        // Validasi akses hanya untuk Dekan
        if (Auth::user()->level !== 'Dosen' || !Auth::user()->is_dekan) {
            session()->flash('error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('dashboard');
        }
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $sortByField;
            $this->sortDir = 'ASC';
        }
    }

    public function render()
    {
        $verificationLetters = Letter::query()
            ->select('letters.*')
            ->leftJoin('templates', 'letters.template_id', '=', 'templates.id')
            ->where('letters.status', 'verification_dekan')
            ->with(['template', 'creator', 'tendikVerifier', 'dekanVerifier'])
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('letters.title', 'like', '%' . $this->search . '%')
                        ->orWhere('letters.data_filled', 'like', '%"no_surat":"' . $this->search . '%')
                        ->orWhereHas('creator', function ($userQuery) {
                            $userQuery->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('template', function ($templateQuery) {
                            $templateQuery->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->sortBy && $this->sortDir, function ($query) {
                if ($this->sortBy === 'template_name') {
                    $query->orderBy('templates.name', $this->sortDir);
                } elseif ($this->sortBy === 'creator_name') {
                    $query->join('users as creators', 'letters.user_id', '=', 'creators.id')
                        ->orderBy('creators.name', $this->sortDir);
                } elseif ($this->sortBy === 'verified_at_tendik') {
                    $query->orderBy('letters.verified_at_tendik', $this->sortDir);
                } else {
                    $query->orderBy('letters.' . $this->sortBy, $this->sortDir);
                }
            })
            ->paginate($this->perPage);

        return view('livewire.edokumen.tendik.persuratan.verification.list-verification-dekan', [
            'verificationLetters' => $verificationLetters,
        ]);
    }
}
