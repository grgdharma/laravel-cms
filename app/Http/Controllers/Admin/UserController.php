<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(checkAuthorization() == true){
            $limit = 10;
            if(isset($_GET['page']) && $_GET['page'] !=1){
                $data['starting'] = ($limit *$_GET['page'])-$limit+1;
                $data['page'] = ($limit * $_GET['page']) - $limit + 1;
            }else{
                $data['starting'] = 1;
                $data['page'] = 1;
            }
            $data['total'] = User::count();
            $data['customer'] = User::orderBy('name','ASC')->paginate($limit);
            return view('admin.customer.all',$data);
        }else{
            return view('errors.401');
        }
    }
    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $result = User::find($id)->delete();
            if ($result) {
                return back()->with('success','Successfully deleted data.');   
            }else{
                return back()->with('error','Sorry, something is wrong.');   
            }
        }catch(\Exception $e){
            return back()->with('error',$e->getMessage());   
        }
    }
}
