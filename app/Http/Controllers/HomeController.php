<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (request('num_of_post')) {
            $posts = app('crawler')->crawl(request('num_of_post'));

            $posts = $posts->sortByDesc('comments_count')->values();
        } else {
            $posts = collect();
        }

        return view('home', compact('posts'));
    }
}
