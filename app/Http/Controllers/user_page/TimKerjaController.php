<?php

namespace App\Http\Controllers\user_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;

class TimKerjaController extends Controller
{
    public function index()
    {
        // Retrieve active content with category 'Tim Kerja'
        $contents = Content::where('status', 'Aktif')
            ->whereHas('content_categories', function ($query) {
                $query->where('nama', 'Tim Kerja');
            })->get();

        // Page configuration
        $pageConfigs = ['myLayout' => 'front'];

        // Return the view with the content data
        return view('user_page.tim-kerja', compact('contents'), ['pageConfigs' => $pageConfigs]);
    }
}
