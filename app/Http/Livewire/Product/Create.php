<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    /**
    * define public variable
    */
    public $title;
    public $price;
    public $stock;
    public $image;

    public function store(){
        $this->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|image:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::create([
            'title'   => $this->title,
            'price'   => $this->price,
            'stock'   => $this->stock,
            'image'   => $this->image->store('image', 'public'),
        ]);

        //flash message
        session()->flash('message', 'Created Product Successfuly');

        //redirect
        return redirect()->route('product.index');
    }

     /**
     * Real-time Validation
     */
    public function updated($field)
    {
        $this->validateOnly($field, [
            'title' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|image:jpg,jpeg,png|max:2048',
        ]);
    }

    public function render()
    {
        return view('livewire.product.create')->layout('layouts.dashboard');
    }
}
