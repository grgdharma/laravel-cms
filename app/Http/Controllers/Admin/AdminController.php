<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\AddAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(checkAuthorization() == true){
            $data['role'] = AdminRole::where('id','!=',1)->get();
            $admin_group = Auth::guard('admin')->user()->role_id;
            if($admin_group == 1){
                $data['admin'] = Admin::orderBy('name','ASC')->get();
            }else{
                $data['admin'] = Admin::where('role_id','!=',1)->orderBy('name','ASC')->get();
            }
            return view('admin.user.admin',$data);
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
    public function store(AddAdminRequest $request)
    {
        try{
            $result = Admin::create([
                'name' =>  $request->input('name'),
                'email' => $request->input('email'),
                'role_id' => $request->input('role'),
                'password' => Hash::make($request->input('password'))
            ]);
            if ($result) {
                return back()->with('success','Successfully added data.');   
            }else{
                return back()->with('error','Sorry, something is wrong.');   
            }
        }catch(\Exception $e){
            return redirect()->route('system.administration')->with('error',$e->getMessage());  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->input('model_id');
        $edit_data = Admin::where('id',$id)->first();
        if(isset($edit_data)){
            $data['role'] = AdminRole::where('id','!=',1)->get();
            $data['edit'] = $edit_data;
            $data['id'] = $id;
            return view('admin.user.ajax',$data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        try{
            $admin = Admin::find($id);
            if($new_password !=''){
                if (Hash::check($old_password, $admin->password)) { 
                    $data = array(
                        'name' =>  $request->input('name'),
                        'role_id' => $request->input('role'),
                        'password' => Hash::make($request->input('new_password'))
                    );
                }else{
                    return back()->with('error',"Old password doesn't matched.");   
                }
            }else{
                $data = array(
                    'name' =>  $request->input('name'),
                    'role_id' => $request->input('role')
                );
            }
            $result = Admin::where('id',$id)->update($data);
            if ($result) {
                return back()->with('success','Success, you have modified data.');   
            }else{
                return back()->with('error','Sorry, something is wrong.');   
            }
        }catch(\Exception $e){
            return redirect()->route('system.administration')->with('error',$e->getMessage());  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        try{
            $result =  Admin::find($id)->delete();
            if ($result) {
                return back()->with('success','Success, you have deleted a data.');  
            }else{
                return back()->with('error','Sorry, something is wrong.');   
            }
        }catch(\Exception $e){
            return redirect()->route('system.administration')->with('error',$e->getMessage());  
        }
    }
}
