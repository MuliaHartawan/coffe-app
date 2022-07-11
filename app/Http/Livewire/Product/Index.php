<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    /**
     * Destroy function
     */
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        $product->transactions()->delete();
        $product->delete();

        //flash message
        session()->flash('message', 'Deleted Product Successfuly');

        //redirect
        return redirect()->route('product.index');

    }

    public function render()
    {
        return view('livewire.product.index', [
            'products' => Product::latest()->paginate(5)
        ])->layout('layouts.dashboard');
    }
}
