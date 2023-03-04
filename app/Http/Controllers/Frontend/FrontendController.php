<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Pages;
use App\Models\Post;
use App\Models\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.For DEMO
     *
     * @return \Illuminate\Http\Response
     */
    public function demo()
    {
        visitorCount('home',0);
        $data['title']              = get_general_setting('site_title');
        $data['meta_title']         = get_general_setting('site_meta_title');
        $data['meta_keywords']      = get_general_setting('site_meta_keyword');
        $data['description']        = get_general_setting('site_meta_description');
        $data['meta_description']   = get_general_setting('site_meta_description');
        $data['featured_image']     = get_general_setting('site_featured_image');
        $data['cover_image']        = get_general_setting('site_featured_image');
        // Get post lists
        $data['post_lists'] = Post::where('status',1)->orderBy('id','DESC')->get();
        $data['categories'] = PostCategory::where('status',1)->get();
        
        return view('frontend.home',$data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        visitorCount('home',0);
        $data['title']              = get_general_setting('site_title');
        $data['meta_title']         = get_general_setting('site_meta_title');
        $data['meta_keywords']      = get_general_setting('site_meta_keyword');
        $data['description']        = get_general_setting('site_meta_description');
        $data['meta_description']   = get_general_setting('site_meta_description');
        $data['featured_image']     = get_general_setting('site_featured_image');
        $data['cover_image']        = get_general_setting('site_featured_image');
        // Get post lists
        $data['post_lists'] = Post::where('status',1)->orderBy('id','DESC')->get();
        $data['categories'] = PostCategory::where('status',1)->get();

        if(get_general_setting("site_status")==1){
            return view('frontend.home',$data);
        }else{
            return view('welcome');
        }
    }
    // Page Information
    public function page_detail($slug){
        $data['title'] = config('generals.site_title');
        $page = Pages::where('slug',$slug)->where('status',1)->first();
        if(isset($page)){
            visitorCount('page',$page->id);
            $template_name = $page->template;
            // new
            $data['page_title']         = $page->title; 
            $data['meta_title']         = $page->title;
            $data['meta_keywords']      = isset($page->meta_keywords) && $page->meta_keywords !=""? $page->meta_keywords: config('generals.site_meta_keyword');
            $data['meta_description']   = $page->meta_description; 
            $data['featured_image']     = $page->image ? $page->image : config('generals.site_featured_image');
            $data['cover_image']        = get_general_setting('site_featured_image');

            $data['description']        = $page->description; 
            $data['thumbnail']          = $page->thumbnail;
            $data['image']              = $page->image;
            $data['post']               = $page;

            $data['categories'] = PostCategory::where('status',1)->get();
            if($template_name !=''){
                return view('frontend.template.'.$template_name,$data);
            }else{
                return view('frontend.template.default',$data);
            }
        }else{
            return redirect()->route('home');
        }
    }
    // Post by category
    public function postByCategory($slug){
        $data['title'] = config('generals.site_title');
        $category = PostCategory::where('slug',$slug)->where('status',1)->first();
        if(isset($category)){
            $data['post_lists'] = Post::where('category_id',$category->id)->where('status',1)->orderBy('id','DESC')->get();
            visitorCount('post_category',$category->id);
            
            $data['page_title']         = $category->title; 
            $data['meta_title']         = $category->title;
            $data['meta_keywords']      = isset($category->meta_keywords) && $category->meta_keywords !=""? $category->meta_keywords: config('generals.site_meta_keyword');
            $data['meta_description']   = $category->meta_description; 
            $data['featured_image']     = $category->image ? $category->image : config('generals.site_featured_image');
            $data['cover_image']        = get_general_setting('site_featured_image');

            $data['description']        = $category->description; 
            $data['thumbnail']          = $category->thumbnail;
            $data['image']              = $category->image;
            $data['categories']         = PostCategory::where('status',1)->get();
            return view('frontend.template.category',$data);
        }else{
            return redirect()->route('home');
        }
    }
    // Post details
    public function post_detail($slug){
        $data['title'] = config('generals.site_title');
        $post = Post::where('slug',$slug)->where('status',1)->first();
        if(isset($post)){
            visitorCount('post',$post->id);
            
            $data['page_title']         = $post->title; 
            $data['meta_title']         = $post->title;
            $data['meta_keywords']      = isset($post->meta_keywords) && $post->meta_keywords !=""? $post->meta_keywords: config('generals.site_meta_keyword');
            $data['meta_description']   = $post->meta_description; 
            $data['featured_image']     = $post->image ? $post->image : config('generals.site_featured_image');
            $data['cover_image']        = get_general_setting('site_featured_image');

            $data['description']        = $post->description; 
            $data['thumbnail']          = $post->thumbnail;
            $data['image']              = $post->image;
            $data['created_at']         = $post->created_at;
            $data['post']               = $post;

            $data['categories'] = PostCategory::where('status',1)->get();
            return view('frontend.template.default',$data);

        }else{
            return redirect()->route('home');
        }
    }

}
