<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductsList extends Component
{
    public $title;
    public $products;

    public function mount()
    {
        $this->title = 'Products List';
        $this->products = ['1', '2', '2', '2', '2', '2', '2'];
    }

    public function render()
    {
        return view('livewire.products-list');
    }

    public function addToWishList()
    {
    }

    public function addToShoppingBag()
    {
    }

}
