<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;

class ProductsList extends Component
{
    public $title;
    public $seeAllRoute;
    public $seeAllMessage;

    public function mount($title, $seeAllRoute, $seeAllMessage)
    {
        $this->title = $title;
        $this->seeAllRoute = $seeAllRoute;
        $this->seeAllMessage = $seeAllMessage;
    }

    public function render()
    {
        return view('livewire.products-list', ['products' => ['a','a','a','a','a',]]);
    }

    public function addToWishList()
    {
    }

    public function addToShoppingBag()
    {
    }

}
