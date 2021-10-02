<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //
    public function index(){
        $todo_list = Todo::all();

        return view('todo.index', [
        'todo_list' => $todo_list ]);
    }
}
