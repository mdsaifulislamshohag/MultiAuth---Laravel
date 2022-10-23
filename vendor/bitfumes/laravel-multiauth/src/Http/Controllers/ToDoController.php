<?php

namespace Bitfumes\Multiauth\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request; 
use App\ToDo;
use Crypt;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = ToDo::get();
        return view('vendor.multiauth.todo.index')->with(compact('tasks')); 
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
        $store = new ToDo;
        $store->task = $request->input('task');
        $store->save();
        return back()->with('message', 'Task added successfully');
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
    public function update(Request $request)
    {
        $update = ToDo::findOrFail($request->input('id'));
        $update->task = $request->input('task');
        $update->update();
        return back()->with('message','Task has been Updated');
    }

    public function status(Request $request, $id)
    {
        $status = ToDo::findOrFail($id);
        if($status->status == 0){
            $status->status = 1;
        }
        else{
            $status->status = 0;
        }
        
        $status->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $delete = ToDo::findOrFail($id);
        $delete->delete();
        return back()->with('message', 'Task Deleted');
    }
}
