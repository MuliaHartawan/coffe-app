<?php

namespace Tests\Feature\Livewire\Transactions;

use App\Http\Livewire\Transaction\Update;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateTransactionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_show_update_transaction_page()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        $transaction = Transaction::factory()->create(['product_id' => Product::factory()->create()->id, 'user_id' => User::factory()->create()->id])->id;

        $this->get('/dashboard/transaction/edit/' . $transaction)
            ->assertOk();
    }

    public function it_performs_a_validation()
    {
        Livewire::test(Update::class)
        ->set('product_id' , '')
        ->set('user_id' , '')
        ->set('quantity' , '')
        ->set('amount' , '')
        ->call('update')
        ->assertHasErrors([
            'product_id' => 'required',
            'user_id' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ]);
    }

    /** @test */
    public function it_can_update_transaction()
    {
        $this->actingAs(User::factory()->create());

        $product = Product::factory()->create();

        Livewire::test(Update::class)
            ->set('productId', $product->id)
            ->set('quantity', 5)
            ->set('amount', 25)
            ->call('update');

            $this->assertTrue(Product::whereId(Product::factory()->create()->id)->exists());
            $this->assertTrue(User::whereId(User::factory()->create()->id)->exists());
    }

     /** @test */
    public function it_can_redirected_to_transaction_page_after_updation()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        Livewire::test(Update::class)
            ->set('productId', Product::factory()->create()->id)
            ->set('quantity', 5)
            ->set('amount', 25)
            ->call('update')
            ->assertRedirect('/dashboard/transaction');
    }
}
