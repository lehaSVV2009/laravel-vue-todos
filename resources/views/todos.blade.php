<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Todo app</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .todo-list-item {
            display: flex;
        }
    </style>
</head>

<body>
    <h2>Create Todo</h2>
    <form method="POST" action="/api/todos">
        <input type="text" name="description" />
        <input type='hidden' name='completed' value=0 />
        <input type="checkbox" name="completed" value=1 />
        <button type="submit">Create</button>
    </form>
    <h2>Todos</h2>
    @foreach ($todos as $todo)
    <div class="todo-list-item">
        <form method="POST" action="/api/todos/{{$todo->id}}">
            @method('PUT')
            <input type="text" name="description" value="{{$todo->description}}" />
            <input type='hidden' name='completed' value=0 />
            <input type="checkbox" name="completed" {{$todo->completed ? "checked" : ""}} value=1 />
            <button type="submit">Update</button>
        </form>
        <form method="POST" action="/api/todos/{{$todo->id}}">
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
    @endforeach

</body>

</html>
