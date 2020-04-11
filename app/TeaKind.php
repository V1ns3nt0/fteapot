<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeaKind extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public static function get_kinds() {
      return self::all();
    }
}
