<?php

namespace App\Http\Controllers\user_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StandarPelayanan extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    return view('user_page.standar-pelayanan', ['pageConfigs' => $pageConfigs]);
  }
}
