<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
use App\User;

class ConfirmOrderTest extends TestCase
{
  use RefreshDatabase;

  public function testSuccessConfirmOrder() {
    $this->seed();
    $product = factory(Product::class)->create();
    $user = factory(User::class)->create([
      'last_name' => 'Ямада',
      'first_name' => 'Ичиро',
      'email' => 'oregaIchi@gmail.com',
    ]);
    $this->actingAs($user)->post('/cart/add/1');

    $response = $this->actingAs($user)->post('/cart/order', [
      'state' => 'Шибуя',
      'city' => 'Токио',
      'street' => 'Имперская',
      'house' => 45,
      'flat' => 23,
      'postal_code' => 123456,
      'last_name' => $user->last_name,
      'first_name' => $user->first_name,
      'email' => $user->email,
    ]);

    $this->assertDatabaseHas('orders', [
      'user_id' => $user->id,
      'status' => 2
    ]);
  }

  public function testFailedConfirmOrderNoStateAndCity() {
    $this->seed();
    $product = factory(Product::class)->create();
    $user = factory(User::class)->create([
      'last_name' => 'Ворон',
      'first_name' => 'Евгений',
      'email' => 'Evgesh@list.jp',
    ]);
    $this->actingAs($user)->post('/cart/add/1');

    $response = $this->actingAs($user)->post('/cart/order', [
      'state' => '',
      'city' => '',
      'street' => 'Троян',
      'house' => 6,
      'flat' => 11,
      'postal_code' => 698523,
      'last_name' => $user->last_name,
      'first_name' => $user->first_name,
      'email' => $user->email,
    ]);

    $response->assertSessionHasErrors('state');
    $response->assertSessionHasErrors('city');
  }

  public function testFailedConfirmOrderNoStreetAndHouseAndIndex() {
    $this->seed();
    $product = factory(Product::class)->create();
    $user = factory(User::class)->create([
      'last_name' => 'Джостар',
      'first_name' => 'Джозеф',
      'email' => 'bestJostar@jojo.jp',
    ]);
    $this->actingAs($user)->post('/cart/add/1');

    $response = $this->actingAs($user)->post('/cart/order', [
      'state' => 'Окинава',
      'city' => 'Имари',
      'street' => '',
      'house' => '',
      'flat' => 78,
      'postal_code' => '',
      'last_name' => $user->last_name,
      'first_name' => $user->first_name,
      'email' => $user->email,
    ]);

    $response->assertSessionHasErrors('street');
    $response->assertSessionHasErrors('house');
    $response->assertSessionHasErrors('postal_code');
  }

  public function testFailedConfirmOrderNoUsersData() {
    $this->seed();
    $product = factory(Product::class)->create();
    $user = factory(User::class)->create();
    $this->actingAs($user)->post('/cart/add/1');

    $response = $this->actingAs($user)->post('/cart/order', [
      'state' => 'Коти',
      'city' => 'Симанто',
      'street' => 'Морская',
      'house' => 12,
      'flat' => 32,
      'postal_code' => 456789,
      'last_name' => '',
      'first_name' => '',
      'email' => '',
    ]);

    $response->assertSessionHasErrors('last_name');
    $response->assertSessionHasErrors('first_name');
    $response->assertSessionHasErrors('email');
  }

  public function testFailedConfirmOrderIncorrectIndex() {
    $this->seed();
    $product = factory(Product::class)->create();
    $user = factory(User::class)->create([
      'last_name' => 'Брандо',
      'first_name' => 'Дио',
      'email' => 'TheWorld@stand.pd',
    ]);
    $this->actingAs($user)->post('/cart/add/1');

    $response = $this->actingAs($user)->post('/cart/order', [
      'state' => 'Осака',
      'city' => 'Осака',
      'street' => 'Юменосаки',
      'house' => 3,
      'flat' => 8,
      'postal_code' => 'tyu678',
      'last_name' => $user->last_name,
      'first_name' => $user->first_name,
      'email' => $user->email,
    ]);

    $response->assertSessionHasErrors('postal_code');
  }

  public function testConfirmOrderBorderData() {
    $this->seed();
    $product = factory(Product::class)->create();
    $user = factory(User::class)->create();
    $this->actingAs($user)->post('/cart/add/1');

    $response = $this->actingAs($user)->post('/cart/order', [
      'state' => 'afds',
      'city' => 'Kosdo',
      'street' => 'erytfsvcx',
      'house' => 123,
      'flat' => '',
      'postal_code' => 789678,
      'last_name' => 'dfsfds',
      'first_name' => 'asdfdh',
      'email' => 'border@emailhyp',
    ]);

    $this->assertDatabaseHas('orders', [
      'user_id' => $user->id,
      'status' => 2
    ]);
  }
}
