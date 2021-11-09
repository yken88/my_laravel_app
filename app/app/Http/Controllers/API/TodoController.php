<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{
    public function updateStatus($id, Request $request){
        $token = $request->bearerToken();
        $user = User::getByBeareToken($token);
        if(!$user){
            redirect(route('todo.index'));
        }

        DB::beginTransaction();

        try{
            $todo = Todo::find($id);

            if($todo->status === Todo::INCOMPLETE){
                $todo->status = Todo::COMPLETED;
            }else{
                $todo->status = Todo::INCOMPLETE;
            }
            
            $todo->save();

            DB::commit();
            $result = 'success';

        }catch(\Exception $e){
            Log::error($e->getMessage());
            DB::rollback();

            $result = 'failed';
        }

        return response()->json($result);

    }
}
