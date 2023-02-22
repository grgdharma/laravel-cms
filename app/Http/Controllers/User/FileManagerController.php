<?php

namespace App\Http\Controllers\User;
use File;
use Storage;
use Session;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->parent_directory = 'files';
        $this->disk = getStorageDisk();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user_id = Auth::user()->id;
        $sub_dir = "u".$user_id;
        if(isset($_GET['target_id'])){
            Session::put('target_id', $_GET['target_id']);
            $target_id = Session::get('target_id');
        }else{
            $target_id = Session::get('target_id');
        }

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $limit = 18;

        $directories = array();
        $file_data = array();
        $data['files'] = array();

        if (isset($_GET['directory'])) {
            $parent_name = str_replace('*', '', $_GET['directory']);
            $directory_name = $_GET['directory'] !=''? str_replace('*', '', $_GET['directory']).'/':'';
            $directory = $this->parent_directory."/".$sub_dir."/".$directory_name;
        }else{
            $parent_name = '';
            $directory_name = '';
            $directory = $this->parent_directory."/".$sub_dir;
        }
        // Get directories
        $directories = Storage::disk($this->disk)->directories($directory);
        if (!$directories) {
            $directories = array();
        }
        // Get files
        $file_data = Storage::disk($this->disk)->files($directory);
        if (!$file_data) {
            $file_data = array();
        }
        rsort($file_data);
        $imges_directory = array_merge($directories, $file_data);
        $image_total = count($imges_directory);
        $data = array_splice($imges_directory, ($page - 1) * $limit, $limit);

        foreach ($data as $value) {
            $path = Storage::disk($this->disk)->path($value);
            $name = basename($value);
            if(is_dir($path)){
               
                $data['files'][] = array(
                    'name'  => $name,
                    'type'  => 'directory',
                    'path'  => $value,
                    'url'   => Storage::disk($this->disk)->url($value)
                );

            }else{
               
                $data['files'][] = array(
                    'name'  => $name,
                    'type'  => 'file',
                    'path'  => $value,
                    'url'   => Storage::disk($this->disk)->url($value)
                );
            }
        }
        
        $num_pages = ceil($image_total / $limit);
        return view('user.filemanager')->with('media_files',$data)
                                        ->with('target_id',$target_id)
                                        ->with('page',$page)
                                        ->with('parent', $parent_name)
                                        ->with('num_pages',$num_pages)
                                        ->with('total_data',$image_total)
                                        ->with('limit',$limit);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_file(Request $request){
        $user_id = Auth::user()->id;
        $sub_dir = "u".$user_id;
        $directory = $request->input('directory') !=''? $request->input('directory').'/':'';
        $this->validate($request, [
            'file_name' => 'required|mimes:mp4,pdf,jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //$file_name = $request->file_name->getClientOriginalName();
        $file_name = rand().'.'.$request->file_name->extension();
        $result = $request->file_name->storeAs($this->parent_directory.'/'.$sub_dir.'/'.$directory, $file_name, $this->disk );
        if ($result) {

            Storage::disk($this->disk)->setVisibility($result, 'public');
            $response['success'] = "Successfully uploaded a file.";
            
        }else{
            $response['error'] = "Sorry, something wrong with uploading the file.";
        }
        echo json_encode($response);
    }

    public function create_folder(Request $request){
    
		$directory = basename($request->input('folder'));
        $directory = str_replace(' ','-',$directory);
        if($directory !=''){
            $path = $this->parent_directory.'/'.$directory;
            if(! Storage::disk($this->disk)->exists($path)){

		        $directory = Storage::disk($this->disk)->makeDirectory($path);
                Storage::disk($this->disk)->setVisibility($path, 'public');
		        $response['success'] = "Successfully created a new folder.";

		    }else{
		    	$response['error'] = "Sorry, the folder name already present.";
		    }
		}else{
			$response['error'] = "Please Enter Name ";
		}
	    echo json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){

        $paths = $request->input('path');
        $directory = $request->input('directory')!=''?$request->input('directory').'/':'';
        $paths = explode(",",$paths);
        foreach ($paths as $path) {

            $file_path = Storage::disk($this->disk)->path($path);
            if (is_dir($file_path)) {

                $result = Storage::disk($this->disk)->deleteDirectory($path);
                
            }else{
        
                $result = Storage::disk($this->disk)->delete($path);
            }
        }
        
        if($result){
            $response['success'] = 'Successfully deleted the file.';
        }else{
            $response['success'] = "Something wrong !";
        }
        echo json_encode($response);
    }
}
