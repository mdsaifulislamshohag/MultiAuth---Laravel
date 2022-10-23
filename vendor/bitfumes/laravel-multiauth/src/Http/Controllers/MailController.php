<?php

namespace Bitfumes\Multiauth\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\mail;
use App\Mail\SendMail;
use App\Email;
use App\App;
use Crypt;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super', ['only'=>'trash']);
    }

    public function index()
    {

        $messages = Email::orderBy('id', 'DESC')->where('sender', '1')->where('trash', '0')->paginate(20);

        $mailbox = 0;
        return view('vendor.multiauth.email.mailbox')->with(compact('messages', 'mailbox'));
    }

    public function sent()
    {
        $messages = Email::orderBy('id', 'DESC')->where('sender', '0')->where('trash', '0')->paginate(20);
        $mailbox= 1;
        return view('vendor.multiauth.email.mailbox')->with(compact('messages', 'mailbox'));
    }

    public function draft()
    {
        $messages = Email::orderBy('id', 'DESC')->where('sender', null)->where('trash', '0')->paginate(20);
        $mailbox= 2;
        return view('vendor.multiauth.email.mailbox')->with(compact('messages', 'mailbox'));
    }

    public function trash()
    {
        $messages = Email::orderBy('id', 'DESC')->where('trash', '1')->paginate(20);
        $mailbox= 3;
        return view('vendor.multiauth.email.mailbox')->with(compact('messages', 'mailbox'));
    }

    public function search(Request $request)
    {
        if($request->has('search')){
            $search = $request->input('search');
            $mailbox = '4';

            $messages = Email::where('name', 'like', "%{$search}%")
                            ->orWhere('to','like',"%{$search}%")
                            ->orWhere('from','like',"%{$search}%")
                            ->orWhere('subject','like',"%{$search}%")
                            ->orWhere('created_at','like',"%{$search}%")
                            ->orderBy('id', 'DESC')
                            ->paginate(20);

            return view('vendor.multiauth.email.mailbox')->with(compact('messages', 'mailbox'));
        }
        else{
            return redirect('/mailbox/inbox');
        }
            
    }

    public function compose()
    {
        $mailbox= 4;
        return view('vendor.multiauth.email.compose')->with(compact('mailbox'));
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

    public function reply($id)
    {
        $id = Crypt::decrypt($id);
        $reply = Email::find($id);
        return view('vendor.multiauth.email.compose')->with(compact('reply'));
    }

    public function forward($id)
    {
        $id = Crypt::decrypt($id);
        $forward = Email::find($id);
        return view('vendor.multiauth.email.compose')->with(compact('forward'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        if($request->has('send')){

            $request->validate([
                'to' => 'required|email'
            ]);

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
                'name' => '',
                'delete' => 2,
                'email' => $request->input('to'),
                'subject'  => $request->input('subject'),
                'message' => $request->input('message'),
            );
            Mail::to($request->input('to'))->send(new SendMail($data));
            $store = new Email;
            $store->sender = $request->input('sender');
            $store->name = $request->input('name');
            $store->to = $request->input('to');
            $store->from = $request->input('from');
            $store->subject = $request->input('subject');
            $store->message = $request->input('message');

            $store->save();

            return redirect('/mailbox/sent')->with('message', 'Message has been sent successfully');
        }
        elseif($request->has('draft')){
            $request->validate([
                'to' => 'nullable|email'
            ]);
            $store = new Email;
            $store->sender = null;
            $store->name = $request->input('name');
            $store->to = $request->input('to');
            $store->from = $request->input('from');
            $store->subject = $request->input('subject');
            $store->message = $request->input('message');

            $store->save();

            return redirect('/mailbox/draft')->with('message', 'Message has been saved to draft.');
        }
        else{
            return redirect('/mailbox/inbox');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $message = Email::findOrFail($id);

        if($message->sender == 1){
            if($message->read == 0){
                $message->read = 1;
                $message->save();   
            }
        }
        
        return view('vendor.multiauth.email.message')->with(compact('message'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function movetotrash($id)
    {
        $id = Crypt::decrypt($id);
        $trash = Email::findOrFail($id);
        $trash->trash = 1;
        $trash->save(); 
        return redirect('/mailbox/inbox')->with('message',' Message has been moved to trash.');
    }
    
    //email action: delete/draft/trash/mark as read
    public function action(Request $request)
    {
        $messages = $request->input('checked',[]);
        $count = count($messages);

        if($request->has('trash')){
            if($count > 0 ){
                foreach($messages as $message){
                    $trash = Email::find($message);
                    $trash->trash = 1;
                    $trash->save(); 
                }
                return back()->with('message', $count.' messages has been moved to trash.');
            }
            else{
                return back()->with('custom_error', 'Nothing selected..');
            }
                
        }

        if($request->has('markread')){
            if($count > 0 ){
                foreach($messages as $message){
                    $update = Email::findOrFail($message);
                    $update->read = 1;
                    $update->save(); 
                }
                return back();
            }
            else{
                return back()->with('custom_error', 'Nothing selected..');
            }
        }

        if($request->has('markunread')){
            if($count > 0 ){
                foreach($messages as $message){
                    $update = Email::findOrFail($message);
                    $update->read = 0;
                    $update->save(); 
                }
                return back();
            }
            else{
                return back()->with('custom_error', 'Nothing selected..');
            }
        }

        if($request->has('moveback')){
            if($count > 0 ){
                foreach($messages as $message){
                    $update = Email::findOrFail($message);
                    $update->trash = 0;
                    $update->save(); 
                }
                return back()->with('message', $count.' messages has been moved back from trash.');
            }
            else{
                return back()->with('custom_error', 'Nothing selected..');
            }
        }

        if($request->has('delete')){
            if($count > 0 ){
                foreach($messages as $message){
                    $delete = Email::find($message);
                    $delete->delete();
                }
                return back()->with('message', $count.' messages has been deleted from trash.');
            }
            else{
                return back()->with('custom_error', 'Nothing selected..');
            }
        }
    }

    public function destroy(Request $request)
    {
        //
    }
}
