<?php

namespace Bitfumes\Multiauth\Http\Controllers;
use Illuminate\Routing\Controller;
use App\App;
use File;

use Illuminate\Http\Request;


class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:super');
    }

    public function index()
    {
        return view('vendor.multiauth.app.index');
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
        
        $update=App::findOrFail($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $image_name = time().'.'.$request->image->getClientOriginalExtension();

            if(file_exists(public_path('/images/app/'.$update->image))){
        
                unlink(public_path("images/app/{$update->image}"));
                
            }

            $path= $request->file('image')->move(public_path('/images/app'), $image_name);
            $update->image = $image_name;

        }
        else{

            $request->validate(['name' => 'required']);

            $update->name = $request['name'];
            $update->category = $request['category'];
            $update->moto = $request['moto'];
            $update->location = $request['location'];
            $update->details = $request['details'];
        }

        $update->save();    
        return back()->with('message', 'Updated App Information successfully');
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
