<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderItems;
use App\Http\Requests\EditDataRequest;
use App\Http\Requests\EditPassRequest;
use App\Http\Requests\DiscountCardRequest;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function user_orders() {
      $orders = User::get_user_orders();
      $items = Order::get_orders_items($orders);
      return view('users_order', ['orders' => $orders, 'items' => $items]);
    }

    public function edit_index() {
      return view('edit_data');
    }

    public function edit_data(EditDataRequest $request) {
      User::edit_user_data($request);
      return redirect()->back();
    }

    public function edit_passwords(EditPassRequest $request) {
      User::edit_user_pass($request);
      return redirect()->back();
    }

    public function card_index() {
      return view('user_card');
    }

    public function card_safe(DiscountCardRequest $request) {
      // dd($request->all());
      User::users_card($request);
    }

}
