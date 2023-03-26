<?php
/**
 * You can define your own set of helper functions
 */
use Illuminate\Support\Facades\Auth;
use App\Models\SystemAuthorization;
use App\Models\VisitorCount;
use App\Models\Post;
use App\Models\Admin;
use App\Models\User;
use App\Models\Pages;
use Carbon\Carbon;

if (! function_exists('get_general_setting')) {
    function get_general_setting($column_name){
        return config('generals.'.$column_name);
    }
}
if (! function_exists('checkAuthorization')) {
    function checkAuthorization(){
        $admin_group = Auth::guard('admin')->user()->role_id;
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $privilege = SystemAuthorization::where('route_url', $currentPath)->get()->toArray();
        if(count($privilege) > 0 ){
            $privilege = json_decode($privilege[0]['role_id']);
            if(in_array($admin_group, $privilege )) {
                return true;
            }else{
            return false;
            }
        }else{
            return false;
        }
    }
}

if (! function_exists('getTitle')) {
    function getTitle(){
        return config('generals.site_title');
    }
}
if (! function_exists('logoHeader')) {
    function logoHeader(){
        return config('generals.site_logo_web');
    }
}
if (! function_exists('logoFooter')) {
    function logoFooter(){
        return config('generals.site_logo_web_footer');
    }
}
if (! function_exists('siteAddress')) {
    function siteAddress(){
        return config('generals.site_address');
    }
}
if (! function_exists('siteCopyright')) {
    function siteCopyright(){
        return config('generals.site_copyright');
    }
}
if (! function_exists('getImageURL')) {
    function getImageURL($file){
        $disk = getStorageDisk();
        if($file!=''){
            return \Storage::disk($disk)->url($file);
        }else{
            return false;
        }
    }
}

if (! function_exists('getStorageDisk')) {
    function getStorageDisk(){
        $file_storage_disk =  config('generals.file_storage_disk');
        $file_storage_disk =  str_replace(' ', '', $file_storage_disk);
        if($file_storage_disk!=''){
            return $file_storage_disk;
        }else{
            return 'public';
        }
    }
}
if (! function_exists('getRouteLists')) {
    function getRouteLists(){
        $routesList = \Route::getRoutes();
        $i=1;
        $exclude_name = [
            'filemanager','admin.login','admin.password.request',
            'admin.password.reset',
        ];
        echo "<table class='table table-hover table-bordered mb-0'>";
        echo "<thead><tr>";
            echo "<th width='2%'>S.N.</th>";
            // echo "<th width='10%'>HTTP Method</th>";
            echo "<th width='10%'>Route URL</th>";
            echo "<th>Route Name</th>";
        echo "</tr></thead><tbody <tbody id='myTable' >";
        foreach($routesList as $value){
            $route_name = $value->getName();
            $url = $value->uri();
            $first_data = explode('/', $url);
            if($first_data[0]=='system' && !in_array($value->methods()[0],['POST','DELETE']) && !in_array($route_name,$exclude_name) ){
                echo "<tr title='Double click to slect the data.' class='route-row' data-url='".$value->uri()."' data-name='".$route_name."' >";
                    echo "<td>".$i."</td>";
                    // echo "<td>".implode('|', $value->methods())."</td>";
                    echo "<td>".$value->uri()."</td>";
                    echo "<td>" . $route_name . "</td>";
                echo "</tr>";
                $i++;
            }
            
        }
        echo "</tbody></table>";
    }
}
// side menu for admin dashboard
if (! function_exists('getSideMenu')) {
    function getSideMenu(){
        $admin_group = Auth::guard('admin')->user()->role_id;
        $menu_list = SystemAuthorization::whereNull('parent_id')->where('status',1)->orderBy('sort_order', 'DESC')->get()->toArray();
        $data = [];
        if(count($menu_list) > 0 ){
            foreach($menu_list as $value){
                $user_role = json_decode($value['role_id']);
                if(in_array($admin_group, $user_role )) {
                    $child_data = [];
                    $child_list = SystemAuthorization::where('parent_id',$value['id'])->where('status',1)->orderBy('sort_order', 'ASC')->get()->toArray();
                    if(count($child_list) > 0){
                        foreach($child_list as $child){
                            $user_role = json_decode($child['role_id']);
                            if(in_array($admin_group, $user_role )) {
                                $child_data[] = [
                                    'id'         => $child['id'],
                                    'name'       => $child['name'],
                                    'icon'       => $child['icon'],
                                    'route_name' => $child['route_name'],
                                ];
                            }
                        }
                    }
                    $data[] = [
                        'id'        =>  $value['id'],
                        'name'      => $value['name'],
                        'icon'      => $value['icon'],
                        'route_name'=> $value['route_name'],
                        'child_list'=> $child_data,
                    ];
                }
            }
        }
        return $data;
    }
}
// Visitor information
if(!function_exists('visitorCount')){
    function visitorCount($key, $key_valye = null,$notes = null){
        $referrer = "";
        if(isset($_SERVER['HTTP_REFERER'])) {
            $referrer = $_SERVER['HTTP_REFERER'];
        }
        $ip_address = getIPAddress();
        $visitor_count = VisitorCount::where('key',$key)->where('ip_address',$ip_address)->where('visited_date',date('Y-m-d'))->count();
        if($visitor_count < 5000){
            $data = [
                'key'          => $key,
                'key_value'    => $key_valye,
                'ip_address'   => $ip_address,
                'visited_date' => date('Y-m-d'),
                'visited_time' => date('H:i'),
                'visited_day'  => date('D'),
                'visited_month'=> date('M'),
                'visited_year' => date('Y')
            ];
            $result = VisitorCount:: firstOrCreate($data);
            $result->referrer   = $referrer;
            $result->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $result->notes      = $notes;
            $result->save();
        }
    }
}
if(!function_exists('dailyCount')){
    function dailyCount($start_day,$end_day){
        $daily_visitor  = VisitorCount::whereBetween('visited_date',[$start_day,$end_day])->select('ip_address','visited_date','visited_day')->distinct()->get();
        
        $sun    = 0;
        $mon    = 0;
        $tue    = 0;
        $wed    = 0;
        $thu    = 0;
        $fri    = 0;
        $sat    = 0;
        $count  = [];
        foreach($daily_visitor as $daily){
            $daily_count = VisitorCount::where('ip_address', $daily->ip_address)->where('visited_date', $daily->visited_date)->where('visited_day', $daily->visited_day)->count();
            if($daily->visited_day == 'Sun'){
                $sun = $daily_count;
            }
            if($daily->visited_day == 'Mon'){
                $mon = $daily_count;
            }
            if($daily->visited_day == 'Tue'){
                $tue = $daily_count;
            }
            if($daily->visited_day == 'Wed'){
                $wed = $daily_count;
            }
            if($daily->visited_day == 'Thu'){
                $thu = $daily_count;
            }
            if($daily->visited_day == 'Fri'){
                $fri = $daily_count;
            }
            if($daily->visited_day == 'Sat'){
                $sat = $daily_count;
            }
        }
        $count =  [$sun,$mon,$tue,$wed,$thu,$fri,$sat];
        return $count;
    }
}
if(!function_exists('getIPAddress')){
    function getIPAddress() {  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) { 
            //whether ip is from the share internet 
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
            //whether ip is from the proxy 
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        } else{  
            //whether ip is from the remote address  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        return $ip;  
    }  
}
if(!function_exists('getPageVisitorCount')){
    function getPageVisitorCount($page){
        return VisitorCount::where('key',$page)->count();
    }
}
// Get a location by IP address
if(!function_exists('getLocationByIp')){
    function getLocationByIp($ip_address){
        $ip_address = '103.239.147.187'; //For static IP address get
        //$ip_address = request()->ip(); //Dynamic IP address get
        return \Location::get($ip_address);  
    }
}
if(!function_exists('getPostAuthor')){
    function getPostAuthor($post){
        $author_type = $post->author_type;
        $author_id   = $post->author_id;
        $author_info = "";
        if($author_type == 'admin'){
            $author_info = Admin::where('id',$author_id)->first();
        }else{
            $author_info = User::where('id',$author_id)->first();
        }
        if(isset($author_info)){
            $author_info = $author_info;
        }
        return $author_info;
    }
}
// Get footer menu
if(!function_exists('getNavMenu')){
    function getNavMenu($location){
        $nav_menu = Pages::get();
        $data = [];
        if(count($nav_menu) > 0){
            foreach($nav_menu as $menu){
                $data[] = [
                    'title' => $menu->title,
                    'slug'  => $menu->slug,
                ];
            }
        }
        return $data;
    }
}
if (! function_exists('currencyFormat')) {
    function currencyFormat($value){
        $code = '$';
        if (is_numeric($value)) {
            return $code.''.number_format($value);
        }else{
            return $code.''. str_replace('.00', '', $value);
        }
    }
}