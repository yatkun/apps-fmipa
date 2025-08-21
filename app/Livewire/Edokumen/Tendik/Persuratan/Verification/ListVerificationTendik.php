<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan\Verification;

use App\Models\Letter;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListVerificationTendik extends Component
{
    use WithPagination;
    
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function mount()
    {
        // Validasi akses hanya untuk Tendik
        if (Auth::user()->level !== 'Tendik') {
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
            ->where('letters.status', 'verification_tendik')
            ->with(['template', 'creator', 'tendikVerifier'])
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
                } else {
                    $query->orderBy('letters.' . $this->sortBy, $this->sortDir);
                }
            })
            ->paginate($this->perPage);

        return view('livewire.edokumen.tendik.persuratan.verification.list-verification-tendik', [
            'verificationLetters' => $verificationLetters,
        ]);
    }
}
