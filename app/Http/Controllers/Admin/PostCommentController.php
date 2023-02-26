<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Post;
use App\Models\PostComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(checkAuthorization() == true){
            $data['comments'] = PostComment::select('post_id')->distinct()->get();
            return view('admin.pages.comments',$data);
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
        //
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
            'comment'=>'required|string|min:5|max:255',
        ]);
        $input = $request->all();
        $input['user_type'] = 'admin';
        $input['user_id']   = Auth::guard('admin')->user()->id;
        $input['status']    = 1;

        $result = PostComment::create($input);
        if($result){
            return back()->with('success','Successfully added your comment. Your comment will be displayed after review.');  
        }else{
            return back()->with('error','Sorry, something is wrong.');   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(checkAuthorization() == true){
            $data['post']       = Post::where('id',$id)->first();
            return view('admin.pages.comment-detail',$data);
        }else{
            return view('errors.401');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
