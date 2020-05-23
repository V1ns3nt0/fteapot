<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\User;

class LoginUserTest extends TestCase
{
  use RefreshDatabase;

  public function testUserSuccessLogin() {
    $user = factory(User::class)->create([
      'email' => 'Austro@mars.jp',
      'password' => Hash::make($password = 'root12345'),
    ]);

    $response = $this->post(route('login'), [
      'email' => $user->email,
      'password' => $password,
    ]);

    $response->assertRedirect('/home/orders');
    $this->assertAuthenticatedAs($user);
  }

  public function testUserSuccessLogin2() {
    $user = factory(User::class)->create([
      'email' => 'Van_Lil@gmail.com',
      'password' => Hash::make($password = 'diaSomNIA66'),
    ]);

    $response = $this->post(route('login'), [
      'email' => $user->email,
      'password' => $password,
    ]);

    $response->assertRedirect('/home/orders');
    $this->assertAuthenticatedAs($user);
  }

  public function testUserFailedLoginIncorrectPassword() {
    $user = factory(User::class)->create([
      'email' => 'Van_Lil@gmail.com',
      'password' => Hash::make($password = 'Passwordfff'),
    ]);

    $response = $this->post(route('login'), [
      'email' => $user->email,
      'password' => 'cactus',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
  }

  public function testUserFailedLoginNoPassword() {
    $user = factory(User::class)->create([
      'email' => 'flow@twee.rt',
      'password' => Hash::make($password = 'Passwordfff'),
    ]);

    $response = $this->post(route('login'), [
      'email' => $user->email,
      'password' => '',
    ]);

    $response->assertSessionHasErrors('password');
    $this->assertGuest();
  }

  public function testUserFailedLoginDosentExistEmail() {
    $response = $this->post(route('login'), [
      'email' => 'cactus@gmail.com',
      'password' => 'flowTwjgs',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
  }

  public function testUserFailedLoginBorderData() {
    $user = factory(User::class)->create([
      'email' => 'cactus@gmailcom',
      'password' => Hash::make($password = 'Passwordfff'),
    ]);

    $response = $this->post(route('login'), [
      'email' => $user->email,
      'password' => $password,
    ]);

    $response->assertRedirect('/home/orders');
    $this->assertAuthenticatedAs($user);
  }
}
