<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>タスク追加ページ</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 900px;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        h2 {
            color: #333;
            margin-top: 0;
            font-size: 30px;
        }

        a {
            text-decoration: underline;
            color: #007bff;
            margin-left: 35px;
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
            width: calc(100% - 50px);
            padding: 12px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 13px;
        }

        input[type="submit"] {
            width: auto;
            padding: 10px 20px;
            margin: 20px 0;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        select {
            height: 40px;
        }

    </style>
</head>

<body>
    <div class="container">
        <h2>タスクの追加</h2>
        <form method="POST" action="{{ url('/create') }}" class="form">
            @csrf
            @if ($errors->any())
            <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{$error}}</li>
            @endforeach
            </ul>
            @endif
            ・状態：<select name="status">
                <option value="">選択してください</option>
                <option value="1">未了</option>
                <option value="2">処理中</option>
                <option value="3">完了</option>
            </select>
            <br>
            ・タイトル：<input type="text" name="title" maxlength="100"><br>
            ・期日：<input type="datetime-local" name="due_date"  min="{{ now()->format('Y-m-d\TH:i') }}"><br>
            ・担当：<select name="assignee">
                <option value="">選択してください</option>
                    @foreach($assignees as $assignee)
                        <option value="{{ $assignee->id }}">{{ $assignee->name }}</option>
                    @endforeach
                </select>
            <br>
            <input type="submit" name="create" value="追加">
        </form>
        <a href="{{url('/')}}" class="btn">戻る</a>
    </div>
</body>
