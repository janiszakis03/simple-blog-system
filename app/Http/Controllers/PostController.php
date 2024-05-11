<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $post->load('comments');
        return view('posts.show', compact('post'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('title', 'like', "%$query%")
                    ->orWhere('body', 'like', "%$query%")
                    ->get();

        return view('posts.search-results', compact('posts', 'query'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'categories' => 'nullable|array'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->id(); // Assign the authenticated user as the post author
        $post->save();

        if ($request->has('categories')) {
            $post->categories()->attach($request->categories);
        }

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'categories' => 'nullable|array'
        ]);

        if (auth()->user()->id !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $post->update($validatedData);

        if (isset($validatedData['categories'])) {
            $post->categories()->sync($validatedData['categories']);
        } else {
            $post->categories()->detach();
        }

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if (auth()->user()->id !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }
}
