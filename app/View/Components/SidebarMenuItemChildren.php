<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarMenuItemChildren extends Component
{
    /**
     * Create a new component instance.
     * 
     * 
     */

     public $label;
     public $id;
     public $href;

     public function __construct($label, $id, $href="#")
    {
        $this->label = $label;
        $this->id = $id;
        $this->href = $href;    
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-menu-item-children');
    }
}
