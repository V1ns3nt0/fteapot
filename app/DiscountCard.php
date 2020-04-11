<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DiscountCard extends Model
{
    protected $fillable = ['card_number', 'percent', 'user_id'];
    public $timestamps = false;

    public function user() {
      return $this->belongsTo(User::class);
    }

    public static function save_discount_card($request) {
      $cuser = Auth::user();
      $note = self::where('user_id', $cuser->id)->first();
      // dd($note);
      if ($note) {
        return self::where('user_id', $cuser->id)->update(['card_number' => $request->cardNum]);
      } else {
        return self::create([
          'card_number' => $request->cardNum,
          'percent' => 10,
          'user_id'=>$cuser->id
        ]);
      }

    }
}
