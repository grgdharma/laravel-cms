<?php

namespace App\Http\Controllers\Admin;
use App\Models\AdminRole;
use App\Http\Controllers\Controller;
use App\Models\SystemAuthorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SystemAuthorizationController extends Controller
{
    public function __construct()
    {
        // Add authorization middleware if needed
        $this->middleware('check.permission')->except(['edit','role_update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_collection['role'] = AdminRole::where('id', '!=', 1)->get();

        $perPage = 3;
        $page    = request()->get('page', 1);
        $result =  SystemAuthorization::with('children.children')
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->paginate($perPage);
        $data_collection['permission'] = $result->map(function ($parent) {
            return [
                'id'         => $parent->id,
                'icon'       => $parent->icon,
                'name'       => $parent->name,
                'route_url'  => $parent->route_url,
                'role_id'    => json_decode($parent->role_id),
                'status'     => $parent->status,
                'sort_order' => $parent->sort_order,
                'child_list' => $parent->children->map(function ($child) {
                    return [
                        'id'         => $child->id,
                        'icon'       => $child->icon,
                        'name'       => $child->name,
                        'route_url'  => $child->route_url,
                        'role_id'    => json_decode($child->role_id),
                        'status'     => $child->status,
                        'sort_order' => $child->sort_order,
                        'child_child_list' => $child->children->map(function ($sub) {
                            return [
                                'id'         => $sub->id,
                                'icon'       => $sub->icon,
                                'name'       => $sub->name,
                                'route_url'  => $sub->route_url,
                                'role_id'    => json_decode($sub->role_id),
                                'status'     => $sub->status,
                                'sort_order' => $sub->sort_order,
                            ];
                        }),
                    ];
                }),
            ];
        });

        $data_collection['pagination'] = $result;

        return view('admin.authorization.all', $data_collection);
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
            $result = SystemAuthorization::create($data);
            if ($result) {
                return back()->with('success','Your item has been created.');   
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
        try {
            $id = $request->input('model_id');
            $edit = SystemAuthorization::findOrFail($id);
            return view('admin.authorization.edit', [
                'role' => AdminRole::where('id', '!=', 1)->get(),
                'edit' => $edit,
                'id'   => $edit->id,
            ]);
        } catch (ModelNotFoundException $e) {
            // Record not found
            return abort(404, 'Authorization not found');
        } catch (\Throwable $e) {
            // Any other error
            \Log::error('Authorization edit failed', [
                'error' => $e->getMessage(),
                'id'    => $request->input('model_id'),
            ]);
            return abort(500, 'Something went wrong');
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
            $edit = SystemAuthorization::where('id',$id)->get()->toArray();
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
            $result = SystemAuthorization::where('id', $id)->update($data);
            if ($result) {
                return back()->with('success','Your item has been updated.');   
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
            $result = SystemAuthorization::find($id)->delete();
            if ($result) {
                return back()->with('success','Your item has been deleted.');   
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
            $result = SystemAuthorization::where('id', $id)->update($data);
            if ($result) {
            $response['message'] = "Successfully updated the route authorization.";
            }else{
                $response['message'] = "Sorry,somthing wrong.";
            }
            echo json_encode($response);
        }catch(\Exception $e){
            echo json_encode($e->getMessage()); 
        }
    }
}
