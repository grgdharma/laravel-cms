<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function __construct()
    {
        // Add authorization middleware if needed
        $this->middleware('check.permission');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 10;
        $customers = User::orderBy('name', 'ASC')->paginate($limit);
        $starting = ($customers->currentPage() - 1) * $limit + 1;
        return view('admin.customer.all', [
            'customer' => $customers,
            'total'    => $customers->total(),
            'starting' => $starting,
            'page'     => $starting,
        ]);
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
                return back()->with('success','Your user has been deleted.');   
            }else{
                return back()->with('error','Something went wrong. Please try again.');   
            }
        }catch(\Exception $e){
            return back()->with('error',$e->getMessage());   
        }
    }
}
