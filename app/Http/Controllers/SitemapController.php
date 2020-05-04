<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\TeaKind;
use App\TeaTaste;
use App\Category;
use App\Article;
use App\News;
use App\User;

class SitemapController extends Controller
{
  public function index() {
    $tea = Product::all()->first();
    $article = Article::all()->first();
    return response()->view('sitemap_index', [
        'article' => $article,
        'tea' => $tea,
    ])->header('Content-Type', 'text/xml');
  }

  public function tea() {
      $tea = Product::latest()->get();
      return response()->view('sitemap_tea', [
          'tea' => $tea,
      ])->header('Content-Type', 'text/xml');
  }

  public function articles() {
       $article = Article::latest()->get();
       return response()->view('sitemap_article', [
           'articles' => $article,
       ])->header('Content-Type', 'text/xml');
   }

}
