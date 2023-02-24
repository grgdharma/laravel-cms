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
        $ip_address = '103.124.96.3';
        //$ip_address = request()->ip(); //Dynamic IP address get
        $location_info = \Location::get($ip_address); 
        // Location information
    	$data['ip_address']     = $location_info->ip;
        $data['countryName']    = $location_info->countryName;
        $data['regionName']     = $location_info->regionName;
        $data['cityName']       = $location_info->cityName;
        $data['latitude']       = $location_info->latitude;
        $data['longitude']      = $location_info->longitude;

        return view('admin.dashboard',$data);
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
