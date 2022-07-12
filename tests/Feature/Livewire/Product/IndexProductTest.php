<?php

namespace Tests\Feature\Livewire\Products;

use App\Http\Livewire\Product\Update;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_show_update_product_page()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        $product = Product::factory()->create()->id;

        $this->get('/dashboard/product/edit/' . $product)
            ->assertOk();
    }

    public function it_performs_a_validation()
    {
        Livewire::test(Update::class)
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
    public function it_can_update_product()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        $product = Product::factory()->create();

        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.png');

        Livewire::test(Update::class)
            ->set('title','Cappucino')
            ->set('price', 5)
            ->set('stock' , 100)
            ->set('image' , $file)
            ->call('update');

            $this->assertTrue(Product::whereTitle(Product::latest()->first()->title)->exists());
            $this->assertTrue(Product::wherePrice(Product::latest()->first()->price)->exists());
            $this->assertTrue(Product::whereStock(Product::latest()->first()->stock)->exists());
            $this->assertTrue(Product::whereImage(Product::latest()->first()->image)->exists());
    }

     /** @test */
    public function it_can_redirected_to_product_page_after_updation()
    {
        $this->actingAs(User::factory()->create(['name' => 'admin']));

        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.png');

        Livewire::test(Update::class)
            ->set('title','Cappucino')
            ->set('price', 5)
            ->set('stock' , 100)
            ->set('image' , $file)
            ->call('update')
            ->assertRedirect('/dashboard/product');
    }
}
