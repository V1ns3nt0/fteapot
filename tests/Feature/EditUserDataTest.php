<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\User;

class EditUserDataTest extends TestCase
{
  use RefreshDatabase;

  public function testUserSuccessEditData() {
    $user = factory(User::class)->create();

    $this->actingAs($user);
    $response = $this->post('/home/edit', [
      'firstName' => 'Евгений',
      'lastName' => 'Ворон',
      'email' => 'oregaIchi@gmail.com',
    ]);

    $this->assertEquals('Евгений', $user->first_name);
    $this->assertEquals('Ворон', $user->last_name);
    $this->assertEquals('oregaIchi@gmail.com', $user->email);
  }

  public function testUserFailedEditDataNoLastName() {
    $user = factory(User::class)->create();

    $this->actingAs($user);
    $response = $this->post('/home/edit', [
      'firstName' => 'Филипп',
      'lastName' => '',
      'email' => 'fil@gmail.com',
    ]);

    $response->assertSessionHasErrors('lastName');
  }

  public function testUserFailedEditDataNoFirstName() {
    $user = factory(User::class)->create();

    $this->actingAs($user);
    $response = $this->post('/home/edit', [
      'firstName' => '',
      'lastName' => 'Хорс',
      'email' => 'horse@gmail.com',
    ]);

    $response->assertSessionHasErrors('firstName');
  }

  public function testUserFailedEditDataNoEmail() {
    $user = factory(User::class)->create();

    $this->actingAs($user);
    $response = $this->post('/home/edit', [
      'firstName' => 'Джозеф',
      'lastName' => 'Джостар',
      'email' => '',
    ]);

    $response->assertSessionHasErrors('email');
  }

  public function testUserFailedEditDataIncorrectEmail() {
    $user = factory(User::class)->create();

    $this->actingAs($user);
    $response = $this->post('/home/edit', [
      'firstName' => 'Джозеф',
      'lastName' => 'Джостар',
      'email' => 'bestJostar',
    ]);

    $response->assertSessionHasErrors('email');
  }

  public function testUserFailedEditDataEmailExist() {
    $user = factory(User::class)->create([
      'email' => 'Austro@mars.jp',
      'password' => Hash::make($password = 'root12345'),
    ]);

    $user = factory(User::class)->create();

    $this->actingAs($user);
    $response = $this->post('/home/edit', [
      'firstName' => 'Джозеф',
      'lastName' => 'Джостар',
      'email' => 'Austro@mars.jp',
    ]);

    $response->assertSessionHasErrors('email');
  }

  public function testUserEditDataBorderData() {
    $user = factory(User::class)->create();

    $this->actingAs($user);
    $response = $this->post('/home/edit', [
      'firstName' => 'qwe',
      'lastName' => 'aasddasd',
      'email' => 'Nicdfs@listru',
    ]);

    $this->assertEquals('qwe', $user->first_name);
    $this->assertEquals('aasddasd', $user->last_name);
    $this->assertEquals('Nicdfs@listru', $user->email);
  }
}
