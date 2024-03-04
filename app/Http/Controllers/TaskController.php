<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function create(Request $request){

        $request->validate([
             'name'=> 'required',
             'init_date' => "required_if:important,true",
             'finish_date' => "required_if:important,true",
             'important' => 'required',
        ]);

        $new_task = new Task;
        $new_task->name = $request->input('name');
        $new_task->init_date = $request->input('init_date');
        $new_task->finish_date = $request->input('finish_date');
        $new_task->important = $request->input('important');
        $new_task->category_id = $request->input('category');
        $new_task->save();

        return response()->json([
            'status' => 200,
            'message' => 'Tarea Creada'
        ]);
    }

    public function update(Request $request, $id){

        $request->validate([
            'name'=> 'required',
            'init_date' => "required_if:important,true",
            'finish_date' => "required_if:important,true",
            'important' => 'required',
       ]);

       $task = Task::find($id);
       $task->name = $request->input('name');
       $task->init_date = $request->input('init_date');
       $task->finish_date = $request->input('finish_date');
       $task->important = $request->input('important');
       $task->category_id = $request->input('category');
       $task->update();

       return response()->json([
           'status' => 200,
           'message' => 'Tarea Actualizada'
       ]);
    }

    public function delete($id){

        $task = Task::find($id);
        $task->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Tarea Borrada'
        ], 200);
    }

    public function get($id){

        $task = Task::with('category')->find($id);

        return response()->json([
            'task' => $task
        ], 200);
    }

    public function list(Request $request){

        $order = $request->query('order');
        $important = $request->query('important');

        if($order != null){

            $tasks = Task::with('category')->where('category_id', $order)->latest()->get();

            return response()->json([
                'tasks' => $tasks
            ], 200);
        }

        // if($important){

        //     $tasks = Task::with('category')->where('important', '==', 1)->latest()->get();

        //     return response()->json([
        //         'tasks' => $tasks
        //     ], 200);
        // }

        $tasks = Task::with('category')->latest()->get();

        return response()->json([
            'tasks' => $tasks
        ], 200);
    }

    public function complete($id) {

        $task = Task::find($id);

        if($task->completed){
            $task->completed = false;
            $task->save();
        }else {
            $task->completed = true;
            $task->save();
        }

        return response()->json([
            'message' => "Tarea Marcada"
        ], 200);
    }

}
