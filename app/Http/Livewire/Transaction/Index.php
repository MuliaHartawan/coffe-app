<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    /**
    * define public variable
    */
    public $transactionId;

    /**
     * destroy function
     */
    public function destroy()
    {
        $transaction = Transaction::find($this->transactionId);

        if($transaction) {
            $transaction->delete();
        }

        //flash message
        session()->flash('message', 'Deleted Transaction Successfuly');

        //redirect
        return redirect()->route('transaction.index');

    }

    /**
     * deleteId function
     */
    public function deleteId($id)
    {
        $this->transactionId = $id;
    }

    public function render()
    {
        return view('livewire.transaction.index', [
            'transactions' => Transaction::latest()->paginate(5)
        ])->layout('layouts.dashboard');
    }
}
