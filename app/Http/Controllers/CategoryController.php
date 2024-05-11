<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(10);

        return view('categories.show', compact('posts', 'category'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|max:255',
        ]);

        $category = new Category();
        $category->category = $request->category;
        // $category->user_id = auth()->id(); // Assign the authenticated user as the post author
        $category->save();

        return redirect()->route('home')->with('success', 'Category added successfully!');
    }
}
