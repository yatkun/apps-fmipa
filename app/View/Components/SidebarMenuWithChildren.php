<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarMenuWithChildren extends Component
{
    public $label;
    public $id;


    public function __construct($label, $id)
    {
        $this->label = $label;
        $this->id = $id;
        
    }

    public function render()
    {
        return view('components.sidebar-menu-with-children');
    }
}
