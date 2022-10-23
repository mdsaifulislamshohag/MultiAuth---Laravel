<?php

namespace Bitfumes\Multiauth\Http\Controllers;

use Illuminate\Routing\Controller;
use Bitfumes\Multiauth\Model\Admin;
use App\ToDo;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super', ['only'=>'show']);
    }

    public function index()
    {
        $todos = ToDo::paginate(10);
        return view('multiauth::home.index')->with(compact('todos'));
    }

    public function show()
    {
        $admins = Admin::where('id', '!=', 1)->get();

        return view('multiauth::admin.show', compact('admins'));
    }
}
