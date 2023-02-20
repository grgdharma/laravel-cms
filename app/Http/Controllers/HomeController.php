<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Storage;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->disk = getStorageDisk();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit_profile(){
        return view('user.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id){

        $request->validate([
            'full_name' => 'required|string|max:255',
        ]);
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');

        // image upload
        $new_image = $request->file('image');
        if($new_image){
            
            Storage::disk($this->disk)->delete($request->input('profile_pic'));
            $imageName = $id.'.'.$request->image->extension();
            $result =  $request->image->storeAs('images', $imageName, $this->disk );
            Storage::disk($this->disk)->setVisibility($result, 'public');
            $file_path = 'images/'.$imageName;

        }else{

            $file_path = $request->input('profile_pic');

        }
        if($new_password !=''){

            if (Hash::check($old_password, Auth::user()->password)) { 
                $data = array(
                    'name' => $request->input('full_name'),
                    'address' => $request->input('address'),
                    'country' => $request->input('country'),
                    'city' => $request->input('city'),
                    'avatar'  => $file_path,
                    'password' => Hash::make($request->input('new_password'))
                );

            }else{
                
                return back()->with('warning',"Old Password doesn't match.");   
            }
        }else{
            $data = array(
                'name' => $request->input('full_name'),
                'address' => $request->input('address'),
                'country' => $request->input('country'),
                'city' => $request->input('city'),
                'avatar'  => $file_path,
            );
        }

        $result = User::where('id',$id)->update($data);
        if ($result) {
            return back()->with('success','Success: You have modified information!');   
        }else{
            return back()->with('warning','Sorry, something is wrong');   
        }
    }
}
