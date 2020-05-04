<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\TeaKind;
use App\TeaTaste;
use App\News;
use Spatie\Sitemap\SitemapGenerator;

class ProductController extends Controller {
  public function index() {
    $products = Product::get_latest_products();
    $news = News::get_news();

    return view('index', ['products' => $products, 'news' => $news]);
  }

  public function catalog(Request $request) {
    $products = Product::filtering_products($request);
    // $products = Product::get_all_products();
    $tastes = TeaTaste::get_tastes();
    $kinds = TeaKind::get_kinds();
    return view('catalog', ['products' => $products, 'tastes' => $tastes, 'kinds'=>$kinds]);
  }

  public function single_product(Product $product) {
    // $product = Product::get_single_product($product_id);
    $kind = TeaKind::get_kind_name($product->tea_kind);
    $taste = TeaTaste::get_taste_name($product->tea_taste);
    return view('single_product', ['product' => $product, 'kind' => $kind, 'taste' => $taste]);
  }

  public function filtering(Request $request) {
    // Product::filtering_products($request);
  }
}
