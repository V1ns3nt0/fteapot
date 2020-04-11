<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function index() {
      $articles = Article::get_all_articles();
      // dd($articles);
      return view('library', ['articles' => $articles]);
    }

    public function single_article(Article $article) {
      $articlep = Article::get_single_article($article);
      // dd($articlep);
      return view('single_article', ['article' => $articlep[0]]);
    }
}
