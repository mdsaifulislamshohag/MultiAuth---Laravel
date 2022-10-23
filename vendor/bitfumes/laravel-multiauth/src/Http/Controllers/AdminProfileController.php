<?php

namespace Bitfumes\Multiauth\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Bitfumes\Multiauth\Model\Admin;
use Illuminate\Support\Facades\mail;
use App\Mail\SendMail;
use App\App;
use File;
use Hash;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super', ['only'=>'show']);
    }

    public function index()
    {
        return view('vendor.multiauth.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update=Admin::findOrFail($id);
        $app = App::get()->first();
        $app_image = $app->image;
        if(empty($app_image)){
            $app_image = 'logo.png';
        }

        //Update Profile Image
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $image_name = time().'.'.$request->image->getClientOriginalExtension();

            if(isset($update->image)){
                if(file_exists(public_path('/images/admin/'.$update->image))){
            
                    unlink(public_path("images/admin/{$update->image}"));
                    
                }
            }
                

            $path= $request->file('image')->move(public_path('/images/admin'), $image_name);
            $update->image = $image_name;
            $update->save();    
            return back()->with('message', 'Updated Profile Image successfully');

        }

        //Update Basic Profile Information
        elseif(isset($request->name)){

            $request->validate(['name' => 'required']);

            $update->name = $request['name'];
            $update->phone = $request['phone'];
            $update->address = $request['address'];
            $update->save();    
            return back()->with('message', 'Updated Profile Information successfully');
        }

        //update Email
        elseif(isset($request->email)){

            $request->validate(['email' => 'required']);

            if(isset($request->password)){
                $password_hash = $update->password;
                
                if (Hash::check($request->password, $password_hash)){
                    //sending email

                    $data = array(
                        'app_image' => $app_image,
                        'app_name' => $app->name,
                        'app_moto' => $app->moto,
                        'name' => $update->name,
                        'email' => $update->email,
                        'subject'  => 'Email Address Changed',
                        'message' => 'You have changed your email address from '.$update->email.' to '.$request->email.' for '.$app->name,
                    );
                    Mail::to($update->email)->send(new SendMail($data));
                    Mail::to($request->email)->send(new SendMail($data));
                    

                    $update->email = $request['email'];
                    $update->save();    
                    return back()->with('message', 'Updated Email successfully');
                }
                else{
                    return back()->with('custom_error', 'Wrong Password Entered');
                }
            }
            else{
                return back()->with('custom_error', 'Password required to change Email');
            }
            
        }

        //Update Password
        elseif(isset($request->old_password)){
            $password_hash = $update->password;
            if (Hash::check($request->old_password, $password_hash)){
                if (isset($request->new_password)) {
                    if($request->new_password == $request->confirm_password){
                        $update->password = Hash::make($request->new_password);
                        //send Email
                        $data = array(
                            'app_image' => $app_image,
                            'app_name' => $app->name,
                            'app_moto' => $app->moto,
                            'name' => $update->name,
                            'email' => $update->email,
                            'subject'  => 'Passowrd Changed',
                            'message' => 'You have changed your password for '.$app->name,
                        );
                        Mail::to($update->email)->send(new SendMail($data));

                        $update->save();    
                        return back()->with('message', 'Updated Password successfully');
                    }
                    else{
                        return back()->with('custom_error', 'Password Not Mathched');
                    }
                    
                }
                else{
                    return back()->with('custom_error', 'Please Insert New Password Entered');
                }
                
            }
            else{
                return back()->with('custom_error', 'Wrong Password ');
            }
            
        }
        else{
            return back()->with('custom_error', 'No Request Found ');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
