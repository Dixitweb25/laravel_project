<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// import model
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Like;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with(['category', 'user'])->latest()->get();
        return view('web.blog', compact('blogs'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::all();
        return view('web.createBlog', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:blog_categories,id',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }

        Blog::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'post_date' => $request->post_date,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog->load('comments');
        return view('web.blog-details', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        // Allow only the blog owner to access the edit form
        if (auth()->id() !== $blog->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this blog.');
        }

        $categories = BlogCategory::all();
        return view('web.editBlog', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {

        // Allow only the blog owner to update
        if (auth()->id() !== $blog->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to update this blog.');
        }

        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        // Check and delete old image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete old image file if it exists
            if ($blog->image && file_exists(public_path('uploads/' . $blog->image))) {
                unlink(public_path('uploads/' . $blog->image));
            }

            // Upload new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $blog->image = $imageName;
        }

        $blog->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $blog->image,
            'post_date' => $request->post_date,

        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {

        // Check if the logged-in user is the owner of the blog
        if (auth()->id() !== $blog->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this blog.');
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
    public function toggleLike($id)
    {
        $user = auth()->user();
        $blog = Blog::findOrFail($id); // ✅ manually fetch blog

        if ($blog->isLikedBy($user)) {
            $blog->likes()->where('user_id', $user->id)->delete();
            return response()->json([
                'liked' => false,
                'count' => $blog->likes()->count()
            ]);
        } else {
            $blog->likes()->create(['user_id' => $user->id]);
            return response()->json([
                'liked' => true,
                'count' => $blog->likes()->count()
            ]);
        }
    }

    public function storeComment(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required'
        ]);

        $blog->comments()->create($request->only(['name', 'email', 'comment']));

        return redirect()->back()->with('success', 'Comment posted!');
    }

}
