<?php

namespace App\Http\Controllers\Admin;

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
        $visitor_option_list = VisitorCount::select('key')->distinct()->get();
        $visitor_option = [];
        if(count($visitor_option_list) > 0){
            foreach($visitor_option_list as $option){
                $visitor_option[] = [
                    'label' => ucfirst(str_replace("_"," ",$option->key)),
                    'value' => $option->key
                ];
            }
        }
        $data['visitor_option'] = $visitor_option;
        $visitor_info           = view('admin.visitor',$data)->render();
        return response([
            'visitor_info' => $visitor_info,
        ]);
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
        //
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
