<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    use WithFileUploads;

    public $profile_picture;
    public $user;


    public function mount()
    {
        $this->user = Auth::user();
        $this->profile_picture = $this->user->profile_picture;
        
    }

    public function updateProfile()
    {
        $this->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($this->profile_picture) {
            $filename = $this->profile_picture->store('profile_pictures', 'public');
            $this->user->profile_picture = $filename;
            $this->user->save();
        }

        session()->flash('message', 'Profil berhasil diperbarui!');
    }

  
    public function render()
    {
        return view('livewire.profile');
    }
}
