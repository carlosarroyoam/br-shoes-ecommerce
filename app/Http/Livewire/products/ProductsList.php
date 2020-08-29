<?php

namespace App\Http\Livewire\Products;

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

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.products.products-list', ['products' => ['a','a','a','a','a',]]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     */
    public function addToWishList()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     */
    public function addToShoppingBag()
    {
    }

}
