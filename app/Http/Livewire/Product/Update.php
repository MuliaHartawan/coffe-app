<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    /**
    * define public variable
    */
    public $productId, $title, $price, $stock, $image;

    /**
     * mount or construct function
     */
    public function mount($id = null)
    {
        $product = Product::find($id);
        if($product) {
            $this->productId    = $product->id;
            $this->title        = $product->title;
            $this->price        = $product->price;
            $this->stock        = $product->stock;
        }
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

    /**
     * update function
     */
    public function update()
    {
        $this->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|image:jpg,jpeg,png|max:2048',
        ]);

        if($this->productId) {

            $product = Product::find($this->productId);

            if($product) {
                $product->update([
                    'title'     => $this->title,
                    'price'   => $this->price,
                    'stock'   => $this->stock,
                    'image'   => $this->image->store('image', 'public'),
                ]);
            }
        }

        //flash message
        session()->flash('message', 'Updated Product Successfuly');

        //redirect
        return redirect()->route('product.index');
    }

    public function render()
    {
        return view('livewire.product.update')->layout('layouts.dashboard');
    }
}
