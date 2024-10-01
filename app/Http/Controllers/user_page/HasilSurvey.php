<?php

namespace App\Http\Controllers\user_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HasilSurvey extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    return view('user_page.hasil-survey', ['pageConfigs' => $pageConfigs]);
  }
}