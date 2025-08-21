<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UpdateProfile extends Component
{
    use WithFileUploads;

    public $profile_picture;
    public $user;
    public $name;
    public $username;
    public $email;
    public $telegram_chat_id;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $this->user = Auth::user();
        $this->profile_picture = $this->user->profile_picture;
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->telegram_chat_id = $this->user->telegram_chat_id ?? '';
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

            return redirect()->route('profile')->with('success', 'Foto profil berhasil diperbarui.');
        }
    }

    public function updateProfile()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'username' => 'nullable|string|max:50',
            'telegram_chat_id' => 'nullable|string|max:50',
        ];
        
        // Add password validation rules if user wants to change password
        if (!empty($this->current_password) || !empty($this->new_password) || !empty($this->new_password_confirmation)) {
            $rules['current_password'] = 'required';
            $rules['new_password'] = 'required|min:8|confirmed';
            $rules['new_password_confirmation'] = 'required';
        }
        
        if ($this->profile_picture && $this->profile_picture !== $this->user->profile_picture) {
            $rules['profile_picture'] = 'image|max:2048';
        }
        
        $this->validate($rules);

        // Verify current password if user wants to change password
        if (!empty($this->current_password)) {
            if (!Hash::check($this->current_password, $this->user->password)) {
                $this->addError('current_password', 'Password saat ini tidak valid.');
                return;
            }
        }

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'telegram_chat_id' => $this->telegram_chat_id,
        ];

        // Add new password to update data if provided
        if (!empty($this->new_password)) {
            $data['password'] = Hash::make($this->new_password);
        }

        if ($this->profile_picture && $this->profile_picture !== $this->user->profile_picture) {
            $path = $this->profile_picture->store('profile_pictures', 'public');
            if ($this->user->profile_picture) {
                Storage::disk('public')->delete($this->user->profile_picture);
            }
            $data['profile_picture'] = $path;
        }

        $this->user->update($data);
       
        // Clear password fields after successful update
        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';
       
        // Use redirect with session flash instead of direct session flash
        $message = !empty($data['password']) ? 'Profil dan password berhasil diperbarui.' : 'Profil berhasil diperbarui.';
        return redirect()->route('profile')->with('success', $message);
    }

    public function render()
    {
        return view('livewire.update-profile');
    }
}
