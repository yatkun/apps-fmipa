<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan\Approval;

use App\Models\Letter;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListPendingLetters extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortDir' => ['except' => 'DESC'],
        'perPage' => ['except' => 10],
    ];

    public function mount() {
        // Reset pagination when component is mounted
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
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
        
        // Reset pagination when sorting changes
        $this->resetPage();
    }
    
    public function gotoPage($page)
    {
        $this->setPage($page);
    }
    public function render()
    {
        $pendingLetters = Letter::where('user_id', Auth::user()->id)
            ->with('template', 'creator', 'tendikVerifier')
            // orwhere status except 'approved'
           
            ->orderBy($this->sortBy, $this->sortDir)
            ->search($this->search)
            ->paginate($this->perPage);

        return view('livewire.edokumen.tendik.persuratan.approval.list-pending-letters', compact('pendingLetters'));
    }
}
