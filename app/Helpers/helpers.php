<?php
/**
 * You can define your own set of helper functions
 */
use Illuminate\Support\Facades\Auth;
use App\Models\SystemPermission;
use App\Models\VisitorCount;
use App\Models\Post;
use App\Models\Admin;
use App\Models\User;

if (! function_exists('get_general_setting')) {
    function get_general_setting($column_name){
        return config('generals.'.$column_name);
    }
}
if (! function_exists('checkAuthorization')) {
    function checkAuthorization(){
        $admin_group = Auth::guard('admin')->user()->role_id;
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $privilege = SystemPermission::where('route_url', $currentPath)->get()->toArray();
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
            if($first_data[0]=='admin' && !in_array($value->methods()[0],['POST','DELETE']) && !in_array($route_name,$exclude_name) ){
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
if (! function_exists('getSideMenu')) {
    function getSideMenu(){
        $admin_group = Auth::guard('admin')->user()->role_id;
        $menu_list = SystemPermission::whereNull('parent_id')->where('status',1)->orderBy('sort_order', 'DESC')->get()->toArray();
        $data = [];
        if(count($menu_list) > 0 ){
            foreach($menu_list as $value){
                $user_role = json_decode($value['role_id']);
                if(in_array($admin_group, $user_role )) {
                    $child_data = [];
                    $child_list = SystemPermission::where('parent_id',$value['id'])->where('status',1)->orderBy('sort_order', 'ASC')->get()->toArray();
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
if(!function_exists('visitorCount')){
    function visitorCount($key, $key_valye = null,$notes = null){
        $referrer = "";
        if(isset($_SERVER['HTTP_REFERER'])) {
            $referrer = $_SERVER['HTTP_REFERER'];
        }
        $data = [
            'key'          => $key,
            'key_value'    => $key_valye,
            'ip_address'   => getIPAddress(),
            'referrer'     => $referrer,
            'user_agent'   => $_SERVER['HTTP_USER_AGENT'],
            'notes'        => $notes
        ];
        VisitorCount:: create($data);
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
        return $author_info;
    }
}