<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    /**
    * define public variable
    */
    public $productId;
    public $quantity;
    public $price;
    public $amount;
    public $userId;

    /**
     * store function
     */
    public function store()
    {
        $product = Product::find($this->productId);


        $this->validate([
            'productId' => 'required',
            'quantity' => 'required|numeric|max:' . $product->price,
        ]);

        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'product_id' => $this->productId,
                'user_id' => Auth::user()->id,
                'quantity' => $this->quantity,
                'amount' => $this->amount
            ]);

            $product = Product::find($this->productId);

            $product->update([
                'stock' => $product->stock - $this->quantity,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return $th->getMessage();
        }

         //flash message
         session()->flash('message', 'Created Transaction Successfuly');

         //redirect
         return redirect()->route('transaction.index');
    }
    public function render()
    {
        return view('livewire.transaction.create', [
            'products' => Product::all()
        ])->layout('layouts.dashboard');
    }

     /**
     * Real-time Validation
     */
    public function updated($field, $value)
    {
        $this->validateOnly($field,[
            'productId' => 'required',
            'quantity' => 'required|numeric',
        ]);

        if($field == 'productId'){
            $product = Product::find($value);
            $this->price = $product->price;
        }
        if($field == 'quantity'){
            $this->amount = $this->price * $value;
        }

    }
}
