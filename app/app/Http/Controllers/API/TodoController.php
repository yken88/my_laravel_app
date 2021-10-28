<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;


class TodoController extends Controller
{
    //
    public function updateStatus($id){
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

            $result = false;
        }

        return response()->json($result);

    }

}
