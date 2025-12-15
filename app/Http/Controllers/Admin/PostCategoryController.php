<?php

namespace App\Http\Controllers\Admin;
use App\Models\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
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
            'title'            => $request->input('title'),
            'description'      => $request->input('description'),
            'meta_description' => $request->input('meta_description'),
            'meta_keywords'    => $request->input('meta_keywords'),
            'thumbnail'        => $request->input('thumbnail'),
            'image'            => $request->input('feature_image'),
            'status'           => (bool) $request->input('status'),
            'sort_order'       => (int) $request->input('sort_order', 0),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PostCategory::get();
        return view('admin.category.all', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);
        $data = $this->prepareFormData($request);
        $result = PostCategory::create($data);
        if ($result) {
            return back()->with('success','Your item has been created.');   
        }else{
            return back()->with('error','Sorry, something is wrong');   
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = PostCategory::findOrFail($id);
        return view('admin.category.edit', [
            'edit' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);
        $data = $this->prepareFormData($request);
        $result = PostCategory::where('id',$id)->update($data);
        if ($result) {
            return back()->with('success','Your item has been updated.');   
        }else{
            return back()->with('error','Something went wrong. Please try again.');   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result =  PostCategory::find($id)->delete();
        if ($result) {
            return back()->with('success','Your item has been deleted.');   
        }else{
            return back()->with('error','Something went wrong. Please try again.');   
        }
    }
}
