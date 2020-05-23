<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Article;

class DeleteArticleTest extends TestCase
{
  use RefreshDatabase;

  public function testSuccessDaleteArticle() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    $article = factory(Article::class)->create();

    $response = $this->actingAs($user)->get("/admin/articles/del/$article->id");

    $this->assertDeleted('articles', [
      'id' => $article->id,
      'title' => $article->title,
    ]);
  }

  public function testSuccessDaleteArticleMore() {
    $user = factory(User::class)->create(['is_admin' => 1]);
    $article = factory(Article::class, 2)->create();

    for ($i=1; $i < 3; $i++) {
      $response = $this->actingAs($user)->get("/admin/articles/del/$i");
    }

    for ($i=1; $i < 3; $i++) {
      $this->assertDeleted('articles', [
        'id' => $i,
      ]);
    }
  }

  public function testFailedDaleteArticleDosentExist() {
    $user = factory(User::class)->create(['is_admin' => 1]);

    $response = $this->actingAs($user)->get("/admin/articles/del/1");

    $response->assertNotFound();
  }
}
