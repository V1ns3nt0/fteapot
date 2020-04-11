<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class News extends Model
{
    protected $fillable = ['path', 'actual', 'user_id'];

    public static function get_news() {
      return self::where('actual', 1)->get();
    }

    public static function change_news_status($news) {
      $state = 0;
      if ($news->actual == 0) {
        $state = 1;
      }
      return $news->update(['actual' => $state]);
    }

    public static function new_news($request) {
      $path = $request->file('newsImg')->store('public/news');
      $pathEX = explode('/', $path);
      $name = "/storage/news/".$pathEX[2];
      return self::create([
        'path' => $name,
        'actual' => 1,
        'user_id' => Auth::user()->id
      ]);
    }
}
