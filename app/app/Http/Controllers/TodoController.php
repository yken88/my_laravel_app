<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreatePostRequest;
use Log;
use Illuminate\Support\Facades\DB;

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


    public function store(CreatePostRequest $request){
        try{
            $todo = [
                'title' => $request->title,
                'detail' => $request->detail,
                'status' => self::INCOMPLETE,
                'user_id' => Auth::id(),
            ];
    
            Todo::create($todo);
            
        }catch(Exception $e){
            Log::error($e->getMessage());
            return redirect(route('todo.create'));
        }

        return redirect(route('todo.index'));
    }

    public function edit($id){
        $todo = Todo::find($id);

        if($todo === null){
            abort(404);
        }
        
        return view('todo.edit', [
            'todo' => $todo
        ]);
    }

    public function update(CreatePostRequest $request){
        $todo = Todo::find($request->id);

        DB::beginTransaction();
        try {
            $todo->title = $request->tile;
            $todo->detail = $request->detail;
            $todo->save();

            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();

            return redirect(route('todo.edit', $request->id));
        }

        return redirect(route('todo.index'));
    }
}
