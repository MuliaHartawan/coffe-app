<?php

namespace Tests\Feature\Livewire\Transactions;

use App\Http\Livewire\Transaction\Create;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTransactionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function  it_can_show_the_create_transaction_page()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));
        $this->get('/dashboard/transaction/create')
            ->assertStatus(200);
    }

    public function it_performs_a_validation()
    {
        Livewire::test(Create::class)
            ->set('product_id' , '')
            ->set('user_id' , '')
            ->set('quantity' , '')
            ->set('amount' , '')
            ->call('store')
            ->assertHasErrors([
                'product_id' => 'required',
                'user_id' => 'required',
                'quantity' => 'required',
                'amount' => 'required',
            ]);
    }

    /** @test */
    public function it_can_create_transaction()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(Create::class)
            ->set('productId', Product::factory()->create()->id)
            ->set('userId', User::factory()->create()->id)
            ->set('quantity', 5)
            ->set('amount', 25)
            ->call('store');

            $this->assertTrue(Product::whereId(Product::factory()->create()->id)->exists());
            $this->assertTrue(User::whereId(User::factory()->create()->id)->exists());
            $this->assertTrue(Transaction::where('quantity',5)->exists());
            $this->assertTrue(Transaction::whereAmount(Transaction::latest()->first()->amount)->exists());
    }

     /** @test */
    // public function it_can_redirected_to_transaction_page_after_creation()
    // {
    //     $this->actingAs(User::factory()->create(['name' => 'admin']));

    //     Livewire::test(Create::class)
    //         ->set('productId', Product::factory()->create()->id)
    //         ->set('userId', User::factory()->create()->id)
    //         ->set('quantity', 5)
    //         ->set('amount', 25)
    //         ->call('store')
    //         ->assertRedirect('/dashboard/transaction');
    // }
}
