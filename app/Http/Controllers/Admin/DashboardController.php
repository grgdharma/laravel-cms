<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\General;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\VisitorCount;
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
        // Location information
        $ip_address = request()->ip(); //Dynamic IP address get
        if($ip_address == '127.0.0.1'){
            $ip_address = '49.244.91.241';
        }
        $location_info = \Location::get($ip_address); 
        if(isset($location_info)){
            $data['ip_address']     = $location_info->ip;
            $data['countryName']    = $location_info->countryName;
            $data['regionName']     = $location_info->regionName;
            $data['cityName']       = $location_info->cityName;
            $data['latitude']       = $location_info->latitude;
            $data['longitude']      = $location_info->longitude;
        }
        $data['total_posts']     = Post::count();
        $data['total_comments']  = PostComment::count();
        $data['total_visitor']   = VisitorCount::select('key','key_value')->distinct()->count();

        //$now = Carbon::now()->subDays(7);
        $now = Carbon::now();
        $start_day = $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');
        $end_day   = $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d');
        $data['daily_count']     = dailyCount($start_day,$end_day);

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
