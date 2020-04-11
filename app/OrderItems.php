<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
  protected $fillable = [
      'order_id', 'product_id', 'quantity', 'price',
  ];
  public $timestamps = false;

  public function product() {
    return $this->belongsTo(Product::class);
  }

  public static function get_names($item) {
    $names =[];
    foreach ($item as $it) {
      $names[] = $it->product->name;
    }
    return $names;
    // dd($names);
  }

  public static function decrease_quantity($item) {
    $pr = $item->product;
    if($item->quantity > 1) {
      return $item->update([
        'quantity' => $item->quantity - 1,
        'price' => $item->price - $pr->price
      ]);
    } else {
      self::delete_item($item);
    }

  }

  public static function increase_quantity($item) {
    $pr = $item->product;
    return $item->update([
      'quantity' => $item->quantity + 1,
      'price' => $item->price + $pr->price
    ]);
  }

  public static function delete_item($item) {
    return $item->delete();
  }

}
