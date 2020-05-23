<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
use App\User;

class DeleteProductFromCartTest extends TestCase
{
  use RefreshDatabase;

  public function testSuccesDeleteProductFromCart() {
    $this->seed();
    $product = factory(Product::class)->create();
    $user = factory(User::class)->create();
    $this->actingAs($user)->post('/cart/add/1');

    $response = $this->actingAs($user)->post('/cart/del/1');
    $this->assertDeleted('order_items', [
      'order_id' => 1,
      'product_id' => $product->id
    ]);
  }

  public function testSuccesDeleteProductFromCartMore() {
    $this->seed();
    $product = factory(Product::class, 2)->create();
    $user = factory(User::class)->create();

    for ($i=1; $i < 3; $i++) {
      $this->actingAs($user)->post("/cart/add/$i");
    }

    for ($i=1; $i < 3; $i++) {
      $response = $this->actingAs($user)->post("/cart/del/$i");
    }

    for ($i=1; $i < 3; $i++) {
      $this->assertDeleted('order_items', [
        'order_id' => 1,
        'product_id' => $i
      ]);
    }
  }

  public function testFailedDaleteProductFromCartDosentExist() {
    $user = factory(User::class)->create();

    $response = $this->actingAs($user)->post('/cart/del/1');

    $response->assertNotFound();
  }
}
