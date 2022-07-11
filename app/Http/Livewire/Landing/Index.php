<?php

namespace App\Http\Livewire\Landing;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.landing.index', [
            'products' => Product::take(8)->get()
        ]);
    }
}
