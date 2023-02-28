<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use App\Http\Requests\Page\AddPageRequest;
use App\Http\Requests\Page\UpdatePageRequest;

class PageController extends Controller
{
    /**
     * Request form data
     */
    private function form_data($request){
        $title = $request->input('title');
        $parent_id = $request->input('parent_id');
        $description = $request->input('description');
        $meta_description = $request->input('meta_description');
        $meta_keyword = $request->input('meta_keywords');
        $image = $request->input('feature_image');
        $template = $request->input('template')?$request->input('template'):'default';
        $sort_order = $request->input('sort_order') !=''?$request->input('sort_order'):0;
        $status = $request->input('status') !=''?$request->input('status'):0;
        $data = array(
            'parent_id'         => $parent_id !="" ? $parent_id : NULL,
            'title'             => $title,
            'description'       => $description,
            'meta_description'  => $meta_description,
            'meta_keywords'     => $meta_keyword,
            'image'             => $image,
            'template'          => $template,
            'sort_order'        => $sort_order,
            'status'            => $status
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
            $data['pages'] = Pages::get();
            return view('admin.pages.all',$data);
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
            $data['page_lists'] = Pages::whereNull('parent_id')->get();
            return view('admin.pages.create',$data);
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
    public function store(AddPageRequest $request)
    {
        $form_data = $this->form_data($request);
        try{
            $result = Pages::create($form_data);
            if($result) {
                return back()->with('success','Success, you have added a page.');   
            }else{
                return back()->with('error','Sorry, something is wrong.');   
            }
        }catch(\Exception $e){
            return back()->with('error',$e->getMessage());   
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
            $data['id'] = $id;
            $page = Pages::where('id',$id)->first();
            if(isset($page)){
                $data['page'] = $page;
                $data['page_lists'] = Pages::whereNull('parent_id')->get();
                return view('admin.pages.edit',$data);
            }else{
                return back()->with('error','Sorry, data not found.');   
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
    public function update(UpdatePageRequest $request, $id)
    {
        $form_data = $this->form_data($request);
        try{
            $result = Pages::where('id',$id)->update($form_data);
            if ($result) {
                return back()->with('success','Success, you have modified data.');   
            }else{
                return back()->with('error','Sorry, something is wrong');   
            }
        }catch(\Exception $e){
            return back()->with('error',$e->getMessage());  
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
        try{
            $result =  Pages::find($id)->delete();
            if($result) {
                return back()->with('success','Success, you have deleted a page.');   
            }else{
                return back()->with('error','Sorry, something is wrong.');   
            }
        }catch(\Exception $e){
            return redirect()->route('admin.catalog.page')->with('error',$e->getMessage());  
        }
    }
}
