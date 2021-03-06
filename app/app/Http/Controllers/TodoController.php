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
    public function index(Request $request){
        if($request->title || $request->status){
            $todo_list = $this->searchTask($request->title, $request->status);
        }else{
            $todo_list = Todo::where('user_id', Auth::id())->get()->toArray();
        }

        $token = Auth::user()->token;
        
        return view('todo.index', [
            'todo_list' => $todo_list,
            'token' => $token
        ]);
    }

    // 検索
    private function searchTask($title, $status){

        // statusの指定がなかった場合
        if($status === null){
            // 未完了を指定
            $status = Todo::INCOMPLETE;
        }

        if($title === null){
            $todo_list = Todo::where('user_id', Auth::id())
                    ->where('status', $status)
                    ->get(); 
        }else{
            $todo_list = Todo::where('user_id', Auth::id())
                    ->where('title', 'like', "%$title%")
                    ->where('status', $status)
                    ->get();
        }

        return $todo_list;
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
                'status' => Todo::INCOMPLETE,
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

        DB::beginTransaction();
        try {
            $todo = Todo::find($request->id);
            $todo->title = $request->title;
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

    public function delete(Request $request){
        DB::beginTransaction();

        try{
            $todo = Todo::find($request->id);
            $todo->delete();
            DB::commit();
        }catch(\Exception $e){
            Log::error($e->getMessage());
            DB::rollback();

            return redirect(route('todo.index'));
        }
        

        return redirect(route('todo.index'));
    }
}
