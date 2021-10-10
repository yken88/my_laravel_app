<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{

    const INCOMPLETE = 0;

    public function index(){
        $todo_list = Todo::where('user_id', Auth::id())->get()->toArray();

        return view('todo.index', [
            'todo_list' => $todo_list 
        ]);
    }

    public function show($id){
        $todo = Todo::find($id);

        if($todo === null){
            abort(404);
        }
        
        return view('todo.show', [
            'todo' => $todo
        ]);
    }

    public function create(){
        return view('todo.create');
    }


    public function store(Request $request){
        $todo = [
            'title' => $request->title,
            'detail' => $request->detail,
            'status' => self::INCOMPLETE,
            'user_id' => Auth::id(),
        ];

        Todo::create($todo);

        return redirect(route('todo.index'));
    }
}
