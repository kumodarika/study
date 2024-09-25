<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>タスク編集ページ</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            color: #333;
            margin-top: 0;
        }

        a {
            text-decoration: underline;
            color: #007bff;
            margin-left:35px;
        }

        a:hover {
            text-decoration: underline;
        }

        form {
            margin-top: 20px;
            margin-left:20px;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: calc(60% - 22px);
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 5%;
            text-align:center;
            padding: 7px;
            margin:15px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #007bff;
        }

        select {
            height: 40px;
        }
    </style>
</head>

<body>
    <div>
        <h2>タスクの編集</h2>
        <form method="POST" action="{{ url('/update') }}">
            @csrf
            @if ($errors->any())
            <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{$error}}</li>
            @endforeach
            </ul>
            @endif
            <input type="hidden" name="id" value="{{$task->id}}">
            ・ID：{{$task->id}}<br>
            <!-- バリデーションエラーの表示 -->
            @if(session('error'))
                <div style="color: red;">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div style="color: green;">{{ session('success') }}</div>
            @endif
            ・状態： <label for="status">状態：</label>
                <select name="status" id="status" style="border-color:
                @if($task->status == 1) gray
                @elseif($task->status == 2) yellow
                @elseif($task->status == 3) blue
                @endif;">
                <option value="">選択してください</option>
                <option value="1" value="1" {{$task->status =='1'?'selected':''}}>未了</option>
                <option value="2" value="2" {{$task->status =='2'?'selected':''}}>処理中</option>
                <option value="3" value="3" {{$task->status =='3'?'selected':''}}>完了</option>
            </select>
            <br>
            ・タイトル：<input type="textarea" name="title" value="{{$task->title}}"><br>
            ・期日：<input type="datetime-local" name="due_date" value="{{$task->due_date}}" min="{{ now()->format('Y-m-d\TH:i') }}"><br>
            ・担当：<select name="assignee">
                <option value="">選択してください</option>
                    @foreach($assignees as $assignee)
                    <option value="{{ $assignee->id }}" {{ $task->assignee_id == $assignee->id ? 'selected' : '' }}>
                        {{ $assignee->name }}
                    </option>
                    @endforeach
                </select>
                <br>
            <input type="submit" name="update" value="保存">
        </form>
        <a href="{{url('/')}}" class="btn">戻る</a>
    </div>
</body>
