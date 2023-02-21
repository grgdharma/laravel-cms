<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Models\Post;
use App\Models\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Request form data
     * 
     * @var array
     */
    private function form_data($request){
        $category       = $request->input('category');
        $title          = $request->input('title');
        $sub_title      = $request->input('sub_title'); 
        $description    = $request->input('description');
        $meta_description = $request->input('meta_description');
        $meta_keywords = $request->input('meta_keywords');
        $image        = $request->input('feature_image');
        $thumbnail      = $request->input('thumbnail');
        $video_url      = $request->input('video_url');
        $status         = $request->input('status');
        
        $data = array(
            'author_type'   => 'admin',
            'author_id'     => Auth::guard('admin')->user()->id,
            'category_id'   => $category,
            'title'         => $title,
            'sub_title'     => $sub_title,
            'description'   => $description,
            'meta_description'=> $meta_description,
            'meta_keywords' => $meta_keywords,
            'image'         => $image,
            'thumbnail'     => $thumbnail,
            'video_url'     => $video_url,
            'status'        => $status
        );  
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(checkAuthorization() == true){
            $data['posts'] = Post::get();
            return view('admin.post.all',$data);
        }else{
            return view('errors.401');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(checkAuthorization() == true){
            $data['category'] = PostCategory::where('status',1)->get();
            return view('admin.post.create', $data);
        }else{
            return view('errors.401');
        }
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
            'title' => 'required|max:255',
        ]);
        $form_data = $this->form_data($request);
        $result = Post::create($form_data);
        if ($result) {
            return back()->with('success','Success, added a new post.');   
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
        if(checkAuthorization() == true){
            $post = Post::where('id',$id)->first();
            if(isset($post)){
                $data['edit'] = $post;
                $data['category'] = PostCategory::where('status',1)->get();
                return view('admin.post.edit',$data);
            }else{
                return redirect()->route('admin.post')->with('error','Sorry, data not found.');   
            }
        }else{
            return view('errors.401');
        }
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
        $form_data = $this->form_data($request);
        $result = Post::where('id',$id)->update($form_data);
        if ($result) {
            return back()->with('success','Success, updated a post.');   
        }else{
            return back()->with('error','Sorry, something is wrong');   
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
        $result =  Post::find($id)->delete();
        if ($result) {
            return back()->with('success','Success, deleted a post.');   
        }else{
            return back()->with('error','Sorry, something is wrong');   
        }
    }
}
