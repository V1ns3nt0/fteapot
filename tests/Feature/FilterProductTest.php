<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
use App\User;

class FilterProductTest extends TestCase
{
  use RefreshDatabase;

  public function testFilterProductsAllParams() {
    $this->seed();
    $product = factory(Product::class)->create([
      'tea_kind' => 1,
      'tea_taste' => 2,
    ]);
    $productFilt = factory(Product::class, 2)->create([
      'tea_kind' => 3,
      'tea_taste' => 1,
      'price' => 500,
    ]);

    $response = $this->post('/catalog', [
      'tea_kind' => [3],
      'tea_taste' => [1, 2],
      'minPrice' => 200,
    ]);

    $this->assertCount(2, $response->getOriginalContent()->getData()['products']);
    for ($i=0; $i < count($response->getOriginalContent()->getData()['products']); $i++) {
        $this->assertContains($response->getOriginalContent()->getData()['products'][$i]->tea_kind, [3]);
    }

    for ($i=0; $i < count($response->getOriginalContent()->getData()['products']); $i++) {
        $this->assertContains($response->getOriginalContent()->getData()['products'][$i]->tea_taste, [1, 2]);
    }
  }

  public function testFilterProductsNoKind() {
    $this->seed();
    $product = factory(Product::class)->create([
      'tea_taste' => 2,
    ]);
    $productFilt = factory(Product::class, 2)->create([
      'tea_taste' => 1,
      'price' => 500,
    ]);

    $response = $this->post('/catalog', [
      'tea_taste' => [1],
      'minPrice' => 200,
    ]);

    $this->assertCount(2, $response->getOriginalContent()->getData()['products']);

    for ($i=0; $i < count($response->getOriginalContent()->getData()['products']); $i++) {
        $this->assertContains($response->getOriginalContent()->getData()['products'][$i]->tea_taste, [1]);
    }
  }

  public function testFilterProductsNoTaste() {
    $this->seed();
    $product = factory(Product::class)->create([
      'tea_kind' => 1,
    ]);
    $productFilt = factory(Product::class, 2)->create([
      'tea_kind' => 3,
      'price' => 500,
    ]);

    $response = $this->post('/catalog', [
      'tea_kind' => [3],
      'minPrice' => 200,
    ]);

    $this->assertCount(2, $response->getOriginalContent()->getData()['products']);
    for ($i=0; $i < count($response->getOriginalContent()->getData()['products']); $i++) {
        $this->assertContains($response->getOriginalContent()->getData()['products'][$i]->tea_kind, [3]);
    }
  }

  public function testFilterProductsRestFilters() {
    $this->seed();
    $product = factory(Product::class)->create([
      'tea_kind' => 1,
      'tea_taste' => 2,
      'price' => 250,
    ]);
    $productFilt = factory(Product::class, 2)->create([
      'tea_kind' => 3,
      'tea_taste' => 1,
      'price' => 500,
    ]);

    $response = $this->post('/catalog');

    $this->assertCount(3, $response->getOriginalContent()->getData()['products']);
  }
}
