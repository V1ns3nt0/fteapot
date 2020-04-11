<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller {
    public function about() {
      return view('about');
    }
    public function delivery() {
      return view('delivery');
    }
}
