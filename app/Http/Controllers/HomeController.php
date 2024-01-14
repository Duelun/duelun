<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Http\Controllers\PostController;

class HomeController extends Controller
{
    //

    public function index() {
        $settings = Settings::first();

        $posts = app('\App\Http\Controllers\PostController')->getLatest($settings->latest_shown);

        return view('home')->with('posts', $posts);
    }
}
