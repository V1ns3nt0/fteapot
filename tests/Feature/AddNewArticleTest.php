<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\User;
use App\Article;

class AddNewArticleTest extends TestCase
{
  use RefreshDatabase;

  public function testSuccesAddNewArticle() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    Storage::fake('library');

    $response = $this->actingAs($user)->post('/admin/articles/add', [
      'title' => 'Классификация чая',
      'articleImg' => UploadedFile::fake()->image('class.jpg'),
      'description' => 'Небольшое описание',
      'content' => 'Контент этой статьи'
    ]);

    $this->assertDatabaseHas('articles', [
      'title' => 'Классификация чая',
      'description' => 'Небольшое описание',
      'content' => 'Контент этой статьи',
    ]);
  }

  public function testFailedAddNewArticleNoTitle() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    Storage::fake('library');

    $response = $this->actingAs($user)->post('/admin/articles/add', [
      'title' => '',
      'articleImg' => UploadedFile::fake()->image('Article.jpg'),
      'description' => 'Карточное описание',
      'content' => 'Содержание статьи'
    ]);

    $response->assertSessionHasErrors('title');
  }

  public function testFailedAddNewArticleNoDescription() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    Storage::fake('library');

    $response = $this->actingAs($user)->post('/admin/articles/add', [
      'title' => 'Новая статья',
      'articleImg' => UploadedFile::fake()->image('Some.jpg'),
      'description' => '',
      'content' => 'Какой-то текст'
    ]);

    $response->assertSessionHasErrors('description');
  }

  public function testFailedAddNewArticleNoContent() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    Storage::fake('library');

    $response = $this->actingAs($user)->post('/admin/articles/add', [
      'title' => 'Заголовок',
      'articleImg' => UploadedFile::fake()->image('noCont.jpg'),
      'description' => 'Описание',
      'content' => ''
    ]);

    $response->assertSessionHasErrors('content');
  }

  public function testFailedAddNewArticleNoImage() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    Storage::fake('library');

    $response = $this->actingAs($user)->post('/admin/articles/add', [
      'title' => 'Статья',
      'articleImg' => '',
      'description' => 'О чем вещаешь?',
      'content' => 'Текст рыба'
    ]);

    $response->assertSessionHasErrors('articleImg');
  }

  public function testFailedAddNewArticleIncorrectImage() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    Storage::fake('library');

    $response = $this->actingAs($user)->post('/admin/articles/add', [
      'title' => 'Чай',
      'articleImg' => UploadedFile::fake()->image('image.svg'),
      'description' => 'Такого вы еще не видели',
      'content' => 'Шок контент'
    ]);

    $response->assertSessionHasErrors('articleImg');
  }

  public function testAddNewArticleBorderData() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    Storage::fake('library');

    $response = $this->actingAs($user)->post('/admin/articles/add', [
      'title' => 'A',
      'articleImg' => UploadedFile::fake()->image('image.png'),
      'description' => 'jhklklljhdsf',
      'content' => 'dsgfdhtjhj'
    ]);

    $this->assertDatabaseHas('articles', [
      'title' => 'A',
      'description' => 'jhklklljhdsf',
      'content' => 'dsgfdhtjhj'
    ]);
  }
}
