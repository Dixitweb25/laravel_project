<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Like;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->with('error', 'Email ID not found!');
        }

        if (!Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Incorrect password!');
        }

        // Set session
        session(['admin_logged_in' => true, 'admin_id' => $admin->id, 'admin_name' => $admin->name]);

        return redirect()->route('admin.dashboard')->with('success', 'Login successfully!');
    }

    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Please login first.');
        }
        $users = User::latest()->get();
        $blogsCount = Blog::count();
        $likesCount = Like::count();
        $commentsCount = Comment::count();
        return view('admin.dashboard', compact('users', 'blogsCount', 'likesCount', 'commentsCount'));

    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id']);
        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }

    public function manageuser()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Please login first.');
        }

        $users = User::latest()->get();

        return view('admin.manageUser', compact('users'));
    }

    public function toggleUserActive(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'is_active' => 'required|boolean',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->is_active = $request->is_active;
        $user->save();

        $status = $request->is_active ? 'activated' : 'blocked';

        return response()->json(['message' => "User has been {$status} successfully."]);
    }

    public function manageBlog()
    {
        $blogs = Blog::with('user', 'category')->latest()->get();
        return view('admin.manageBlog', compact('blogs'));
    }

    public function Blogdestroy(Blog $blog)
    {
        try {
            $imagePath = 'public/uploads/' . $blog->image;

            // Alternative check that works for both public and storage paths
            if ($blog->image && file_exists(public_path('uploads/' . $blog->image))) {
                unlink(public_path('uploads/' . $blog->image));
            } elseif ($blog->image && Storage::disk('public')->exists('uploads/' . $blog->image)) {
                Storage::disk('public')->delete('uploads/' . $blog->image);
            }

            $blog->delete();

            return redirect()->route('admin.blogs')->with('success', 'Blog deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.blogs')->with('error', 'Error deleting blog: ' . $e->getMessage());
        }
    }

    public function manageComment()
    {
        $comments = Comment::with('blog')->latest()->get();
        return view('admin.manageComment', compact('comments'));
    }

    public function commentdestroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments')->with('success', 'Comment deleted successfully');
    }

    public function showlike()
    {
        $likes = Like::with('user', 'blog')->latest()->get();
        return view('admin.manageLike', compact('likes'));
    }

    public function likedestroy($id)
    {
        try {
            $like = Like::findOrFail($id);
            $like->delete();

            return redirect()->back()->with('success', 'Like removed successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error removing like: ' . $e->getMessage());
        }
    }
}
