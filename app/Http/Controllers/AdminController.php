<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\AddArticleRequest;
use App\Http\Requests\EditArticleRequest;
use App\Http\Requests\AddNewsRequest;
use App\Http\Requests\AddStaffRequest;
use App\Product;
use App\TeaKind;
use App\TeaTaste;
use App\Category;
use App\Article;
use App\News;
use App\User;
use App\Order;

class AdminController extends Controller
{
    public function index() {
      $orders = Order::get_latest_orders();
      $items = Order::get_orders_items($orders);
      return view('admin', ['orders' => $orders, 'items' => $items]);
    }

    public function tea() {
      $product = Product::paginate();
      return view('admin_tea', ['products' => $product]);
    }

    public function hide_tea(Product $product) {
      Product::change_actual($product);
      return redirect()->back();
    }

    public function open_edit_tea(Product $product) {
      $tastes = TeaTaste::get_tastes();
      $kinds = TeaKind::get_kinds();
      $categories = Category::get_categories();
      return view('admin_edit_tea', ['tastes' => $tastes, 'kinds' => $kinds, 'categories' => $categories, 'product' => $product]);
    }

    public function edit_tea(EditProductRequest $request, Product $product) {
      Product::edit_product($request, $product);
      return redirect('/admin/tea');
    }

    public function open_add_tea() {
      $tastes = TeaTaste::get_tastes();
      $kinds = TeaKind::get_kinds();
      $categories = Category::get_categories();
      return view('admin_add_tea', ['tastes' => $tastes, 'kinds' => $kinds, 'categories' => $categories]);
    }

    public function add_tea(AddProductRequest $request) {
      Product::new_product($request);
      return redirect('/admin/tea');
    }



    public function articles() {
      $articles = Article::paginate();
      return view('admin_article', ['articles' => $articles]);
    }

    public function delete_article(Article $article) {
      Article::remove_article($article);
      return redirect()->back();
    }

    public function open_add_article() {
      return view('admin_add_article');
    }

    public function add_article(AddArticleRequest $request) {
      Article::new_article($request);
      return redirect('/admin/articles');
    }

    public function open_edit_article(Article $article) {
      return view('admin_edit_article', ['article' => $article]);
    }

    public function edit_article(EditArticleRequest $request, Article $article) {
      Article::change_article($request, $article);
      return redirect('/admin/articles');
    }


    public function news() {
      $news = News::paginate();
      return view('admin_news', ['news' => $news]);
    }

    public function hide_news(News $news) {
      News::change_news_status($news);
      return redirect()->back();
    }

    public function open_add_news() {
      return view('admin_add_news');
    }

    public function add_news(AddNewsRequest $request) {
      News::new_news($request);
      return redirect('/admin/news');
    }

    public function staff() {
      $staff = User::get_staff();
      return view('admin_staff', ['staff' => $staff]);
    }

    public function disband_user(User $user) {
      User::off_admin($user);
      return redirect()->back();
    }

    public static function open_add_staff() {
      return view('admin_add_staff');
    }

    public static function add_staff(AddStaffRequest $request) {
      User::new_staff($request);
      return redirect('/admin/staff');

    }

    public function orders() {
      $orders = Order::get_all_orders();
      $items = Order::get_orders_items($orders);
      return view('admin_orders', ['orders' => $orders, 'items' => $items]);
    }

    public function change_order(Order $order) {
      Order::change_order_status($order);
      return redirect()->back();
    }
}
