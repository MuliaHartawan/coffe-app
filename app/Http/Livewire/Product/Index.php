<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    /**
    * define public variable
    */
    public $productId;

    /**
     * Destroy function
     */
    public function destroy()
    {
        $product = Product::findOrFail($this->productId);

        $product->transactions()->delete();
        $product->delete();

        //flash message
        session()->flash('message', 'Deleted Product Successfuly');

        //redirect
        return redirect()->route('product.index');

    }

    /**
     * deleteId function
     */
    public function deleteId($id)
    {
        $this->productId = $id;
    }

    public function render()
    {
        return view('livewire.product.index', [
            'products' => Product::latest()->paginate(6)
        ])->layout('layouts.dashboard');
    }
}
