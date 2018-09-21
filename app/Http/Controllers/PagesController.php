<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Blog;

class PagesController extends Controller
{
    public function index() {
        $popular_blogs = DB::table('blogs')
            ->join('users', 'blogs.user_id', '=', 'users.id')
            ->select('blogs.*', 'users.firstName', 'users.lastName')
            ->orderBy('stars', 'DESC')
            ->limit(6)
            ->get();
        return view('index', compact('popular_blogs'));
    }

    public function about() {
        return view('about');
    }

    public function search(Request $request) {

        $results = DB::table('blogs')
                    ->join('users', 'blogs.user_id', '=', 'users.id')
                    ->select('blogs.*', 'users.firstName', 'users.lastName')
                    ->where('title', 'like', '%' . $request->search . '%')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(12);

        $search = $request->search;
        return view('search', compact('results', 'search'));
    }
}
