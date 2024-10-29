<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */

    public $class;
    public $href;


    public function __construct($type = 'button', $class = '', $href = null)
    {
  
        $this->class = $class;
        $this->href = $href;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-outline');
    }
}
