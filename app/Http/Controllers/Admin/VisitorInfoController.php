<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Pages;
use App\Models\VisitorCount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitorInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $visitor_option_list = VisitorCount::select('key','key_value')->distinct()->get();
        $visitor_option = [];
        if(count($visitor_option_list) > 0){
            foreach($visitor_option_list as $option){
                if($option->key =='post'){
                    $result = Post::where('id',$option->key_value)->first();
                    $count  = VisitorCount::where('key',$option->key)->where('key_value',$option->key_value)->count();
                    $name = "";
                    if(isset($result)){
                        $name = $result->title;
                    }
                    $visitor_option[] = [
                        'label' => $name,
                        'value' => $option->key,
                        'count' => $count
                    ];
                }else if($option->key =='post_category'){
                    $result = PostCategory::where('id',$option->key_value)->first();
                    $count  = VisitorCount::where('key',$option->key)->where('key_value',$option->key_value)->count();
                    $name = "";
                    if(isset($result)){
                        $name = $result->title;
                    }
                    $visitor_option[] = [
                        'label' => $name,
                        'value' => $option->key,
                        'count' => $count
                    ];
                }else if($option->key =='page'){
                    $result = Pages::where('id',$option->key_value)->first();
                    $count  = VisitorCount::where('key',$option->key)->where('key_value',$option->key_value)->count();
                    $name = "";
                    if(isset($result)){
                        $name = $result->title;
                    }
                    $visitor_option[] = [
                        'label' => $name,
                        'value' => $option->key,
                        'count' => $count
                    ];
                }else{
                    $count = getPageVisitorCount($option->key);
                    $visitor_option[] = [
                        'label' => ucfirst(str_replace("_"," ",$option->key)),
                        'value' => $option->key,
                        'count' => $count
                    ];
                }
            }
        }
        $data['visitor_option'] = $visitor_option;
        $visitor_info           = view('admin.visitor',$data)->render();
        return response([
            'visitor_info' => $visitor_info,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
