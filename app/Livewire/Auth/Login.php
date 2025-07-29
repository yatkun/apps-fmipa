<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.auth')] 
class Login extends Component
{
    #[Validate('required|min:3')] 
    public $username = '';
 
    #[Validate('required|min:3')] 
    public $password = '';

    public function mount(){
        $login = session('authenticated_application');
   
        if ($login == 'EDokumen' && Auth::user()->level == 'Dosen') {
            return redirect()->route('edokumen.dashboard');
        }elseif ($login == 'EDokumen' && Auth::user()->level == 'Tendik') {
            return redirect()->route('tendik.dashboard');
        }
    }

    public function login()
    {
        // dd($this->username, $this->password);
        
        $this->validate();
        
        if(Auth::attempt(['username' => $this->username, 'password' => $this->password])){
            session(['authenticated_application' => session('selected_application')]);
            $application = session('authenticated_application');
            if ($application == 'EDokumen' && Auth::user()->level == 'Dosen') {
                session()->flash('success', 'Login Berhasil');
                return redirect()->route('edokumen.dashboard');
                $this->dispatch('notif');
            }elseif ($application == 'EDokumen' && Auth::user()->level == 'Tendik') {
                session()->flash('success', 'Login Berhasil');
            
                return redirect()->route('tendik.dashboard');
                $this->dispatch('notif');
            }
            elseif($application == 'IKU'){
                session()->flash('success', 'Login Berhasil');
                return redirect()->route('iku.dashboard');
                $this->dispatch('notif');
            }
        }else{
            // return back()->with('error', 'Login Gagal !');
            session()->flash('error', 'Username / password salah !');
            $this->dispatch('notif');
        }
    }

    
   
    public function render()
    {
        return view('livewire.auth.login');
    }
}
