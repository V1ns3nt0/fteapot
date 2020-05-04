<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Cookie\CookieJar;
use App\Cart;
use App\User;
use Carbon\Carbon;

class Order extends Model
{
  protected $fillable = [
      'last_name', 'first_name', 'email', 'state', 'city', 'street', 'house',
      'flat', 'postal_code', 'user_id', 'price', 'status',
  ];

  public function orderItems() {
    return $this->hasMany(OrderItems::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public static function store_item($product) {
    $ord = self::where('user_id', Auth::user()->id)->where('status', 1)->first();
    // dd($ord);
    if ($ord) {
      // dd($ord->orderItems);
      $item = $ord->orderItems()->where('product_id', $product->id)->first();
      if ($item) {
        return $item->update([
          'product_id' => $product->id,
          'quantity' => $item->quantity + 1,
          'price' => $item->price + $product->price
        ]);
      } else {
        return $ord->orderItems()->create([
          'product_id' => $product->id,
          'quantity' => 1,
          'price' => $product->price
        ]);
      }
    } else {
      $ord = self::create(['user_id' => Auth::user()->id, 'status' => 1]);
      return $ord->orderItems()->create([
        'product_id' => $product->id,
        'quantity' => 1,
        'price' => $product->price
      ]);
    }
  }

  public static function make_order($request) {
    // dd(json_decode($request->cookie('cart')));
    // dd(Auth::user()->email);
    if(Auth::user() !== null) {
      $cuser = Auth::user()->id;
      $gprice = self::get_general_price();
      $ord = self::where('user_id', Auth::user()->id)->where('status', 1)->first();
      return $ord->update([
        'last_name'=>$request->last_name,
        'first_name'=>$request->first_name,
        'email'=>$request->email,
        'state'=>$request->state,
        'city'=>$request->city,
        'street'=>$request->street,
        'house'=>$request->house,
        'flat'=>$request->flat,
        'postal_code'=>$request->postal_code,
        'price'=>$gprice,
        'status'=> 2,
      ]);
    } else {
      $cuser = null;
      $gprice = json_decode($request->cookie('sumPrice'));
      $cartItems = json_decode($request->cookie('cart'));
      $newOrd = self::create([
        'last_name'=>$request->last_name,
        'first_name'=>$request->first_name,
        'email'=>$request->email,
        'state'=>$request->state,
        'city'=>$request->city,
        'street'=>$request->street,
        'house'=>$request->house,
        'flat'=>$request->flat,
        'postal_code'=>$request->postal_code,
        'user_id'=>$cuser,
        'price'=>$gprice,
        'status'=> 2,
      ]);

      foreach ($cartItems as $it) {
        $newOrd->orderItems()->create([
          'product_id'=> $it->productId,
          'quantity'=> $it->quantity,
          'price'=> $it->price,
        ]);
      }
      \Cookie::queue(\Cookie::forget('cart'));
      \Cookie::queue(\Cookie::forget('sumPrice'));
    }
  }

  public static function get_orders_items($orders){

    $names = [];
    // dd($orders);
    foreach ($orders as $order) {
      // dd($order);
      $items = [];
      $items[]= $order->orderItems;
      foreach ($items as $it) {
        $names [] = OrderItems::get_names($it);

      }
    }
    // dd($names);
    return $names;
  }

  public static function get_cart() {
    $ord = self::where('user_id', Auth::user()->id)->where('status', 1)->first();
    if ($ord) {
      $arr = [];
      $items = $ord->orderItems;
      foreach ($items as $item) {
        $arr[]=$item->product;
      }

      return [$items, $arr];
    } else {
      return null;
    }
  }

  public static function get_general_price() {
    $res = self::get_cart();
    if ($res) {
      $cuser = Auth::user();
      $card = $cuser->disountCard;
      $price = 0;
      // dd($res[0]);
      foreach ($res[0] as $item) {
        $price += $item->price;
      }
      if($card) {
        $price = $price - $price * 0.1;
      }
      return $price;
    }
  }

  public static function change_order_status($order) {
    return $order->update(['status' => 3]);
  }

  public static function get_latest_orders() {
    return self::whereIn('status', [2, 3])->whereDate('updated_at', Carbon::today())->limit(8)->get();
  }

  public static function get_all_orders() {
    return self::whereIn('status', [2, 3])->paginate(8);
  }
}
