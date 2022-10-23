<?php

namespace Bitfumes\Multiauth\Http\Controllers;

use Illuminate\Http\Request;
use Bitfumes\Multiauth\Model\Role;
use Illuminate\Routing\Controller;
use Bitfumes\Multiauth\Model\Admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Bitfumes\Multiauth\Http\Requests\AdminRequest;
use Bitfumes\Multiauth\Notifications\RegistrationNotification;
use Illuminate\Support\Facades\mail;
use App\Mail\SendMail;
use App\App;
use Crypt;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public $redirectTo;

    /**
     * Where to redirect users after registration.
     *
     * @return string
     */
    public function redirectTo()
    {
        return $this->redirectTo = route('admin.show');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super');
    }

    public function showRegistrationForm()
    {
        $roles = Role::all();

        return view('multiauth::admin.register', compact('roles'));
    }

    public function register(AdminRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));

        return redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return Admin
     */
    protected function create(array $data)
    {
        $admin = new Admin;

        $fields = $this->tableFields();
        $pass = $data['password'];
        $data['password'] = bcrypt($data['password']);
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $admin->$field = $data[$field];
            }
        }

        //send email
        $app = App::get()->first();
        $app_image = $app->image;
        if(empty($app_image)){
            $app_image = 'logo.png';
        }
        $data = array(
            'app_image' => $app_image,
            'app_name' => $app->name,
            'app_moto' => $app->moto,
            'name' => $data['name'],
            'email' => $data['email'],
            'subject'  => 'Adminship: New Admin',
            'message' => $app->name.' has decided to make you an Admin. Your email address is "'.$data['email'].'" and password is "'.$pass.'" . Use this credentials to login into '.$app->name.'. Change this password after login for security issue. Thank you.',
        );
        Mail::to($data['email'])->send(new SendMail($data));

        $admin->save();
        $admin->roles()->sync(request('role_id'));
        $this->sendConfirmationNotification($admin, request('password'));
        return $admin;
    }

    protected function sendConfirmationNotification($admin, $password)
    {
        if (config('multiauth.registration_notification_email')) {
            try {
                $admin->notify(new RegistrationNotification($password));
            } catch (\Exception $e) {
                request()->session()->flash('message', 'Email not sent properly, Please check your mail configurations');
            }
        }
    }

    protected function tableFields()
    {
        return collect(\Schema::getColumnListing('admins'));
    }

    public function edit($id)
    {

        $id = Crypt::decrypt($id);
        $admin = Admin::find($id);
        $roles = Role::all();

        return view('multiauth::admin.edit', compact('admin', 'roles'));
    }

    //Update Data
    public function update(Admin $admin, AdminRequest $request)
    {
        $old_data = Admin::findOrFail($request->id);
        $admin->update($request->except('role_id'));
        $admin->roles()->sync(request('role_id'));

        //send Email
        $app = App::get()->first();
        $app_image = $app->image;
        if(empty($app_image)){
            $app_image = 'logo.png';
        }
        if ($old_data->name != $admin->name) {
            $name_msg = 'name changed from '.$old_data->name.' to '.$admin->name.',' ;
        }
        else{
            $name_msg = null;
        }
        if ($old_data->email != $admin->email) {
            $email_msg = 'email changed from '.$old_data->email.' to '.$admin->email.',';
        }
        else{
            $email_msg = null;
        }
        if ($old_data->phone != $admin->phone) {
            $phone_msg = 'phone changed from '.$old_data->phone.' to '.$admin->phone.',' ;
        }
        else{
            $phone_msg = null;
        }

        $check = array($name_msg, $email_msg, $phone_msg);
        $check_msg = 1;
        foreach($check as $value){
            if ($value != null || $value != '' ) {
               $check_msg = 0;
            }
            break;
        }
        if($check_msg == 1){
            $mail_message = 'An admin ('.auth('admin')->user()->name.':'.auth('admin')->user()->email.') tried to change your basic information, but everything is updated as same for '.$app->name.'. May be your role has been updated. Please check for more information.';
        }
        else{
            $mail_message = 'An admin ('.auth('admin')->user()->name.':'.auth('admin')->user()->email.') have changed your basic information for '.$app->name.'. Your '.$name_msg.' '.$email_msg.' '.$phone_msg.' Please contact for information';
        }

        $data = array(
            'app_image' => $app_image,
            'app_name' => $app->name,
            'app_moto' => $app->moto,
            'name' => $old_data->name,
            'email' => $old_data->email,
            'subject'  => 'Information Updated',
            'message' => $mail_message,
        );
        if ($old_data->email != $admin->email) {
            Mail::to($admin->email)->send(new SendMail($data));
            Mail::to($old_data->email)->send(new SendMail($data));
        }
        else{
            Mail::to($admin->email)->send(new SendMail($data));
        }
        

        return redirect(route('admin.show'))->with('message', "{$admin->name} details are successfully updated");
    }

    public function destroy(Admin $admin)
    {
        //send email
        $app = App::get()->first();
        $app_image = $app->image;
        if(empty($app_image)){
            $app_image = 'logo.png';
        }
        $data = array(
            'app_image' => $app_image,
            'app_name' => $app->name,
            'app_moto' => $app->moto,
            'name' => $admin->name,
            'email' => $admin->email,
            'delete' => 1,
            'subject'  => 'Admin Removal',
            'message' => $app->name.' has removed you as an admin. Please contact us for more information.',
        );
        Mail::to($admin->email)->send(new SendMail($data));

        $prefix = config('multiauth.prefix');
        $admin->delete();

        return redirect(route('admin.show'))->with('message', "You have deleted an admin successfully");
    }
}
