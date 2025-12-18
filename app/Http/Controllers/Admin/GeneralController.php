<?php

namespace App\Http\Controllers\Admin;

use App\Models\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(checkAuthorization() == true){
            return view('admin.general');
        }else{
            return view('errors.401');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $keys = $request->except('_token');
        try {
            foreach ($keys as $key => $value) {
                General::set($key, $value);
            }
            return back()->with('success','Your general information has been updated.');   
        } catch (\Exception $exception) {
            return back()->withInput()->with('error', $exception->getMessage());
        }
    }
}
