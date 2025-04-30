<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateProfile extends Component
{
    use WithFileUploads;

    public $profile_picture;
    public $user;


    public function mount()
    {
        $this->user = Auth::user();
        $this->profile_picture = $this->user->profile_picture;
    }

    public function updatedProfilePicture()
    {
     
        $this->validate([
            'profile_picture' => 'image|max:2048', // Maksimum 2MB
        ]);

        if ($this->profile_picture) {
            $path = $this->profile_picture->store('profile_pictures', 'public');

            if ($this->user->profile_picture) {
                Storage::disk('public')->delete($this->user->profile_picture);
            }

            $this->user->update(['profile_picture' => $path]);

            session()->flash('success', 'Foto profil berhasil diperbarui.');
           
            
            
        }
        $this->dispatch('notif');
        
    }

    public function render()
    {
        return view('livewire.update-profile');
    }
}
