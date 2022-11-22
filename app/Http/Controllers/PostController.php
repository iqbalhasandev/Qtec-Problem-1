<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\UserSearchActivity;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = new Post();

        if ($request->has('search') && $request->search != null) {
            $posts = $posts->where('title', 'LIKE', "%{$request->search}%");
            UserSearchActivity::create([
                'user_id' => auth()->user()->id,
                'search_term' => $request->search,
                'results_count' => $posts->count(),
            ]);
        }

        $posts = $posts->orderBy('id', 'DESC')->get();
        return view('posts', compact('posts'));
    }
}
