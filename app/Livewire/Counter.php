<?php

namespace App\Livewire;

use Log;
use App\Models\Soal;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Counter extends Component
{

    public $currentQuestionIndex = 0; // Menyimpan indeks soal yang sedang ditampilkan
    public $answers = [];

    public $questions = []; // Daftar soal

    public function mount()
    {
        // Ambil semua soal dari database
        $this->questions = Soal::with('options')->get();

        // Ambil jawaban yang sudah tersimpan di session, jika ada
        $this->answers = session()->get('answers', []);
    }




    public function saveAnswer($nosoal, $jawaban)
    {
        $this->answers[$nosoal] = $jawaban;
        // $this->answers[$this->currentQuestionIndex] = $answer;
       // Perbarui session hanya untuk nomor soal yang diberikan
    //    session()->put('answers', $this->answers);
        session()->put("answers.$nosoal", $jawaban);
    //    session(['answers' => $this->answers]);
 
    }

    public  function cek(){
        dd(session('answers')); 
    }




    public function setQuestion($index)
    {
        // Pindah soal berdasarkan index
        $this->currentQuestionIndex = $index;
        $this->answers = session()->get('answers', []);
       
    }

    public function render()
    {
        
        $currentQuestion = $this->questions[$this->currentQuestionIndex];
       
        return view('livewire.counter', [
            'currentQuestion' => $currentQuestion,
            'answers' => $this->answers,
        ]);
  
    }

    public function clearAnswers()
    {
        // Menghapus session answers
        session()->forget('answers');

        // Reset array answers di komponen
        $this->answers = [];

        // Anda bisa menambahkan logika tambahan setelah menghapus session, seperti redirect atau memberikan notifikasi.
        session()->flash('message', 'Jawaban telah dihapus.');
    }
}
