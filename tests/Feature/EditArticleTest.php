<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\User;
use App\Article;

class EditArticleTest extends TestCase
{
  use RefreshDatabase;

  public function testSuccessEditArticle() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    $article = factory(Article::class)->create();
    Storage::fake('library');
    $file = UploadedFile::fake()->image('green.jpg');

    $response = $this->actingAs($user)->post("/admin/articles/edit/$article->id", [
      'title' => 'Свойства зеленого чая',
      'description' => 'Небольшое описание',
      'content' => 'Контент этой статьи',
      'articleImg' => $file,
    ]);

    $this->assertDatabaseHas('articles', [
      'title' => 'Свойства зеленого чая',
      'description' => 'Небольшое описание',
      'content' => 'Контент этой статьи',
    ]);
    $this->assertCount(1, Article::all());
  }

  public function testFailedEditArticleNoTitle() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    $article = factory(Article::class)->create();
    Storage::fake('library');
    $file = UploadedFile::fake()->image('Article.jpg');

    $response = $this->actingAs($user)->post("/admin/articles/edit/$article->id", [
      'title' => '',
      'description' => 'Какой-то текст',
      'content' => 'О чем эта статья?',
      'articleImg' => $file,
    ]);

    $response->assertSessionHasErrors('title');
  }

  public function testFailedEditArticleNoDescription() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    $article = factory(Article::class)->create();
    Storage::fake('library');
    $file = UploadedFile::fake()->image('redTea.jpg');

    $response = $this->actingAs($user)->post("/admin/articles/edit/$article->id", [
      'title' => 'Красный чай',
      'description' => '',
      'content' => 'Статья о красном чае',
      'articleImg' => $file,
    ]);

    $response->assertSessionHasErrors('description');
  }

  public function testFailedEditArticleNoContent() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    $article = factory(Article::class)->create();
    Storage::fake('library');
    $file = UploadedFile::fake()->image('source.jpg');

    $response = $this->actingAs($user)->post("/admin/articles/edit/$article->id", [
      'title' => 'Новый сорт чая',
      'description' => 'Ученые открыли новый сорт чая. Подробнее читайте в источнике',
      'content' => '',
      'articleImg' => $file,
    ]);

    $response->assertSessionHasErrors('content');
  }

  public function testSuccessEditArticleNoImage() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    $article = factory(Article::class)->create();

    $response = $this->actingAs($user)->post("/admin/articles/edit/$article->id", [
      'title' => 'Белый чай',
      'description' => 'Инфа про белый чай',
      'content' => 'Очень интересно, честное слово',
    ]);

    $this->assertDatabaseHas('articles', [
      'title' => 'Белый чай',
      'description' => 'Инфа про белый чай',
      'content' => 'Очень интересно, честное слово',
    ]);
    $this->assertCount(1, Article::all());
  }

  public function testEditArticleBorderData() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    $article = factory(Article::class)->create();

    $response = $this->actingAs($user)->post("/admin/articles/edit/$article->id", [
      'title' => 'fgdfgd',
      'description' => 'ewtreytrytu',
      'content' => 'zvdfhgfjghkuk',
    ]);

    $this->assertDatabaseHas('articles', [
      'title' => 'fgdfgd',
      'description' => 'ewtreytrytu',
      'content' => 'zvdfhgfjghkuk',
    ]);
    $this->assertCount(1, Article::all());
  }

  public function testFailedEditArticleDosentExist() {
    $user = factory(User::class)->create(['is_admin' => 1]);

    $response = $this->actingAs($user)->get("/admin/articles/edit/1");

    $response->assertNotFound();
  }
}
