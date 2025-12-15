<?php

namespace App\Http\Controllers\Admin;

use Carbon\CarbonImmutable;
use App\Models\General;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\VisitorCount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        // Get client IP
        $ip_address = request()->ip();

        // Dev environment fallback
        if ($ip_address === '127.0.0.1') {
            $ip_address = '49.244.91.241';
        }

        $data = [];

        // Get location info safely
        try {
            $location_info = \Location::get($ip_address);
            if ($location_info) {
                $data = [
                    'ip_address'  => $location_info->ip,
                    'countryName' => $location_info->countryName,
                    'regionName'  => $location_info->regionName,
                    'cityName'    => $location_info->cityName,
                    'latitude'    => $location_info->latitude,
                    'longitude'   => $location_info->longitude,
                ];
            }
        } catch (\Exception $e) {
            $data = [
                'ip_address'  => $ip_address,
                'countryName' => null,
                'regionName'  => null,
                'cityName'    => null,
                'latitude'    => null,
                'longitude'   => null,
            ];
        }

        // Dashboard counts
        $data['total_posts']    = Post::count();
        $data['total_comments'] = PostComment::count();
        $data['total_visitor']  = VisitorCount::distinct('key')->count('key');

        // Weekly visitor count
        $now = CarbonImmutable::now();
        $start_day = $now->startOfWeek(CarbonImmutable::SUNDAY)->format('Y-m-d');
        $end_day   = $now->endOfWeek(CarbonImmutable::SATURDAY)->format('Y-m-d');
        $data['daily_count'] = dailyCount($start_day, $end_day);

        return view('admin.dashboard', $data);
    }

    public function site_status(Request $request)
    {
        $status = $request->input('status');
        try {
            General::set('site_status', $status);
            return response()->json([
                'status'  => 1,
                'message' => 'Successfully updated the site status'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 0,
                'message' => $e->getMessage()
            ]);
        }
    }
}