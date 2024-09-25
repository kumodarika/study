<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Task;
use App\Models\Assignee;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::with('assignee')->orderBy('due_date','asc')->get();
        return view('todolist.list',["tasks"=>$tasks]);
    }

    public function createTask()
    {
        $assignees = Assignee::all(); //担当者データの取得
        return view('todolist.task_create', compact('assignees'));
    }

    public function create(CreateRequest $request)
    {
        // バリデーション済みデータを取得
        try {
            $data = $request->validated();

            $task = new Task();
            $task->status = $request->status;
            $task->title = $request->title;
            $task->due_date = $request->due_date;
            $task->assignee_id = $request->assignee;
            $task->save();

            return redirect('/')->with('success', 'タスクが作成されました。');
    }catch (\Exception $e) {
        dd($e->getMessage()); // エラー内容を表示
    }
    }

    public function editTask($id)
    {
        $assignees = Assignee::all();
        $task = Task::find($id);

        if(!$task){
            return redirect('/')->with('error','タスクが見つかりませんでした。');
        }
        // return view('todolist.task_update',["task"=>$task]);
        return view('todolist.task_update', compact('task', 'assignees'));
    }

    public function update(UpdateRequest $request)
    {
        // バリデーション済みデータを取得
        try{
            $data = $request->validated();
            Task::find($request->id)->update([
                'status'=>$request->status,
                'title'=>$request->title,
                'due_date'=>$request->due_date,
                'assignee_id'=>$request->assignee,
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
