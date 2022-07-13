<?php

namespace Tests\Feature\Livewire\Products;

use App\Http\Livewire\Product\Index;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_show_list_products_page()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        $this->get('/dashboard/product')
            ->assertOk();
    }

    public function test_it_shows_all_the_products()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        $product = Product::factory()->create();

        $this->get('/dashboard/product')
            ->assertSee($product->title)
            ->assertSee($product->price)
            ->assertSee($product->stock)
            ->assertSee($product->image);
    }

    public function test_it_can_delete_product()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        $product = Product::factory()->create();

        Livewire::test(Index::class)
            ->set('productId', $product->id)
            ->call('destroy');

        $this->assertNull($product->fresh());
    }
}
