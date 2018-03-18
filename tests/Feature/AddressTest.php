<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User ;

class AddressTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        //$this->assertTrue(true);
    }

    public function testAddAddress()
    {
    	$user = factory(User::class)->create();
    	$this->actingAs($user);
    	//dump($user);
    	$data = ['name' =>'zhangsan', 'user_id'=>2, 'phone'=>'123456789800', 'province'=>'liaoning','city'=>'dalilan','detail_address'=>'fsdffsd','district'=>'sdfsdfsdf'];
    	$this->post('user/address', $data);
    	$this->assertDatabaseHas('addresses', ['name'=>'zhangsan']);
    }
}
