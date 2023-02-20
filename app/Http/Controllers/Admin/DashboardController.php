<?php

namespace App\Http\Controllers\Admin;
use App\Models\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('admin.dashboard');
    }


    public function site_status(Request $request){
        $status = $request->input('status');
        try {
            General::set('site_status', $status);
            $status = 1;
            $message = 'Successfully, update the site status';
        } catch (\Exception $exception) {
            $status = 0;
            $message = $exception->getMessage();
        }
        return response([
            'status'  => $status,
            'message' => $message
        ]);
    }


}
