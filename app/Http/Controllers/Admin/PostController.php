<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Post;
use App\Models\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        // Add authorization middleware if needed
        $this->middleware('check.permission');
    }

    /**
     * Prepare form data with defaults.
     */
    private function prepareFormData(Request $request)
    {
        return [
            'author_type'      => 'admin',
            'author_id'        => Auth::guard('admin')->id(),
            'category_id'      => $request->input('category'),
            'title'            => $request->input('title'),
            'sub_title'        => $request->input('sub_title'),
            'description'      => $request->input('description'),
            'meta_description' => $request->input('meta_description'),
            'meta_keywords'    => $request->input('meta_keywords'),
            'image'            => $request->input('feature_image'),
            'thumbnail'        => $request->input('thumbnail'),
            'video_url'        => $request->input('video_url'),
            'status'           => $request->input('status', 0),
        ];
    }

    /**
     * Display a listing of posts.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.all', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $category = PostCategory::where('status', 1)->get();
        return view('admin.post.create', compact('category'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|max:255']);
        $data = $this->prepareFormData($request);
        try {
            Post::create($data);
            return back()->with('success','Your item has been created.');
        } catch (\Exception $e) {
            return back()->with('error','Something went wrong. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit($id)
    {
        $edit = Post::findOrFail($id);
        $category = PostCategory::where('status', 1)->get();
        return view('admin.post.edit', compact('edit', 'category'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['title' => 'required|max:255']);
        $data = $this->prepareFormData($request);
        try {
            $post = Post::findOrFail($id);
            $post->update($data);
            return back()->with('success','Your item has been updated.');
        } catch (\Exception $e) {
            return back()->with('error','Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return back()->with('success','Your item has been deleted.');
        } catch (\Exception $e) {
            return back()->with('error','Something went wrong. Please try again.');
        }
    }
}