<?php

namespace Tests\Feature\Livewire\Transactions;

use App\Http\Livewire\Transaction\Index;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ListTransactionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_show_list_transactions_page()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        $this->get('/dashboard/transaction')
            ->assertOk();
    }

    /** @test */
    public function test_it_shows_all_the_transactions()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        $transaction = Transaction::factory()->create(['product_id' => Product::factory()->create()->id, 'user_id' => User::factory()->create()->id]);

        $this->get('/dashboard/transaction')
            ->assertSee($transaction->product->title)
            ->assertSee($transaction->quantity)
            ->assertSee($transaction->amount)
            ->assertSee(Carbon::parse($transaction->created_at)->toDayDateTimeString());
    }

    /** @test */
    public function test_it_can_delete_transaction()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        $transaction = Transaction::factory()->create(['product_id'=>Product::factory()->create()->id, 'user_id' => User::factory()->create()->id]);

        Livewire::test(Index::class)
        ->set('transactionId', $transaction->id)
            ->call('destroy', );

        $this->assertNull($transaction->fresh());
    }
}
