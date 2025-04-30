<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class DaftarUser extends Component
{

    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';

    public $existingFile;
    public $mode = 'add';
    public $name;
    public $username;
    public $email;
    public $password;
    public $level;

    public $user_id;

   

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $this->user_id,
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'password' => $this->mode === 'add' ? 'required|string|min:4' : 'nullable|string|min:4',
            'level' => 'required'
        ];
    }

    public function store()
    {

        $this->validate();
        
        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password), // Simpan ID pengguna saat ini
            'level' => $this->level, // Simpan ID pengguna saat ini
        ]);
        session()->flash('success', 'Pengguna berhasil ditambahkan.');
        $this->dispatch('notif'); 
        $this->dispatch('closemodal');
    }
    public function update($data){
        $this->user_id = $data['id'];
        $this->mode = 'edit';
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->username = $data['username'];
        $this->level = $data['level'];
    }
    public function update_a(){
        
        $this->validate();

        User::where('id', $this->user_id)->update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'level' => $this->level,
        ]);

        session()->flash('success', 'Data pengguna berhasil diperbarui.');
        $this->dispatch('notif');
        $this->dispatch('closemodal');
        $this->resetInput();

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
    public function modes()
    {
        $this->resetInput();
        $this->mode = 'add';
    }

    private function resetInput()
    {
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->level = '';
    }

    public function cancelEdit()
    {
        $this->resetInput(); // Clear form fields
        $this->mode = 'add'; // Switch back to 'add' mode
    }

    public function handleSaveOrUpdate()
    {

        if ($this->mode == 'edit') {
            $this->update_a(); // Panggil fungsi update
        } else {
            $this->store(); // Panggil fungsi save
        }
    }

    public function delete($id)
    {
      
        $file = User::findOrFail($id);

        $file->delete();
        session()->flash('success', 'Pengguna berhasil dihapus.');
        $this->dispatch('notif'); 
    }

    
    public function render()
    {
        if(Auth::user()->level == 'admin'){
            return view('livewire.daftar-user',[
                'a' => User::when($this->sortDir, function ($query) {
                    $query->orderBy($this->sortBy, $this->sortDir);
                }, function ($query) {
                    $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
                })
                    ->search($this->search)
                    ->paginate($this->perPage),
            ]);
        }
        abort(403);
    }
}
