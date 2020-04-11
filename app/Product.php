<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model {
    // protected $table = 'products';
    // protected $primaryKey = 'product_id';
    protected $fillable = [
        'category_id', 'name', 'card_description', 'full_description', 'tea_kind', 'tea_taste', 'price',
        'path', 'actual',
    ];
    protected $perPage = 8;
    public $timestamps = false;

  public function cartItems() {
    return $this->hasMany(CartItems::class);
  }

    public static function get_latest_products() {
      $products = self::select()->where('actual', 1)->orderBy('id', 'desc')->limit(4)->get();
      return $products;
    }

    public static function get_all_products() {
      $products = self::where('actual', 1)->paginate();
      return $products;
    }

    public static function get_single_product($product) {
      $product = self::find($product);
      return $product;
    }

    public static function filtering_products($request) {
      // dd($request);
      if($request->tea_kind && $request->tea_taste) {
        $pr = self::where('actual', 1)->where('price', '>=', $request->minPrice)->whereIn('tea_kind', $request->tea_kind)->whereIn('tea_taste', $request->tea_taste)->paginate();
      } elseif ($request->tea_kind) {
        $pr = self::where('actual', 1)->where('price', '>=', $request->minPrice)->whereIn('tea_kind', $request->tea_kind)->paginate();
      } elseif ($request->tea_taste) {
        $pr = self::where('actual', 1)->where('price', '>=', $request->minPrice)->whereIn('tea_taste', $request->tea_taste)->paginate();
      } else {
        $pr = self::where('actual', 1)->paginate();
      }
      // dd($pr);
      return $pr;
    }

    public static function change_actual($product) {
      $state = 0;
      if ($product->actual == 0) {
        $state = 1;
      }
      return $product->update(['actual' => $state]);
    }

    public static function new_product($request) {
      $path = $request->file('teaImg')->store('public/tea');
      $pathEX = explode('/', $path);
      $name = "/storage/tea/".$pathEX[2];
      return self::create([
        'category_id' => $request->teaCategory,
        'name' => $request->teaName,
        'card_description' => $request->cardDescription,
        'full_description' => $request->fullDescription,
        'tea_kind' => $request->teaKind,
        'tea_taste' => $request->teaTaste,
        'price' => $request->teaPrice,
        'path' => $name
      ]);
    }

    public static function edit_product($request, $product) {
      if($request->file('teaImg')) {
        $path = $request->file('teaImg')->store('public/tea');
        $pathEX = explode('/', $path);
        $name = "/storage/tea/".$pathEX[2];
      } else {
        $name = $product->path;
      }

      return $product->update([
        'category_id' => $request->teaCategory,
        'name' => $request->teaName,
        'card_description' => $request->cardDescription,
        'full_description' => $request->fullDescription,
        'tea_kind' => $request->teaKind,
        'tea_taste' => $request->teaTaste,
        'price' => $request->teaPrice,
        'path' => $name
      ]);
    }
}
