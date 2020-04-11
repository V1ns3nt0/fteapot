<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Cookie\CookieJar;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Product;
use App\OrderItems;

class OrderController extends Controller
{
    public function cart() {
      if (Auth::check()) {
        $items = Order::get_cart();
        $gprice = Order::get_general_price();
        return view('cart', ['items' => $items[0], 'products' => $items[1], 'generalPr' => $gprice]);
      } else {
        return view('cart');
      }
    }

    public function store(Product $product) {
      Order::store_item($product);
      return redirect()->back();
    }

    public function decrease_item_cart(OrderItems $orderItems) {
      OrderItems::decrease_quantity($orderItems);
      return redirect()->back();
    }

    public static function increase_item_cart(OrderItems $orderItems) {
      OrderItems::increase_quantity($orderItems);
      return redirect()->back();
    }

    public static function delete_item_cart(OrderItems $orderItems) {
      OrderItems::delete_item($orderItems);
      return redirect()->back();
    }

    public function order(OrderRequest $request) {
      // dd(json_decode($request->cookie('cart')));
      // dd(Auth::user());
      Order::make_order($request);
        return redirect('/');
    }
}
