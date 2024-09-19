<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::orderBy('due_date','asc')->get();
        return view('todolist.list',["tasks"=>$tasks]);
    }

    public function createTask()
    {
        return view('todolist.task_create');
    }

    public function create(Request $request)
    {
        //バリデーション
        $validated = $request->validate([
            'status' => 'required|integer|in:1,2,3',
            'title' => 'required|string|max:100',
            'due_date' => 'nullable|date|after_or_equal:now',
            'assignee' => 'required|string|max:20',
        ],
        [
            'status.required' => 'ステータスは必須です。',
            'title.required' => 'タイトルは必須です。',
            'due_date.after_or_equal' => '期日は今日以降の日付でなければなりません。',
            'assignee.required' => '担当者は必須です。',
        ]);
            $task = new Task();
            $task->status = $request -> status ;
            $task->title = $request -> title ;
            $task->due_date = $request -> due_date ;
            $task->assignee = $request -> assignee ;
            $task->save();

            return redirect('/');
    }

    public function editTask($id)
    {
        $task = Task::find($id);

        if(!$task){
            return redirect('/')->with('error','タスクが見つかりませんでした。');
        }
        return view('todolist.task_update',["task"=>$task]);
    }

    public function update(Request $request)
    {
        //バリデーション
        $validated = $request->validate([
            'status' => 'required|integer|in:1,2,3',
            'title' => 'required|string|max:100',
            'due_date' => 'nullable|date|after_or_equal:now',
            'assignee' => 'required|string|max:20',
        ],[
            'status.required' => 'ステータスは必須です。',
            'title.required' => 'タイトルは必須です。',
            'due_date.after_or_equal' => '期日は今日以降の日付でなければなりません。',
            'assignee.required' => '担当者は必須です。',
        ]);
        try{
        Task::find($request->id)->update([
            'status'=>$request->status,
            'title'=>$request->title,
            'due_date'=>$request->due_date,
            'assignee'=>$request->assignee,
        ]);

        return redirect('/')->with('success', 'タスクが更新されました。');
    } catch (\Exception $e) {
        return redirect('/edit/'.$request->id)->with('error', '更新することができません。');
    }
    }

    public function delete($id)
    {
        $task = Task::find($id);

        if($task){
            $task->delete();
            return redirect('/')->with('success','タスクが削除されました。');
        }
        return redirect('/')->with('error','タスクが見つかりません。');
    }
}
