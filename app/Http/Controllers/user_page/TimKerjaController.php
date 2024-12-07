<?php

namespace App\Http\Controllers\user_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimKerja;

class TimKerjaController extends Controller
{
    public function index()
    {
        // Retrieve active content with category 'Tim Kerja'
        $contents = TimKerja::where('status', 'Aktif')->get();

        // Page configuration
        $pageConfigs = ['myLayout' => 'front'];

        // Return the view with the content data
        return view('user_page.tim-kerja', compact('contents'), ['pageConfigs' => $pageConfigs]);
    }
}
