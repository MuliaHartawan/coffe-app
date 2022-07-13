<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Product;
use App\Models\Transaction;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Update extends Component
{
    /**
    * define public variable
    */
    public $transactionId;
    public $productId;
    public $products = null;
    public $quantity;
    public $amount;
    public $price;
    public $stock;

    /**
     * mount or construct function
     */
    public function mount($id = null)
    {
        $transaction = Transaction::find($id);
        if($transaction) {
            $this->transactionId = $transaction->id;
            $this->productId     = $transaction->product_id;
            $this->quantity      = $transaction->quantity;
            $this->amount        = $transaction->amount;
            $this->price         = $transaction->product->price;
            $this->products      = Product::all();
        }
    }


    /**
     * update function
     */
    public function update()
    {
        $this->validate([
            'productId' => 'required',
            'quantity' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $transaction = Transaction::findOrFail($this->transactionId);
            $product = $transaction->product;

            if($transaction->product_id != $this->productId)
            {
                $product->update([
                    'stock' => $transaction->product->stock + $this->quantity,
                ]);
            }

            $transaction->update([
                'product_id' => $this->productId,
                'user_id' => Auth::user()->id,
                'quantity' => $this->quantity,
                'amount' => $this->amount
            ]);

            $product = Product::findOrFail($this->productId);

            $product->update([
                'stock'=> $product->stock - $this->quantity
            ]);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
            return  redirect()->route('transaction.index')->with('message', $th->getMessage());
        }



        //flash message
        session()->flash('message', 'Updated Transaction Successfuly');

        //redirect
        return redirect()->route('transaction.index');
    }

    public function render()
    {

        return view('livewire.transaction.update')->layout('layouts.dashboard');

    }

    /**
     * Real-time Validation
     */
    public function updated($field, $value)
    {
        if($field == 'productId'){
            $product = Product::find($value);
            $this->stock = $product->stock;
            $this->price = $product->price;
        }
        if($field == 'quantity'){
            $this->amount = $this->price * (int)$value;
        }

        $this->validateOnly($field,[
            'productId' => 'required',
            'quantity' => 'required|numeric|max:'. $this->stock,
        ]);
    }
}
