<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastPoll = null;
        $lastPollOptions = null;
        $generalData = null;

        $posts = \App\Post::where('user_id', Auth::id())->count();
        $postsViews = \App\Post::where('user_id', Auth::id())->sum('view_count');
        $lastPoll = \App\Poll::where('user_id', Auth::id())->where('status', 1)->orderBy('created_at', 'desc')->first();

        if($lastPoll) {
            $lastPollOptions = $lastPoll->options()->orderBy('vote_count', 'desc')->get();
            $lastPoll->votesSum = $lastPollOptions->sum('vote_count');
        }

        if(Auth::user()->is_master == 'Sim') {
            $generalData['totalPosts'] = \App\Post::all()->count();
            $generalData['totalUsers'] = \App\User::all()->count();
            $generalData['totalViews'] = \App\Post::all()->sum('view_count');
            $generalData['pendingPosts'] = \App\Post::where('allowed', 0)->orderBy('updated_at', 'desc')->take(5)->get();
        }

        return view('dashboard.index')->with([
            'posts' => $posts,
            'postsViews' => $postsViews,
            'lastPoll' => $lastPoll,
            'lastPollOptions' => $lastPollOptions,
            'generalData' => $generalData
        ]);
    }

}
