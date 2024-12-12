<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'news' => 'required',
        ]);

        Post::create([
            'title' => $request->title,
            'news' => $request->news,
            'author_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Пост успешно создан!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (auth()->user()->isAdmin()) {
            return view('posts.edit', compact('post'));
        }
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'news' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'news' => $request->news,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if (auth()->id() !== $post->author_id && !auth()->user()->isAdmin()) {
            abort(403, 'У вас нет доступа к удалению этого поста.');
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
