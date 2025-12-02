<?php

namespace App\Livewire;

use Livewire\Component;

class MyOrdersPage extends Component
{
    #[\Livewire\Attributes\Title('My Orders')]
    public function render()
    {
        return view('livewire.my-orders-page');
    }
}
