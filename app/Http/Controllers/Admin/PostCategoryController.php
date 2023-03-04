<?php

namespace App\Http\Controllers\Admin;
use App\Models\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    /**
     * Request form data
     * 
     * @var array
     */
    private function form_data($request){

        $title          = $request->input('title');
        $description    = $request->input('description');
        $meta_description = $request->input('meta_description');
        $meta_keywords  = $request->input('meta_keywords');
        $image          = $request->input('feature_image');
        $thumbnail      = $request->input('thumbnail');
        $status         = $request->input('status');
        $sort_order     = $request->input('sort_order') !=''?$request->input('sort_order'):0;

        $data = array(
            'title'          => $title,
            'description'    => $description,
            'meta_description'=> $meta_description,
            'meta_keywords'  => $meta_keywords,
            'thumbnail'     => $thumbnail,
            'image'         => $image,
            'status'        => $status,
            'sort_order'    => $sort_order
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
            $data['category'] = PostCategory::get();
            return view('admin.category.all',$data);
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
            return view('admin.category.create');
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
            'title' => 'required|max:255'
        ]);
        $form_data = $this->form_data($request);
        $result = PostCategory::create($form_data);
        if ($result) {
            return back()->with('success','Success, added a new category.');   
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
            $category = PostCategory::where('id',$id)->first();
            if(isset($category)){
                $data['edit'] = $category;
                return view('admin.category.edit',$data);
            }else{
                return redirect()->route('system.post.category')->with('error','Sorry, data not found.');   
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
        $result = PostCategory::where('id',$id)->update($form_data);
        if ($result) {
            return back()->with('success','Success, updated a category.');   
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
        $result =  PostCategory::find($id)->delete();
        if ($result) {
            return back()->with('success','Success, deleted a category.');   
        }else{
            return back()->with('error','Sorry, something is wrong');   
        }
    }
}
