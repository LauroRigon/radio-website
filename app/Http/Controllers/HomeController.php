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
        $posts = \App\Post::where('allowed', 1)->where('is_about', 0)->orderBy('published_at', 'desc')->paginate(10);
        $supporters = \App\Supporter::where('status', 1)->get();
        $polls = \App\Poll::where('status', 1)->get();

        $day = Carbon::create()->dayOfWeek;
        $day = \App\Http\HelperFunctions::dayOfWeekByNum($day);
        $programmingOfDay = \App\Programming::where('day_of_week', $day)->get();

        return view('home')->with([
            'posts' => $posts,
            'supporters' => $supporters,
            'programmingOfDay' => $programmingOfDay,
            'polls' => $polls
        ]);
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
