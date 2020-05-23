<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\User;

class RegisterUserTest extends TestCase
{

    use RefreshDatabase;

    public function testUserSuccessRegistration() {
      Event::fake();

      $response = $this->post(route('register'), [
            'last_name' => 'Брагинский',
            'first_name' => 'Иван',
            'email' => 'braginski@mail.ru',
            'password' => 'watashiHero12',
            'password_confirmation' => 'watashiHero12',
        ]);

      $response->assertRedirect('/home/orders');
      $this->assertCount(1, $users = User::all());
      $this->assertAuthenticatedAs($user = $users->first());
      $this->assertEquals('Брагинский', $user->last_name);
      $this->assertEquals('Иван', $user->first_name);
      $this->assertEquals('braginski@mail.ru', $user->email);
      $this->assertTrue(Hash::check('watashiHero12', $user->password));
      Event::assertDispatched(Registered::class, function ($e) use ($user) {
            return $e->user->id === $user->id;
        });
    }

    public function testUserFailedRegistrationNoLastName() {
      $response = $this->post(route('register'), [
            'last_name' => '',
            'first_name' => 'Радия',
            'email' => 'radRed@example.com',
            'password' => 'i-love-laravel',
            'password_confirmation' => 'i-love-laravel',
        ]);

        $users = User::all();
        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('last_name');
        $this->assertGuest();
    }

    public function testUserFailedRegistrationNoFirstName() {
      $response = $this->post(route('register'), [
            'last_name' => 'Ред',
            'first_name' => '',
            'email' => 'ErRed@index.com',
            'password' => 'Root12345',
            'password_confirmation' => 'Root12345',
        ]);

        $users = User::all();
        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('first_name');
        $this->assertGuest();
    }

    public function testUserFailedRegistrationNoEmail() {
      $response = $this->post(route('register'), [
            'last_name' => 'Старый',
            'first_name' => 'Грег',
            'email' => '',
            'password' => 'aloneGreg1',
            'password_confirmation' => 'aloneGreg1',
        ]);

        $users = User::all();
        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function testUserFailedRegistrationInvalidEmail() {
      $response = $this->post(route('register'), [
            'last_name' => 'Люберц',
            'first_name' => 'Вера',
            'email' => 'invalidemail',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $users = User::all();
        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function testUserFailedRegistrationEmailExist() {
      $user = factory(User::class)->create([
        'email' => 'Austro@mars.jp',
        'password' => Hash::make($password = 'root12345'),
      ]);

      $response = $this->post(route('register'), [
            'last_name' => 'Инфузория',
            'first_name' => 'Туфелька',
            'email' => 'Austro@mars.jp',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $users = User::all();
        $this->assertCount(1, $users);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function testUserFailedRegistrationNoPassword() {
      $response = $this->post(route('register'), [
            'last_name' => 'Брагинский',
            'first_name' => 'Иван',
            'email' => 'braginski@mail.ru',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $users = User::all();
        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function testUserFailedRegistrationIncorrectPassword() {
      $response = $this->post(route('register'), [
            'last_name' => 'Липа',
            'first_name' => 'Иван',
            'email' => 'braginski@mail.ru',
            'password' => '123',
            'password_confirmation' => '123',
        ]);

        $users = User::all();
        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function testUserFailedRegistrationNoPasswordConfirm() {
      $response = $this->post(route('register'), [
            'last_name' => 'Старый',
            'first_name' => 'Грег',
            'email' => 'aloneGreg@gr.en',
            'password' => 'Laravel12',
            'password_confirmation' => '',
        ]);

        $users = User::all();
        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function testUserFailedRegistrationNoPasswordsNotMatch() {
      $response = $this->post(route('register'), [
            'last_name' => 'Лесной',
            'first_name' => 'Ноэль',
            'email' => 'noelShow@moon.en',
            'password' => 'Laravel12',
            'password_confirmation' => 'password',
        ]);

        $users = User::all();
        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function testUserRegistrationBorderData() {
      Event::fake();

      $response = $this->post(route('register'), [
            'last_name' => 'adfdsg',
            'first_name' => 'qerfggjh',
            'email' => 'radRed@examplecom',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

      $response->assertRedirect('/home/orders');
      $this->assertCount(1, $users = User::all());
      $this->assertAuthenticatedAs($user = $users->first());
      $this->assertEquals('adfdsg', $user->last_name);
      $this->assertEquals('qerfggjh', $user->first_name);
      $this->assertEquals('radRed@examplecom', $user->email);
      $this->assertTrue(Hash::check('12345678', $user->password));
      Event::assertDispatched(Registered::class, function ($e) use ($user) {
            return $e->user->id === $user->id;
        });
    }
}
