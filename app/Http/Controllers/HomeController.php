<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * Mostra a página 'sobre'
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutShow()
    {
        $post = \App\Post::where('allowed', 1)->where('is_about', 1)->first();

        return view('about')->with([
            'post' => $post,
        ]);
    }

}
