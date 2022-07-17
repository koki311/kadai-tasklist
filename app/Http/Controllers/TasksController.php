<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{

    public function index()
    {
        $tasks = [];
        if(\Auth::check()){
            $tasks = \Auth::user()->tasklists()->orderBy('created_at','desc')->paginate(10);
        }
        return view('tasks.index',['tasks'=>$tasks]);
    }


    public function create()
    {
        $task = new Task;
        return view('tasks.create',['task'=>$task,]);
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);
        
        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->user_id = $request->user()->id;
        $task->save();
        return redirect('/');
    }

 
    public function show($id)
    {
        $task = Task::findOrFail($id);
        
        if(\Auth::id() === $task->user_id){
                return view('tasks.show',['task'=>$task,]);
        }
        return redirect('/');
    }


    public function edit($id)
    {
        $task = Task::findOrFail($id);
        
        if(\Auth::id() === $task ->user_id){
        return view('tasks.edit', [
            'task' => $task,
        ]);
        }
        return redirect('/');
    }


    public function update(Request $request, $id)
    {
        
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);
        
        
        $task = Task::findOrFail($id);
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();
        return redirect('/');
    }


    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if(\Auth::id() === $task ->user_id){
        $task->delete();
        }
        return redirect('/');
    }
}
