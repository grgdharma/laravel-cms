<?php

namespace App\Http\Controllers\Admin;
use App\Models\AdminRole;
use App\Http\Controllers\Controller;
use App\Models\SystemPermission;
use Illuminate\Http\Request;

class SystemPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(checkAuthorization() == true){
            $data_collection['role'] = AdminRole::where('id','!=',1)->get();
            $result = SystemPermission::whereNull('parent_id')->orderby('sort_order','ASC')->paginate(2);
            $data = [];
            foreach ($result as $value) {
                $child_data = [];
                $child_list = SystemPermission::where('parent_id',$value['id'])->where('status',1)->orderBy('sort_order', 'ASC')->get()->toArray();
                if(count($child_list) > 0){
                    foreach($child_list as $child){
                        $child_child_data = [];
                        $child_child_list = SystemPermission::where('parent_id',$child['id'])->where('status',1)->orderBy('sort_order', 'ASC')->get()->toArray();
                        if(count($child_child_list) > 0){
                            foreach($child_child_list as $child_list){
                                $child_child_data[] = [
                                    'id'          => $child_list['id'],
                                    'icon'        => $child_list['icon'],
                                    'name'        => $child_list['name'],
                                    'route_url'   => $child_list['route_url'],
                                    'role_id'     => json_decode($child_list['role_id']),
                                    'status'      => $child_list['status'],
                                    'sort_order'  => $child_list['sort_order'],
                                ];
                            }
                        }
                        $child_data[] = [
                            'id'          => $child['id'],
                            'icon'        => $child['icon'],
                            'name'        => $child['name'],
                            'route_url'   => $child['route_url'],
                            'role_id'     => json_decode($child['role_id']),
                            'status'      => $child['status'],
                            'sort_order'  => $child['sort_order'],
                            'child_child_list'=> $child_child_data,
                        ];
                    }
                }
                $data[] = array(
                    'id'          => $value['id'],
                    'icon'        => $value['icon'],
                    'name'        => $value['name'],
                    'route_url'   => $value['route_url'],
                    'role_id'     => json_decode($value['role_id']),
                    'status'      => $value['status'],
                    'sort_order'  => $value['sort_order'],
                    'child_list'=> $child_data,
                );
            }
            $data_collection['permission'] = $data;
            $data_collection['pagination'] = $result;
            return view('admin.permission.all',$data_collection);
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
            'name' => 'required|max:255',
        ]);
        try{
            $data = array(
                'name'      =>  $request->input('name'),
                'route_url' => $request->input('route'),
                'route_name' => $request->input('route_name'),
                'icon'      => $request->input('icon')?$request->input('icon'):'arrow-right',
                'status'    => $request->input('status'),
                'role_id'   => json_encode(['1']),
                'parent_id' => $request->input('parent_id'),
                'sort_order'=> $request->input('sort_order') !=''?$request->input('sort_order'):0,
            );
            $result = SystemPermission::create($data);
            if ($result) {
                return back()->with('success','Successfully added data.');   
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id         = $request->input('model_id');
        $edit_data  = SystemPermission::where('id',$id)->first();
        if(isset($edit_data)){
            $data['role']   = AdminRole::where('id','!=',1)->get();
            $data['edit']   = $edit_data;
            $data['id']     = $id;
            return view('admin.permission.edit',$data);
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
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        try{
            $edit = SystemPermission::where('id',$id)->get()->toArray();
            $value       = $edit[0]['role_id'];
            $data = array(
                'name'      => $request->input('name'),
                'route_url' => $request->input('route'),
                'route_name' => $request->input('route_name'),
                'role_id'   => $value,
                'icon'      => $request->input('icon')?$request->input('icon'):'arrow-right',
                'status'    => $request->input('status'),
                'parent_id' => $request->input('parent_id'),
                'sort_order'=> $request->input('sort_order') !=''?$request->input('sort_order'):0,
            );
            $result = SystemPermission::where('id', $id)->update($data);
            if ($result) {
                return back()->with('success','Successfully updated data.');   
            }else{
                return back()->with('error','Sorry, something is wrong.');   
            }
        }catch(\Exception $e){
            return back()->with('error',$e->getMessage());   
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $result = SystemPermission::find($id)->delete();
            if ($result) {
                return back()->with('success','Successfully deleted data.');   
            }else{
                return back()->with('error','Sorry, something is wrong.');   
            }
        }catch(\Exception $e){
            return back()->with('error',$e->getMessage());   
        }
    }
    /**
     * Update the system role
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function role_update(Request $request){
        $id     = $request->input('id');
        $a1 = ["1"];
        $a2 = [];
        if($request->input('value') ){
            $a2 = $request->input('value');
        }
        $a3 = array_merge($a1,$a2);
        $value = json_encode($a3);
        $data = array(
            'role_id' => $value
        );
        try{
            $result = SystemPermission::where('id', $id)->update($data);
            if ($result) {
            $response['message'] = "Successfully updated the route permissions.";
            }else{
                $response['message'] = "Sorry,somthing wrong.";
            }
            echo json_encode($response);
        }catch(\Exception $e){
            echo json_encode($e->getMessage()); 
        }
    }
}
