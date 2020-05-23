<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
use App\User;

class AddProductToCartTest extends TestCase
{
  use RefreshDatabase;

  public function testSuccesAddProductToCart() {
    $this->seed();
    $product = factory(Product::class)->create();
    $user = factory(User::class)->create();

    $response = $this->actingAs($user)->post('/cart/add/1');
    $this->assertDatabaseHas('orders', [
      'user_id' => $user->id,
      'status' => 1
    ]);
    $this->assertDatabaseHas('order_items', [
      'order_id' => 1,
      'product_id' => $product->id
    ]);
  }

  public function testSuccesAddProductToCartMore() {
    $this->seed();
    $product = factory(Product::class, 2)->create();
    $user = factory(User::class)->create();

    for ($i=1; $i < 3; $i++) {
      $response = $this->actingAs($user)->post("/cart/add/$i");
    }
    $this->assertDatabaseHas('orders', [
      'user_id' => $user->id,
      'status' => 1
    ]);
    for ($i=1; $i < 3; $i++) {
      $this->assertDatabaseHas('order_items', [
        'order_id' => 1,
        'product_id' => $i,
      ]);
    }
  }

  public function testFailedAddProductToCartDosentExist() {
    $user = factory(User::class)->create();

    $response = $this->actingAs($user)->post('/cart/add/1');

    $response->assertNotFound();
  }
}
