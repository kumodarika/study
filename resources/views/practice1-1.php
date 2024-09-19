<body>
    <h1>"Todoリスト"</h1>
    <p>{{$msg}}</p>
    <form method="POST" action="/list">
        @csrf
        <input type="text" name="msg">
        <input type="submit">
    </form>
</body>