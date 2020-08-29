<?php

namespace App\Http\Livewire\Navbar;

use Livewire\Component;

class ShoppingBagButton extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.navbar.shopping-bag-button');
    }
}
