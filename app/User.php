<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\DiscountCard;

class User extends Authenticatable
{
    use Notifiable;


    // protected $table = 'users';
    // protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'last_name', 'first_name', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public $timestamps = false;

    public function order() {
      return $this->hasMany(Order::class);
    }

    public function disountCard() {
      return $this->hasOne(DiscountCard::class);
    }

    public static function get_user_orders() {
      $cuser = Auth::user()->id;
      return self::find($cuser)->order()->whereIn('status', [2, 3])->paginate(8);
    }

    public static function edit_user_data($request) {
      $cuser = Auth::user();
      // dd($request);
      return $cuser->update([
        'last_name'=>$request->lastName,
        'first_name'=>$request->firstName,
        'email'=>$request->email,
      ]);
    }

    public static function edit_user_pass($request) {
      $cuser = Auth::user();
      return $cuser->update([
        'password'=> Hash::make($request->password)
      ]);
    }

    public static function users_card($request) {
      DiscountCard::save_discount_card($request);
    }

    public static function get_staff() {
      return self::where('is_admin', 1)->paginate();
    }

    public static function off_admin($user) {
      return $user->update([
        'is_admin' => 0
      ]);
    }

    public static function new_staff($request) {
      return self::create([
        'last_name'=>$request->lastName,
        'first_name'=>$request->firstName,
        'email'=>$request->email,
        'password'=> Hash::make($request->password),
        'is_admin' => 1,
      ]);
    }
}
