<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product ;
use App\Models\Productinfo ;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /*public function testDeleteProduct()
    {
    	$response = $this->delete('admin/products/56',  ['_token' => csrf_field()]);
    	$response->assertStatus(200)->assertRedirect(route('products.index'));
    }*/
   /* public function testUpdateProduct()
    {
    	$response = $this->put('admin/products/55',['name' => 'hhhhhdfgdfgdgdfgdfgdfgdf']);
    	$response->assertRedirect(route('products.index'));

    }*/
    public function testCreateProduct()
    {
        /*$product = factory(Product::class)->make()->toArray();
        $info = factory(Productinfo::class)->make()->toArray();
        $response = $this->post('admin/products', array_merge($product, $info));
        //$this->assertDatabaseHas('products',['name' => 'sdfsdfsdfdssssssssss']);
        $response->assertRedirect(route('products.index'));*/

    }
}
