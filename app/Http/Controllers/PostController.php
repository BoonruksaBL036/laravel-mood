<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'Laravel 8 is Released!', 'posted_by' => 'Tania Rascia'],
            ['id' => 2, 'title' => 'The Road to Vue 3: Vite', 'posted_by' => 'Lachlan Miller'],
            ['id' => 3, 'title' => 'The Road to Vue 3: Vue Router', 'posted_by' => 'Lachlan Miller'],
            ['id' => 4, 'title' => 'The Road to Vue 3: Vue 3', 'posted_by' => 'Lachlan Miller'],
        ];
        return view('home', ['posts' => $posts]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'posted_by' => 'required'
        ]);

        Post::create($request->all());

        return redirect()->route('message')->with('success', 'Post created successfully.');
    }

    public function message()
    {
        $posts = Post::paginate(6);
        return view('message', compact('posts'));
    }
}
