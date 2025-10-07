<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class TestLoading extends Component
{
    public function mount()
    {
        Log::info('TestLoading mount: ' . now() . ' | Request: ' . request()->header('X-Livewire'));
    }

    public function testAction()
    {
        Log::info('TestLoading testAction called');
        return 'Test completed';
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            <h1>Simple Livewire Test</h1>
            <button wire:click="testAction">
                <span wire:loading.remove>NORMAL</span>
                <span wire:loading>LOADING</span>
            </button>
        </div>
        HTML;
    }
}
