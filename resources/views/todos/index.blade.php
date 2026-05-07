<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Todo一覧</title>
</head>
<body>

<h1>Todo一覧</h1>

<form action="/todos" method="POST">
  @csrf
  <input type="text" name="title" placeholder="タイトル">
  <textarea name="body"></textarea>
  <button type="submit">追加</button>
</form>

<ul>
@foreach ($todos as $todo)
  <li>{{ $todo->title }}</li>
@endforeach
</ul>

</body>
</html>