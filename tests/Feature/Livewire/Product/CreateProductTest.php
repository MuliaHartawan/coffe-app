<?php

namespace Tests\Feature\Livewire\Products;

use App\Http\Livewire\Product\Create;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function  it_can_show_the_create_product_page()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));
        $this->get('/dashboard/product/create')
            ->assertStatus(200);
    }

    /** @test */
    public function it_performs_a_validation()
    {
        Livewire::test(Create::class)
            ->set('title', '')
            ->set('price', '')
            ->set('stock' ,'')
            ->set('image' , '')
            ->call('store')
            ->assertHasErrors([
                'title' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'image' => 'required',
            ]);
    }

    /** @test */
    public function it_can_create_product()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.png');

        Livewire::test(Create::class)
            ->set('title','Cappucino')
            ->set( 'price', 5)
            ->set('stock' , 100)
            ->set('image' , $file)
            ->call('store');

            $this->assertTrue(Product::whereTitle('Cappucino')->exists());
            $this->assertTrue(Product::wherePrice(5)->exists());
            $this->assertTrue(Product::whereStock(100)->exists());
            $this->assertTrue(Product::whereImage(Product::latest()->first()->image)->exists());
    }

    public function it_can_redirected_to_product_page_after_creation()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.png');

        Livewire::test(Create::class)
            ->set('productId', Product::factory()->create()->id)
            ->set('userId', User::factory()->create()->id)
            ->set('quantity', 5)
            ->set('amount', 25)
            ->set('image' , $file)
            ->assertRedirect('/dashboard/product');
    }
}
