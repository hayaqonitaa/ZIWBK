<?php

namespace App\Http\Controllers\user_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LayananPengaduan extends Controller
{


    public function index(){
        $pageConfigs = ['myLayout' => 'front'];
        return view('user_page.layanan-pengaduan', ['pageConfigs' => $pageConfigs]);
    }
}
