<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public static function get_status_name($id) {
      $status = self::find($id);
      return $status->name;
    }
}
