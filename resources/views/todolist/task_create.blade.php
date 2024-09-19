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
        .invalid-feedback {
            margin-top:0px;
        }
    </style>
</head>

<body>
    <div>
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
            ・タイトル：<input type="textarea" name="title"><br>
            ・期日：<input type="datetime-local" name="due_date"  min="{{ now()->format('Y-m-d\TH:i') }}"><br>
            ・担当：<input type="text" name="assignee"><br>
            <input type="submit" name="create" value="追加">
        </form>
        <a href="{{url('/')}}" class="btn">戻る</a>
    </div>
</body>
