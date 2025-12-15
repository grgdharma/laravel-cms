<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use App\Http\Requests\Page\AddPageRequest;
use App\Http\Requests\Page\UpdatePageRequest;

class PageController extends Controller
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
            'parent_id'        => $request->input('parent_id') ?: null,
            'title'            => $request->input('title'),
            'description'      => $request->input('description'),
            'meta_description' => $request->input('meta_description'),
            'meta_keywords'    => $request->input('meta_keywords'),
            'image'            => $request->input('feature_image'),
            'template'         => $request->input('template') ?: 'default',
            'sort_order'       => $request->input('sort_order') ?: 0,
            'status'           => $request->input('status') ?: 0,
        ];
    }
    /**
     * Display a listing of pages.
     */
    public function index()
    {
        $pages = Pages::all();
        return view('admin.pages.all', compact('pages'));
    }

    /**
     * Show the form for creating a new page.
     */
    public function create()
    {
        $page_lists = Pages::whereNull('parent_id')->get();
        return view('admin.pages.create', compact('page_lists'));
    }

    /**
     * Store a newly created page.
     */
    public function store(AddPageRequest $request)
    {
        $data = $this->prepareFormData($request);
        try {
            Pages::create($data);
            return back()->with('success','Your item has been created.');
        } catch (\Exception $e) {
            return back()->with('error','Something went wrong. Please try again.');
        }
    }

    /**
     * Show the form for editing a page.
     */
    public function edit($id)
    {
        $page = Pages::findOrFail($id);
        $page_lists = Pages::whereNull('parent_id')->get();
        return view('admin.pages.edit', compact('page', 'page_lists'));
    }

    /**
     * Update the specified page.
     */
    public function update(UpdatePageRequest $request, Pages $page)
    {
        $data = $this->prepareFormData($request);
        try {
            $page->update($data);
            return back()->with('success','Your item has been updated.');
        } catch (\Exception $e) {
            return back()->with('error','Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified page.
     */
    public function destroy(Pages $page)
    {
        try {
            $page->delete();
            return back()->with('success','Your item has been deleted.');
        } catch (\Exception $e) {
            return back()->with('error','Something went wrong. Please try again.');
        }
    }
}