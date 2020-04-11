<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeaTaste extends Model
{
  protected $fillable = ['name'];
  public $timestamps = false;

  public static function get_tastes() {
    return self::all();
  }
}
