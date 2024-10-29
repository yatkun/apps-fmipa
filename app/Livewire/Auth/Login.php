<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.AUTH')] 
class Login extends Component
{
    #[Validate('required|min:3')] 
    public $username = '';
 
    #[Validate('required|min:3')] 
    public $password = '';

    
    public function login()
    {
        $this->validate();

        if(Auth::attempt(['username' => $this->username, 'password' => $this->password])){
        session()->flash('success', 'Login Berhasil');
            return redirect()->route('apps');
        }else{
            // return back()->with('error', 'Login Gagal !');
            session()->flash('error', 'Login Gagal !');
            $this->dispatch('notif');
        }

        

    }

    
   
    public function render()
    {
        return view('livewire.auth.login');
    }
}
