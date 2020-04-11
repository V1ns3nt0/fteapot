<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $perPage = 8;
    protected $fillable = ['title', 'path', 'description', 'content', 'user_id'];

    public static function get_all_articles() {
      return self::paginate();
    }

    public static function get_single_article($article) {
      return self::find($article);
    }

    public static function remove_article($article) {
      return $article->delete();
    }

    public static function new_article($request) {
      $path = $request->file('articleImg')->store('public/library');
      $pathEX = explode('/', $path);
      $name = "/storage/library/".$pathEX[2];

      return self::create([
        'title' => $request->title,
        'description' => $request->description,
        'content' => $request->content,
        'path' => $name,
        'user_id' => Auth::user()->id
      ]);
    }

    public static function change_article($request, $article) {
      if($request->file('articleImg')) {
        $path = $request->file('articleImg')->store('public/library');
        $pathEX = explode('/', $path);
        $name = "/storage/library/".$pathEX[2];
      } else {
        $name = $article->path;
      }

      return $article->update([
        'title' => $request->title,
        'description' => $request->description,
        'content' => $request->content,
        'path' => $name,
      ]);
    }
}
