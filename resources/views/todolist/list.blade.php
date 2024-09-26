
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タスク管理アプリ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        h1 {
            color: #333;
            margin-top: 0;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
        .btn-edit {
            background-color: #0056b3;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-align: center;
        }

        .btn-edit i {
            margin-right: 5px; /* アイコンとテキストの間にスペースを追加 */
        }

        .btn-delete {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-align: center;
        }

        .btn-delete i {
    margin-right: 5px;
        }

        .btn-edit:hover, .btn-delete:hover {
            opacity: 0.8;
        }

        .due-date-warning {
            color: red;
        }

        td {
        text-align: center;
        }

        .status {
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        display: inline-block;
        }

        .status-1 {
            background-color: gray;
        }

        .status-2 {
            background-color: orange;
        }

        .status-3 {
            background-color: #28a745;
        }

        input[type="text"],
    select {
        width: 200px;
        padding: 10px;
        margin: 3px 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        padding: 10px 15px;
        font-size: 16px;
    }

    .pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    justify-content: center;
    margin-top: 20px;
}

.pagination .page-item {
    margin: 0 5px;
}

.page-link {
    text-decoration: none;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    color: #007bff;
}

.page-item.disabled .page-link {
    color: #6c757d;
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>タスク一覧</h1>
        <form method="GET" action="{{ url('/') }}">
            <input type="text" name="keyword" placeholder="キーワード検索" value="{{ request('keyword') }}">
            <select name="assignee">
                <option value="">全ての担当者</option>
                @foreach($assignees as $assignee)
                    <option value="{{ $assignee->id }}" {{ request('assignee') == $assignee->id ? 'selected' : '' }}>
                        {{ $assignee->name }}
                    </option>
                @endforeach
            </select>
            <select name="status">
                <option value="">全ての状態</option>
                <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>未了</option>
                <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>処理中</option>
                <option value="3" {{ request('status') == 3 ? 'selected' : '' }}>完了</option>
            </select>
            <button type="submit">検索</button>
        </form>
        <a href="{{url('/create-task')}}" class="btn btn-blue">追加</a>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>状態</th>
                <th>タイトル</th>
                <th>期日</th>
                <th>担当</th>
                <th colspan="2">アクション</th>
            </tr>
            @foreach($tasks as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td>
                    @switch($task->status)
                        @case(1)
                            <span class="status status-1">未了</span>
                            @break
                        @case(2)
                            <span class="status status-2">処理中</span>
                            @break
                        @case(3)
                            <span class="status status-3">完了</span>
                            @break
                        @default
                            <span class="status">未選択</span>
                    @endswitch
                </td>
                <td>{{$task->title}}</td>
                <td style="color:{{ ($task->due_date && \Carbon\Carbon::now()->diffInDays($task->due_date) <= 7) ? 'red' : 'black' }}">
                    {{$task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d H:i') : '未設定'}}
                </td>
                <td>{{$task->assignee->name}}</td>
                <td>
                    <form action="{{url('/edit/'.$task->id)}}" method="GET" style="display:inline;">
                        <button type="submit" class="btn-edit">
                            <i class="fas fa-edit"></i>編集
                        </button>
                    </form>
                </td>
                <td>
                    <form action="{{ url('/delete/'.$task->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            <i class="fas fa-trash"></i>削除
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        <div class="pagination">
            {{ $tasks->links('vendor.pagination.bootstrap-5') }}
        </div>

    </div>
</body>

</html>

