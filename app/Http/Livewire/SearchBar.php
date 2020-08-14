<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchBar extends Component
{
    public $query;

    public function render()
    {
        return view('livewire.search-bar');
    }

    public function submit()
    {
        $this->validate([
            'query' => 'required'
        ]);
    }
}
